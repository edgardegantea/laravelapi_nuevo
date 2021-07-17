<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(StoreProductRequest $request)
    {
        Product::create($request->all());

        return response()->json([
            'res'   => true,
            'msg'   => 'Registro exitoso'
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'res'       => true,
            'product'   => $product
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return response()->json([
            'res'   => true,
            'msg'   => 'Actualización exitosa'
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'res'   => true,
            'msg'   => 'Se ha eliminado con éxito'
        ]);
    }
}
