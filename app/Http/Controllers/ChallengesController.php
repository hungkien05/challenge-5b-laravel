<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use DB;

class ChallengesController extends Controller
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
        $challenges = Challenge::all();
        return view("challenges.index")->with('challenges', $challenges);
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
            'name'=>'required|string|max:255',
            'hint'=>'required|string|max:255',
            'challenge-file'=>'required|mimes:txt,c',
        ]);
        if ($request->hasFile('challenge-file')){
            //get filename with ext
            $filenameWithExt = $request->file('challenge-file')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //upload it
            $path = $request->file('challenge-file')->storeAs('public/challenges', $filenameWithExt);
        }
        $challenge = new Challenge;
        $challenge->name=$request['name'];
        $challenge->hint=$request['hint'];
        $challenge->filename = $filename;
        $challenge->save();
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
        $challenge = Challenge::find($id);
        if (isset($isCorrect)) return 1;//view('challenges.show')->with('challenge',$challenge)->with("isCorrect", $isCorrect);
        else return view('challenges.show')->with('challenge',$challenge);
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
        //
    }
    public function check(Request $request)
    {
        $challenge = Challenge::find($request['chlID']);
        $this->validate($request, [
            'answer'=>'required|string|max:255|in:'.$challenge->filename,],
            ['in' => "Incorrect answer !",]
        );
        if ($request['answer']==$challenge->filename) return $this->show($challenge->id)->with("isCorrect",1);
        return $this->show($challenge->id)->with("isCorrect", 0);
    }
}
