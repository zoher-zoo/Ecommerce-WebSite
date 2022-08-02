<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    
<base href="/public">

    @include('admin.css')
    <style>
      .div_center{ text-align: center; padding-top: 40px; }
      .font_size{  padding-bottom: 30px; }
      .text_color{ color: black;  }
       label{ display: inline-flex; width: 180px;  }
       .div_design{ padding-bottom: 15px;   }

      
  </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.navbar')
        <!-- partial -->
       
        <div class="main-panel">
          <div class="content-wrapper">

            @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}

            </div>
                
            @endif
            <div class="div_center">
               <h1 class="font_size">Update Product</h1>

                <form action="{{url('/update_product_confirm',$product->id)}}" method="post" enctype="multipart/form-data">

                  @csrf

               <div class="div_design">
               <label>Product Title :</label>
               <input class="text_color" type="text" name="title" placeholder="write a title" required
               value="{{$product->title}}">
              </div>

              <div class="div_design">
                <label>Product Description :</label>
                <input class="text_color" type="text" name="description" placeholder="write a description" required
                value="{{$product->description}}">
               </div>

               <div class="div_design">
                <label>Product Price :</label>
                <input class="text_color" type="number" name="price" placeholder="write a price" required
                value="{{$product->price}}">
               </div>

               <div class="div_design">
                <label>Discount :</label>
                <input class="text_color" type="number" name="discount" placeholder="discount"
                value="{{$product->discount_price}}">
               </div>

               <div class="div_design">
                <label>Product Quantity :</label>
                <input class="text_color" type="number" min="0" name="quantity" placeholder="write a quantity" required
                value="{{$product->quantity}}">
               </div>

               <div class="div_design">
                <label>Product Catagory :</label>
                <select class="text_color" name="catagory" id="" required>
                  <option  value="{{$product->catagory}}" selected> value="{{$product->catagory}}"</option>

                  @foreach ($catagory as $catagory)
                  
                  <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>

                  @endforeach 

                </select>
               </div>
                
               <div class="div_design">
                <label>Current Product image :</label>
               <img height="80" width="80" src="/product/{{$product->image}}" alt="">
               </div>



               <div class="div_design">
                <label>Change Product image :</label>
                <input type="file" name="image" id="" >
               </div>

               <div class="div_design">
                <input type="submit" value="Update Product" class="btn btn-primary">
               </div>

              </form>

            </div>
          </div>
        </div>


    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>