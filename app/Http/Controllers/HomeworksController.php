<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homework;
use Auth;
use DB;

class HomeworksController extends Controller
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
            'student_hw'=>'required|mimes:txt,c,cpp,doc',
        ]);
        if ($request->hasFile('student_hw')){
            //get filename with ext
            $filenameWithExt = $request->file('student_hw')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //upload it
            $path = $request->file('student_hw')->storeAs('public/student_hw', $filenameWithExt);
        }
        $homework = new homework;
        $homework->hwID=$request['hwID'];
        $homework->fromUser=Auth::user()->username;
        $homework->filename = $filenameWithExt;
        $homework->save();
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
        $homework = homework::find($id);
        return view('homeworks.show')->with('homework',$homework);
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
    public function getFile($id)
    {
        $file = Homework::where('id', $id)->first();
        return response()->download(storage_path('app\public\student_hw\\'.$file->filename));
    }

}
