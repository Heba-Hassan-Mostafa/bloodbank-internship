<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $users=User::paginate(10);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
            'roles_list'=>'required'
        ]);

        $request->merge(['password'=>bcrypt($request->password)]);
       $user=User::create($request->except('roles_list'));
       $user->roles()->attach($request->input('roles_list'));
       flash()->success('تم اضافة المستخدم بنجاح');
        return redirect(route('user.index'));
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
        $model=User::findOrfail($id);
        return view('users.edit',compact('model'));
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
        $this->validate($request,[
        'name'=>'required',
            'email'=>'required',
            'password'=>'required|confirmed',
            'roles_list'=>'required'
            ]);
        $user=User::findOrfail($id);
        $user->roles()->sync((array)$request->input('roles_list'));
        $request->merge(['password'=>bcrypt($request->password)]);
        $update=$user->update($request->all());
        flash()->success('تم تعديل البيانات بنجاح');
        return redirect(route('user.index'));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrfail($id);
        $user->delete();
        flash()->success("تم الحذف");
        return back();
    }

    public function changePassword()
    {
      return view('users.reset-password');

    }

    public function changePasswordSave(Request $request)
    {
        $rule=[
            'old_password'=>'required',
            'password'=>'required|confirmed'
        ];
        $message=[
            'old_password.required'=>'كلمة المرور الحالية مطلوبة',
            'password.required'=>'كلمة المرور مطلوبة'
        ];
        $this->validate($request,$rule,$message);
        $user=Auth::user();
        if (Hash::check($request->input('old_password'),$user->password))
        {
            $user->password=bcrypt($request->input('password'));
            $user->save();
            flash()->success('تم تحديث كلمة المرور');
            return view('users.reset-password');
        }
        else{
            flash()->error('كلمة المرور غير صحيحة');
            return back();
        }


    }
}
