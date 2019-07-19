<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Role::paginate(10);
        return view('roles.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
            'name'=>'required|unique:roles,name',
            'display_name'=>'required',
            'permission_list'=>'required|array',

        ];
        $messages=[
            'name.required'=>'الاسم مطلوب',
            'display_name.required'=>'الاسم المعروض مطلوب',
            'permission_list.required'=>'قائمة الاوامر مطلوبة',
        ];
        $this->validate($request,$rule,$messages);
        $record=Role::create($request->all());
        $record->permissions()->attach($request->permission_list);

        flash()->success("تم الاضافة بنجاح");

        return redirect(route('role.index'));

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
        $model=Role::findOrfail($id);
        return view('roles.edit',compact('model'));
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
            'name'=>'required|unique:roles,name,'.$id,
            'display_name'=>'required',
            'permission_list'=>'required|array',

        ];
        $messages=[
            'name.required'=>'الاسم مطلوب',
            'display_name.required'=>'الاسم المعروض مطلوب',
            'permission_list.required'=>'قائمة الصلاحيات مطلوبة',
        ];
        $this->validate($request,$rule,$messages);

        $record=Role::findOrfail($id);
        $record->update($request->all());
        $record->permissions()->sync($request->permission_list);

        flash()->success("تم التعديل بنجاح");
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Role::findOrfail($id);
        $record->delete();
        flash()->success("تم الحذف");
        return back();
    }
}
