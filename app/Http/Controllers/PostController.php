<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\Input;
use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts=Post::where(function ($query) use ($request){
            if($request->has('search')){
                $query->whereHas('category',function ($category) use($request){
                    $category->where('name','like','%'.$request->search.'%');
                });
                $query->orWhere(function ($query) use($request){
                    $query->where('title','like','%'.$request->search.'%')
                        ->orwhere('content','like','%'.$request->search.'%');
                });
            }
        })->latest()->paginate();


        return view('posts.index',compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $categories=Category::all();
        return view('posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $post = new Post();

        $post->title = $data['title'];

        $post->content = $data['content'];

        $post->category_id = $data['category'];

        //Upload Image
        if ($request->hasFile('image')){

        $image_tmp  = Input::file('image');

        if ($image_tmp->isValid()){

         $extension = $image_tmp->getClientOriginalExtension();

            $filename = rand(111,99999).'.'.$extension;

                $image_path = 'image/backend_image/'.$filename;

                //Resize Image


                \Intervention\Image\Facades\Image::make($image_tmp)->resize(350,350)->save($image_path);

                //store Image

                $post->image = $filename;


        }

        }

        $post->save();
        flash()->success("تم الاضافة بنجاح");
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model=Post::findOrfail($id);
        return view('posts.edit',compact('model'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $record=Post::findOrfail($id);
        $record->update($request->all());
        flash()->success("تم التعديل بنجاح");
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Post::findOrfail($id);
        $record->delete();
        flash()->success("تم الحذف");
        return back();
    }
}
