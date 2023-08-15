<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    //
    public function products() {
        $products = Product::latest()->paginate(5);
        return view('products', compact('products'));
    }

    public function addProduct(REQUEST $request){
        $request->validate([
            'name'=>'required|unique:products',
            'price'=>'required',                                                                                    
        ], [
            'name.required'=>'Name is required',
            'name.unique'=>'Product Already Exits!',
            'price.required'=>'Price is required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return response()->json([
            'status'=>'success',
        ]);
    }


    public function updateProduct(REQUEST $request){
        $request->validate([
            'up_name'=>'required|unique:products,name,'.$request->up_id,
            'up_price'=>'required',                                                                                    
        ], [
            'up_name.required'=>'Name is required',
            'up_name.unique'=>'Product Already Exits!',
            'up_price.required'=>'Price is required',
        ]);

        Product::where('id', $request->up_id)->update([
            'name'=>$request->up_name,
            'price'=>$request->up_price,
        ]);
        return response()->json([
            'status'=>'success',
        ]);
    }

    public function deleteProduct(REQUEST $request) {
        $product_id = $request->product_id;
        Product::where('id', $product_id)->delete();
        
        return response()->json([
            'status'=>'success',
        ]);
    }

    public function pagination(REQUEST $request) {
        $products = Product::latest()->paginate(5);
        return view('pagination_products', compact('products'))->render();
        
    }

    // Search Product
    public function searchProduct(REQUEST $request) {
        $products = Product::where('name', 'like', '%'.$request->search_string.'%')
        ->orWhere('price', 'like', '%'.$request->search_string.'%')
        ->orderBy('id','desc')
        ->paginate(5);

        if($products->count() >= 1) {
            return view('pagination_products', compact('products'))->render();
        } else {
            return response()->json([
                'status'=>'nothing_found',
            ]);
        }
    }
}
