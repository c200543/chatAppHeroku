<?php

namespace App\Http\Controllers;

use App\Events\callVideoEvent;
use App\Events\SendChat;
use App\Events\ReceiveMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class chatVideo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //


        return view("chatVideo");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $curl = curl_init();
        $sing = true;
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.agora.io/dev/v1/project',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('name' => 'chat 8'), array("enable_sign_key"=>$sing),
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Authorization: Basic ZTUwMDhkMjc2OGE0NDFmMGIwMzQzMjA2M2VkYzg3MTU6MTIyMmQ0M2QxNjE0NDkxYjljNzhmYjlhZjUxYWU4YjI='
        ),
        ));
        $user = Auth::user();
        $response = curl_exec($curl);
        curl_close($curl);
        broadcast(new callVideoEvent($user,$id,$response))->toOthers();
        return $response;
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
    public function receive($appId,$token,$channel) {
        return view('receive')  ->with("appId",$appId)
                                ->with("appToken",$token)
                                ->with("appChannel",$channel)
                                        ;

    }

}
