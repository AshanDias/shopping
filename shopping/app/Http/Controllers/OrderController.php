<?php

namespace App\Http\Controllers;

use App\Order;
use App\UserSession;
use App\OrderIndexValue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        // $response=DB::table('orders')
        // ->Join('products','products.id','=','orders.product_details_id')
        //  ->select('orders.*','products.name as shortName')->get(); 

       // $response=DB::table('orders')->groupBy('mobile')->get();
         
       // $response=DB::table('orders')
        $response=Order::select('orders.*','products.name as productName','product_details.shortName',DB::raw('SUM(amount) as total_points'))
        ->join('product_details','orders.product_details_id','=','product_details.id')
        ->Join('products','products.id','=','product_details.product_id')
         ->groupBy('orders.order_index_values')
         ->get(); 
         
     //  ->select('orders.*','products.name as productName','product_details.shortName')
           // $response=$response->groupBy('orders.mobile');
        return $response;

    }

    public function getDetailsById(Request $request)
    {
     
        $response=DB::table('orders')
        ->join('product_details','orders.product_details_id','=','product_details.id')
        ->Join('products','products.id','=','product_details.product_id')
        ->where('orders.order_index_values',$request->id)
         ->select('orders.*','products.name as productName','product_details.shortName')
        
         ->get(); 
         return $response;
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

        try{
           
           
           
            DB::beginTransaction();

        $sessionId=$request->sessionID;
            
     
        $maxOrder=OrderIndexValue::max('index_no');

     

        $response=DB::table('user_sessions')
        ->join('product_details','user_sessions.productDetail_id','=','product_details.id')
        ->where('user_sessions.sessionID',$sessionId)
        ->select('user_sessions.qty as userQty','product_details.*')->get();

        if($response->isEmpty()){
            return "empty";
        }
        
         
        foreach($response as $row)
        {
            $order= new Order();
            $order->product_details_id=$row->id;
            $order->userName=$request->f_name;
            $order->email=$request->email;
            $order->qty=$row->userQty;
            $order->amount=$row->price*$row->userQty;
            $order->address=$request->address;
            $order->mobile=$request->phone;
            $order->status=0;
            $order->order_index_values=$maxOrder;
            $order->save();


        }

        UserSession::where('sessionID',$sessionId)->delete();

        $maxOrder++;
        $orderValue=OrderIndexValue::first();
        $orderValue->index_no=$maxOrder;
        $orderValue->save();

     //   $maxOrderDetail=OrderIndexValue::wh

        DB::commit();
        return 200;
        
        }catch(Exception $ex)
        {
            DB::rollBack();
            return 500;
        }
        
    }

    public function delever(Request $request)
    {
        $order=Order::find($request->id);
        $order->status=1;
        $order->save();
        return 200;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Request $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $order)
    {
        //
    }
}
