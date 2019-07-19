<?php

namespace App\Http\Controllers;

use App\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Governorate::paginate(20);
        return view('governorates.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {

        return view('governorates.create');
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
            'name'=>'required|unique:governorates'
        ];
        $messages=[
            'name.required'=>' الاسم مطلوب',
            'name.unique'=>' الاسم استخدم من قبل',
        ];
        $this->validate($request,$rule,$messages);

//        $record= new Governorate;
//        $record->name= $request->input('name');
//        $record->save();
//        return redirect(route('governorates.index'));

        $record=Governorate::create($request->all());

        flash()->success("تم الاضافة بنجاح");

        return redirect(route('governorate.index'));

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
        $model=Governorate::findOrfail($id);
        return view('governorates.edit',compact('model'));
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
        $record=Governorate::findOrfail($id);
        $record->update($request->all());
        flash()->success("تم التعديل بنجاح");
        return redirect(route('governorate.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Governorate::findOrfail($id);
        $record->delete();
        flash()->success("تم الحذف");
        return back();
    }
}
