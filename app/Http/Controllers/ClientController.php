<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $clients=Client::where(function ($query) use ($request){
            if($request->has('search')){
                $query->whereHas('city',function ($city) use($request){
                    $city->where('name','like','%'.$request->search.'%');
                });
                $query->orWhere(function ($query) use($request){
                    $query->where('name','like','%'.$request->search.'%');
                       // ->orwhere('phone','like','%'.$request->search.'%');
                });
            }
        })->latest()->paginate();


        return view('clients.index',compact('clients'));
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
        //
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
//        $model=Client::findOrfail($id);
//        return redirect(route('client.update/'.$id),compact('model'));
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
//        $model=Client::findOrfail($id);
//        $model->update($request->all());
//        flash()->success("تم التفعيل");
//        return redirect(route('client.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Client::findOrfail($id);
        $record->delete();
        flash()->success("تم الحذف");
        return back();
    }
    public function changeStatus(Request $request,$id){

        $client = Client::findOrFail($id);
        if ($client->is_active == 1){

            $client->is_active = 0;
        }
        elseif ($client->is_active == 0)

        {
            $client->is_active = 1;

        }
        $client->save();

        return back();

        }
}
