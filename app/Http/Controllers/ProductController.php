<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index()
    {  
        $product  = Product::all();  
        return response()->json($product);  
    }
  
    public function getProduct($id)
    {  
        $product  = Product::find($id);  
        return response()->json($product);
    }
  
    public function createProduct(Request $request)
    {
    	$headerStatus = 400;
    	$body = $request->all();
    	if (empty($body)) {
    		$product = [
    			'error' => true,
    			'message' => 'Body cannot be empty/must be JSON'
    		];
    	} else {
    		$headerStatus = 200;
    		$product = [];
    		if (isset($body[0])) {
    			foreach ($body as $field) {
    				if (is_array($field)) {
    					$product[] = Product::create($field);
    				}
    			}
    		} else {
    			$product = Product::create($body);
    		}
    	}

        return response()->json($product, $headerStatus);  
    }
  
    public function updateProduct(Request $request, $id)
    {
        $product  = Product::find($id);

        $product->order_id = $request->input('order_id');
        $product->product_id = $request->input('product_id');
        $product->user_id = $request->input('user_id');
        $product->rating = $request->input('rating');
        $product->review = $request->input('review');
        $product->save();
  
        return response()->json($product);
    }

    public function deleteProduct($id)
    {
        $product  = Product::find($id);
        $message = "";
        if ($product) {
        	$product->delete();
        	$message = "Id: {$id} is deleted successfully";
        } else {
        	$message = "Id: {$id} is deleted or not found";
        }
 
        return response()->json($message);
    }
}
