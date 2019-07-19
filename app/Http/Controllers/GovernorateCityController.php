<?php

namespace App\Http\Controllers;

use App\City;
use App\Governorate;
use Illuminate\Http\Request;

class GovernorateCityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Governorate $governorate)
    {
//        $governorate=Governorate::find($gover_id);

        $cities=$governorate->cities()->paginate(20);

        return view('cities.index',compact('cities','governorate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Governorate $governorate)
    {

        return view('cities.create',compact('governorate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $rule=[
            'name'=>'required|unique:cities',

        ];
        $messages=[
            'name.required'=>' الاسم مطلوب',
            'name.unique'=>' الاسم استخدم من قبل',
        ];
        $this->validate($request,$rule,$messages);

        $records = new City();

        $records->name = $request->input('name');

        $records->governorate_id = $id;

       // dd($records);

        $records->save();

        flash()->success('تم الاضافة بنجاح');

        return redirect(route('governorate.city.index',compact('id')));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Governorate $governorate,$id)
    {
        $model=$governorate->cities()->findOrfail($id);
        return view('cities.edit',compact('model','governorate','id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Governorate $governorate,Request $request,$id)
    {
        $model=$governorate->cities()->findOrfail($id);
        $model->update($request->all());
        flash()->success("تم التعديل بنجاح");
        return redirect(route('governorate.city.index',compact('governorate')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Governorate $governorate,$id)
    {
        $model=$governorate->cities()->findOrfail($id);
        $model->delete();
        flash()->success("تم الحذف");
        return back();
    }
}
