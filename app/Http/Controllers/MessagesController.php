<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Message;
use DB;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        $this->validate($request, [
            'content' => ['required', 'string', 'max:255'],
        ]);
        $message = new Message;
        $message->fromID = Auth::user()->id;
        $message->toID = $request['toID'];
        $message->content = $request['content'];
        $message->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
    public function showMessages($id)
    {
        // $messages = Message::where('fromID',$id)->orWhere('toID',$id);
        $messages = Message::select(DB::raw("SELECT * FROM `messages` WHERE ('fromID'=0 AND `toID`=1) OR (`fromID`=1 AND `toID`=3) "))->all();
        return view('users.show')->with('messages',$messages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::find($id);
        return view('messages.edit')->with('message',$message);
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
        $this->validate($request, [
            'content' => ['required', 'string', 'max:255'],
        ]);
        $message = Message::find($id);
        $message->content = $request['content'];
        $message->save();
        if ($message->fromID == Auth::id()) $userID = $message->toID;
        else $userID = $message->fromID;
        return redirect(url('/').'/users/'.$userID);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::where('id',$id);
        $message->delete();
        return back();
    }
}
