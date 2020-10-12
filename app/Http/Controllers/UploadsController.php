<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use App\Models\Homework;
use DB;
use Auth;


class UploadsController extends Controller
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
        $uploads = Upload::all();
        return view("uploads.index")->with('uploads', $uploads);
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
            'teacher_hw'=>'required|mimes:txt,c,cpp,doc',
        ]);
        if ($request->hasFile('teacher_hw')){
            //get filename with ext
            $filenameWithExt = $request->file('teacher_hw')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //upload it
            $path = $request->file('teacher_hw')->storeAs('public/teacher_hw', $filenameWithExt);
            // $isCopy = copy("/storage/ssd1/701/15094701/storage/app/public/teacher_hw/".$filenameWithExt, "/storage/ssd1/701/15094701/public_html/storage/teacher_hw/".$filenameWithExt);
        }
        $upload = new Upload;
        $upload->name=$request['name'];
        $upload->filename = $filenameWithExt;
        $upload->save();
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
        $upload = Upload::find($id);
        $homeworks = Homework::where('hwID',$id)->get();
        $myHomeworks = Homework::where('fromUser',Auth::user()->username)->get();
        return view('uploads.show')->with('upload',$upload)->with('homeworks',$homeworks)->with('myHomeworks',$myHomeworks);
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
    public function getFile($id)
    {
        $file = Upload::where('id', $id)->first();
        return response()->download(storage_path('app\public\teacher_hw\\'.$file->filename));
    }
}
