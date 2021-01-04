<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::orderBy('id', 'DESC')->get());

    }

    public function categoryProduct($category_id)
    {
        if ($category_id == 'all') {
            $categories = ProductResource::collection(Product::orderBy('id', 'DESC')->get());

        } else {
            $categories = ProductResource::collection(Product::orderBy('id', 'DESC')->where('category_id', $category_id)->get());

        }
        return $categories;
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'productName' => 'required',
        ]);

        return Product::create([
            'productName' => $request->productName,
            'category_id' => $request->category_id
        ]);
    }

    public function updateProduct(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'productName' => 'required',
        ]);
        $item['productName'] = $request->productName;
        $item['category_id'] = $request->category_id;

        Product::find($request->productId)->update($item);
        return response()->json('Updated');

    }

    public function deleteProduct($id)
    {
        Product::findorFail($id)->delete();
        return response()->json('deleted');
    }
}
