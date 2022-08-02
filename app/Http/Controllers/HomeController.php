<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Session;

class HomeController extends Controller
{
    public function redirect(){
           $usertype=Auth::user()->usertype;

           if($usertype=='1'){
            return view('admin.home');
           }

         else
           {
            $product=product::paginate(10);
            return view('home.userpage',compact('product'));           }
    }

    public function index() {
      $product=product::paginate(10);
      return view('home.userpage',compact('product'));
     }

     public function product_details($id) {
      $product=product::find($id);
      return view('home.product_details',compact('product'));
     }

     public function add_cart(Request $request,$id) {

      if(Auth::id())
      {
       $user=Auth::user();
       //dd($user);
       $product=Product::find($id);
       $cart=new Cart;
       //user data to cart
       $cart->name=$user->name;
       $cart->email=$user->email;
       $cart->phone=$user->phone;
       $cart->address=$user->address;
       $cart->user_id=$user->id;
       //product data to cart
       $cart->product_title=$product->title;

       if($product->discount_price!=null)
       {
        $cart->price=$product->discount_price * $request->quantity;
       }
       else
       {
       $cart->price=$product->price * $request->quantity;
       }
       $cart->product_id=$product->id;
       $cart->image=$product->image;
       //quantity from form to cart
       $cart->quantity=$request->quantity;
 
       $cart->save();

       return redirect()->back();

      }
      else
      {
        return redirect('login')->with('status','You Are Not Login');
      }

     }

    
}
