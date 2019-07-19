<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Category::paginate(20);
        return view('categories.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule=[
            'name'=>'required:categories'
        ];
        $messages=[
            'name'=>'required',
        ];
        $this->validate($request,$rule,$messages);


        $record=Category::create($request->all());

        flash()->success("تم الاضافة بنجاح");

        return redirect(route('category.index'));

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
        $model=Category::findOrfail($id);
        return view('categories.edit',compact('model'));
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
        $rule=[
            'name'=>'required:categories'
        ];
        $messages=[
            'name'=>'required',
        ];
        $this->validate($request,$rule,$messages);

        $record=Category::findOrfail($id);
        $record->update($request->all());
        flash()->success("تم التعديل بنجاح");
        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Category::findOrfail($id);
        if($record->posts()->count()){
            flash()->error('يوجد بوستات مرتبطة بهذا القسم');
        }
        $record->delete();
        flash()->success("تم الحذف");
        return back();
    }
}
