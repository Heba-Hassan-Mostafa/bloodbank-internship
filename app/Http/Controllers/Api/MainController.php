<?php

namespace App\Http\Controllers\Api;

use App\BloodType;
use App\Category;
use App\Client;
use App\Contact;
use App\Post;
use App\Setting;
use App\Notification;
use App\Order;
use App\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Governorate;
use App\city;
use Illuminate\Support\Str;

class MainController extends Controller
{
    //Categories Function
    public function categories(){

        $categories = Category::all();
        return apiResponse(1,'success',$categories);

    }

    //list of BloodTypes
    public function bloodTypes(){

        $bloodTypes = BloodType::all();
        return apiResponse(1,'success',$bloodTypes);

    }

/*
       //posts Function
    public function posts(){

        $posts = Post::with('category')->paginate(10);
        return apiResponse(1,'success',$posts);

    }*/

    // find one post
    public function post(Request $request){
        $post=Post::find($request->id);
        if(!$post){
            return apiResponse(0,'This post not found');
        }
        return apiResponse(1,'success',$post);
    }


    //list of posts
    public function listPosts(Request $request){

        $posts=Post::where(function ($query) use ($request){

            if($request->has('category_id')){
                $query->where('category_id',$request->category_id);

            }
            if($request->has('keyword')){
                $query->where('title','like','%'.$request->keyword.'%')
                    ->orwhere('content','like','%'.$request->keyword.'%');
            }

        })->latest()->paginate();
        return apiResponse(1,'success',$posts);

    }
      //Favourite Posts
    public function favpost(Request $request){

        $post=$request->user()->posts()->latest()->paginate();
        return apiResponse(1,'success',$post);
    }

    public function togglefavourite(Request $request){
        $post=$request->user()->posts()->toggle($request->post_id);
        return apiResponse(1,'success',$post);
    }



     //Governorates Function
    public function governorates(){

     $governorates = Governorate::all();
     return apiResponse(1,'success',$governorates);

    }

    //cities Function
    public function cities(Request $request){

        $cities = city::where(function ($query) use($request){

           if ($request->has('governorate_id')){
               $query->where('governorate_id',$request->governorate_id);
           }
        })->get();
        return apiResponse(1,'success',$cities);

    }
    //Settings Function
    public function settings(){

        $settings = Setting::first();
        return apiResponse(1,'success',$settings);

    }
    //contacts Function
    public function contacts(Request $request){
        // rules
        $validation = validator()->make($request->all(),
            [
                'title' => 'required',
                'message' => 'required',

            ]);

        if ($validation->fails()) {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }

        //Create
        $contacts= $request->user()->contacts()->create($request->all());

        return apiResponse(1,'success',$contacts);




    }
    //list of orders
    public function listOrders(Request $request){

        $orders=Order::where(function ($query) use ($request){

            if($request->has('blood_type_id')){
                $query->where('blood_type_id',$request->blood_type_id);

            }
            if($request->has('city_id')){
                $query->where('city_id',$request->city_id);
            }

        })->latest()->paginate();
        return apiResponse(1,'success',$orders);

    }
    // find one Order
    public function orderdetails(Request $request){
        $order=Order::find($request->order_id);

        if(!$order){
            return apiResponse(0,'This order not found');
        }
        if($order->notification()->count()) {

            $request->user()->notifications()->updateExistingPivot($order->notification->id, [

                'is_read' => 1

            ]);
            return apiResponse(1,'success',$order);
        }
    }




    //Create Order
    // Donation Request Order
    public function orderCreate(Request $request){

        $rule=[
            'patient_name'=>'required',
            'patient_age'=>'required',
            'blood_type_id'=>'required',
            'bags_number'=>'required',
            'hospital_name'=>'required',
            'hospital_address'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'city_id'=>'required|exists:cities,id',
            'phone'=>'required',
            'notes'=>'required',
        ];

        $validation = validator()->make($request->all(),$rule);

        if($validation->fails()){
            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }
       //create donation request
        $donationRequest=$request->user()->orders()->create($request->all());
//          dd($donationRequest);
        // find client suitable for this donation request
        $clientId=$donationRequest->city->governorate->clients()->whereHas('bloodtypes',function ($query) use ($request){

           $query->where('blood_types.id',$request->blood_type_id);

        })->pluck('clients.id')->toArray();
       // dd($clientId);
        //info("clientsIds: ".count($clientId));
        if (count($clientId)){
          // create notification in database
            $notification=$donationRequest->notifications()->create([
                'title'=>'يوجد حالة تبرع قريبة منك',
                'content'=> $donationRequest->blood_type .'محتاج متبرع لفصيلة'

            ]);

            //attach clients to this notifications
            $notification->clients()->attach($clientId);

            //get tokens for FCM(Push notifications from firebase cloud message)
            $tokens=Token::whereIn('client_id',$clientId)->where('token','!=',null)->pluck('token')->toArray();

            info("tokens: ".count($tokens));
            if (count($tokens)){
                info("tokens: ".json_encode($tokens));
                $title=$notification->title;
                $body=$notification->content;
                $data=[
                    'donation_request_id'=>$donationRequest->id

                ];


                $send = notifyByFirebase($title,$body,$tokens,$data);
                info('firebase result:'.$send);
            }



        }
        return apiResponse(1,'تم الاضافة بنجاح',compact('donationRequest'));

    }

    public function count(Request $request){
        $count=$request->user()->notifications()->where(function ($query) {
           $query->where('is_read',0) ;
        })->count();
        return apiResponse(1,'load',[
            'notifications_count' => $count
        ]);
    }




}
