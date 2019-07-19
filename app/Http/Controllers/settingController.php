<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class settingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Setting::first();
        return view('settings.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting=Setting::where('id','1');
        if($setting){
            $data=$request->all();
            $records=Setting::first();
            $records->app_url = $data['app_url'];
            $records->phone = $data['phone'];
            $records->email = $data['email'];
            $records->facebook_url = $data['facebook_url'];
            $records->youtube_url = $data['youtube_url'];
            $records->twitter_url = $data['twitter_url'];
            $records->whatsup = $data['whatsup'];
            $records->instgram_url = $data['instgram_url'];
            $records->about_app = $data['about_app'];

            $records->save();
            return redirect(route('setting.index'));
        }
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
