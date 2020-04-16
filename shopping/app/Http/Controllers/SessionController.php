<?php

namespace App\Http\Controllers;

use App;
use App\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      
            $sessions= new UserSession();
            $sessions->product_id=$request->product_id;
            $sessions->qty=$request->qty;
            $sessions->sessionID=$request->sessionID;
            $sessions->save();
        return 200;
    }

    public function getSession($id)
    {

        $response=DB::table('user_sessions')
        ->join('product_details','user_sessions.product_id','=','product_details.id')
        ->where('user_sessions.sessionID',$id)
        ->select('user_sessions.qty as userQty','user_sessions.id as sessionID','product_details.*')->get();
        return $response;
    }


    public function deleteSession(Request $request)
    {
        UserSession::where('id',$request->id)->delete();
        
            return 200;
         
       // UserSession::where('sessionID',$request->id)->delete()->save();
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserSession  $userSession
     * @return \Illuminate\Http\Response
     */
    public function show(UserSession $userSession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserSession  $userSession
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSession $userSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserSession  $userSession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserSession $userSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserSession  $userSession
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSession $userSession)
    {
        //
    }
}
