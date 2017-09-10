<?php
namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\User;
use App\Post;
use App\CustomCollection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Model;
use Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Http\Controllers\Controller;
use DB;
use Session;

class Front extends Controller {

    var $brands;
    var $categories;
    var $products;
    var $title;
    var $description;

    public function __construct() {
        $this->brands = Brand::all(array('name'));
        $this->categories = Category::all(array('name'));
        $this->products = Product::all(array('id','name','price'));
    }

public function register() {
    if (Request::isMethod('post')) {
        User::create([
                    'name' => Request::get('name'),
                    'email' => Request::get('email'),
                    'password'=>bcrypt(Request::get('password')),
        ]);
    } 
    
    return Redirect::away('auth/login');
}

public function authenticate() {
    if (Auth::attempt(['email' => Request::get('email'), 'password' => Request::get('password')])) {
        //return url('/welcome1');
        return redirect('/welcome');
    } else {
        
        Session::flash('Error','Username and password doesn not match.');
        return Redirect::away('login');
    }
}


    public function index() {
        if(Auth::check()){
            return view('welcome');
        }else{
            $blogs = Post::all();
            //return $results->heading;
            //$results =DB::table('blogs')->pluck('heading');
            //$id = DB::table('blogs')->pluck('id');
            //return $blogs;
            return view('home',array('title' => 'Products Listing','description' => '','page' => 'products', 'brands' => $this->brands, 'categories' => $this->categories, 'products' => $this->products,'teststring'=>$blogs->toArray())); 
        }
        //return $result = DB::select('select * from brands where id=1');
    }







 




    public function login() {
        return view('login', array('title' => 'Welcome','description' => '','page' => 'home'));
    }

 //   public function logout() {
  //      return view('login', array('title' => 'Welcome','description' => '','page' => 'home'));
 //   }

public function logout() {
    Auth::logout();
    
    return Redirect::away('login');
}







}
