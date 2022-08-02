<?php

namespace App\Http\Controllers;
use App\Models\Catagory;
use App\Models\Product;
use Illuminate\Http\Request;



class AdminController extends Controller
{
    public function view_catagory()
    {

        $data=Catagory::all();

return view('admin.catagory',compact('data'));

    }

    public function add_catagory(Request $request)
    {
$data=new catagory;
$data->catagory_name=$request->catagory;
$data->save;

return redirect()->back()->with('message','Catagory Added');
    }
         
     public function delete_catagory($id){
         $data=Catagory::find($id);
         $data->delete();
         return redirect()->back()->with('message','Catagory Deleted');
     }


     public function view_product(){
       $catagory=catagory::all();
        return view('admin.product',compact('catagory'));
    }


    public function add_product(Request $request){
       $product=new product;
       $product->title=$request->title;
       $product->description=$request->description;
       $product->price=$request->price;
       $product->quantity=$request->quantity;
       $product->discount_price=$request->discount;
       $product->catagory=$request->catagory;

       //save image in variable
       $image=$request->image;
       //image name with time function
       $imagename=time().'.'.$image->getClientOriginalExtension();
       //save image in product folder in public 
       $request->image->move('product',$imagename);
       $product->image=$imagename;

       $product->save();
       return redirect()->back()->with('message','Product Added');
    }

    public function show_product()
    {
          $product=product::all();
       
return view('admin.show_product',compact('product'));

    }
    public function delete_product($id)
    {
          $product=product::find($id);
          $product->delete();
       
          return redirect()->back()->with('message','Product Deleted');

    }
    public function update_product($id)
    {
         $product=Product::find($id);
         $catagory=Catagory::all();
       
          return view('admin.update_product',compact('product','catagory'));

    }

    public function  update_product_confirm(Request $request, $id)
    {
         $product=Product::find($id);

       $product->title=$request->title;
       $product->description=$request->description;
       $product->price=$request->price;
       $product->quantity=$request->quantity;
       $product->discount_price=$request->discount;
       $product->catagory=$request->catagory;

        //save image in variable
        $image=$request->image;
        if($image){
  //image name with time function
  $imagename=time().'.'.$image->getClientOriginalExtension();
  //save image in product folder in public 
  $request->image->move('product',$imagename);
  $product->image=$imagename;

        }
      
 
        $product->save();

          return redirect()->back()->with('message','Product Updated');
    }
   
}
