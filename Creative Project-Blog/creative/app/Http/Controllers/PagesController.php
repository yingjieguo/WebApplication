<?php

namespace App\Http\Controllers;
class PagesController extends Controller {
	public function getIndex()
	{
		return view('welcome1');
	}
	public function getallindex(){
		return view('posts/index');
	}
	public function getAbout()
	{
		return view('pages/about');
	}
	public function getContact()
	{
		return view('pages/contact');
	}
	// public function postContact()
	// {

	// }
}