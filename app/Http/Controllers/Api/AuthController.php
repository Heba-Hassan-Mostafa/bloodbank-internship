<?php

namespace App\Http\Controllers\Api;
use App\Mail\ResetPassword;
use App\Token;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // Register Service
    public function register(Request $request)
    {

        //Clients Validation Rules

        $validation = validator()->make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|unique:clients',
                'birth_date' => 'required',
                'city_id' => 'required',
                'phone' => 'required',
                'donation_last_date' => 'required',
                'password' => 'required|confirmed',
                'blood_type_id' => 'required'

            ]);

        //Error Messages

        if ($validation->fails()) {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }
        //Encrypt Password
        $request->merge(['password' => bcrypt($request->password)]);
        //Create Clients
        $client = Client::create($request->all());
        $client->api_token = str::random(60);
        $client->save();
        return apiResponse(1, 'تم الاضافة بنجاح', [
            'api_token' => $client->api_token,  //Return api_token To Register client After Hidden It In Client Model
            'client' => $client
        ]);


    }
     //Login Service
    public function login(Request $request)
    {
        //Clients Validation Rules

        $validation = validator()->make($request->all(),
            [
                'phone' => 'required',
                'password' => 'required',

            ]);

        //Error Messages

        $client=Client::where('phone',$request->phone)->first();
            if ($client){
                if (Hash::check($request->password,$client->password)){
                    return apiResponse(1,'تم تسجيل الدخول',[
                       'api_token'=>$client->api_token,
                       'client'=>$client
                    ]);
                }
                else{
                    return apiResponse(0,'بيانات الدخول غير صحيحة');
                }


    }
            else{
                return apiResponse(0,'بيانات الدخول غير صحيحة');
            }






         /*
        if ($validation->fails()) {
            return apiResponse(0, $validation->errors()->first(), $validation->errors());
        }
        return auth()->guard('api')->validate($request->all());
         */
    }

    // Profile Service
    public function profile(Request $request)
    {

        //Profile Validation Rules

        $validation = validator()->make($request->all(),
            [
               // 'email' => Rule::unique('clients')->ignore($request->user()->id),

                'phone' => Rule::unique('clients')->ignore($request->user()->id),
                'password' => 'confirmed',

            ]);

        //Error Messages

        if ($validation->fails()) {

            return apiResponse(0, $validation->errors()->first(), $validation->errors());

        }

        //Encrypt Password
        $request->merge(['password' => bcrypt($request->password)]);
        //Update Clients
        $user = request()->user();
        $user->update($request->all());
        return apiResponse(1, 'تم التعديل بنجاح', [
            'api_token' => $user->api_token,
            'client' => $user
        ]);

    }
    //Notification Settings
    public function notificationsettings(Request $request){
        //Notification Validation Rules

        $validation = validator()->make($request->all(),
            [
                'governorates.*' => 'required|exists:governorates,id',
                'blood_types.*' => 'required|exists:blood_types,id',

            ]);

        //Error Messages
        if ($validation->fails()) {
        return apiResponse(0, $validation->errors()->first(), $validation->errors());
       }

            $client = $request->user();
            $governorate = $client->governorates()->sync($request->governorates);
            $bloodType = $client->bloodTypes()->sync($request->blood_types);
            $data = [

                'governorates' => $request->user()->governorates()->pluck('governorates.id')->toArray(),

                'blood_types' => $request->user()->bloodtypes()->pluck('blood_types.id')->toArray(),

            ];
            return apiResponse(1, 'success', $data);


        }




    public function resetPassword(Request $request){

        //ResetPassword Validation Rules

        $validation = validator()->make($request->all(),
            [
                'phone' => 'required',

            ]);

        //Error Messages

        if ($validation->fails()) {

            return apiResponse(0, $validation->errors()->first(), $validation->errors());

        }
             //Verify with phone
        $user=Client::where('phone',$request->phone)->first();

        if ($user){
            $code=rand(1111,9999);
            $update=$user->update(['pin_code'=>$code]);
            if ($update){
                //send email
                Mail::to($user->email)
                    ->bcc("bebamohammed0@gmail.com")
                    ->send(new ResetPassword($code));

                return apiResponse(1,'برجاء فحص هاتفك',['pin_code_for_test'=>$code]);

            }else{
                return apiResponse(0,'حدث خطأ حاول مرة اخرى');

            }
        }else{
            return apiResponse(0,'لا يوجد حساب مرتبط بهذا الرقم');
        }

    }
    // NewPassword Service
    public function newPassword(Request $request){
        //validation rule
        $validation = validator()->make($request->all(),
            [

                'phone'=>'required',
                'pin_code'=>'required',
                'password'=>'required|confirmed',


        ]);
           //Error Message
        if ($validation->fails()){
            return apiResponse(0,$validation->errors()->first(), $validation->errors());
        }
        //
        $user=Client::where('pin_code',$request->pin_code)->where('pin_code','!=',0)
            ->where('phone',$request->phone)->first();
        if($user){
            //Encrypt Password
            $user->password = bcrypt($request->password);
            $user->pin_code=null;

            if ($user->save()){

                return apiResponse(1,'تم تغيير كلمة المرور بنجاح');

            }else{

                return apiResponse(0,'حدث خطأ حاول مرة آخرى');
            }

        }else{

            return apiResponse(0,'هذا الكود غير صالح');
        }
    }

    //Register Token


    public function registerToken(Request $request){
        $validation=validator()->make($request->all(),

            [
                'token'=>'required',
                'type'=>'required|in:android,ios'

           ] );
        //Error Message
        if ($validation->fails()){
            $data=$validation->errors();
            return apiResponse(0,$validation->errors()->first(), $validation->errors(),$data);
        }
        Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return apiResponse(1,'تم التسجيل بنجاح');
    }

    //remove token
    public function removeToken(Request $request){
        $validation=validator()->make($request->all(),

            [
                'token'=>'required',

            ] );
        //Error Message
        if ($validation->fails()){
            $data=$validation->errors();
            return apiResponse(0,$validation->errors()->first(), $validation->errors(),$data);
        }
        Token::where('token',$request->token)->delete();

        return apiResponse(1,'تم الحذف بنجاح');
    }
}