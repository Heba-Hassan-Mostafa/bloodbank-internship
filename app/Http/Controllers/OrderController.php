<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records=Order::where(function ($query) use ($request){
            if($request->has('search')){
                $query->whereHas('client',function ($client) use($request){
                    $client->where('name','like','%'.$request->search.'%');
                });
            $query->orWhere(function ($query) use($request){
                $query->where('patient_name','like','%'.$request->search.'%');
                 // ->orwhere('bloodtype','like','%'.$request->search.'%');
            });
            }
        })->latest()->paginate();

        return view('orders.index',compact('records'));
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
    public function show(Request $request,$id)
    {
        $orders=Order::where(function ($query) use ($request){
                $query->where(function ($query) use($request){
                    $query->where('patient_name','like','%'.$request->search.'%');
                    // ->orwhere('bloodtype','like','%'.$request->search.'%');
                });

        })->latest()->paginate();
       // $orders=Order::find($id);
        return view('orders.show',compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Order::findOrfail($id);
        $record->delete();
        flash()->success("تم الحذف");
        return back();
    }
}
