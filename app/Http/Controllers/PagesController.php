<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	$title = "Welcome to laravel";
    	return view("pages.index")->with('title',$title);
    }
    public function about(){
    	$title = "About us";
    	return view("pages.about")->with('title',$title);
    }
    public function services(){
    	$title = "Services";
    	$data = array(
    		'title' =>'Services' ,
    		'services' => ['Web design', 'Database control']
    	 );
    	return view("pages.services")->with($data);
    }
    public function editInfo(){
    	$title = "Editing info";
    	return view("pages.edit-info")->with('title',$title);
    }
     public function profile()
    {
        return view('profile.profile');
    }
}
