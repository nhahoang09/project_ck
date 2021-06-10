<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class CheckQuantityController extends Controller
{
    public function checkQuantity($id, Request $request)
    {
        //// get quantity from Form Request
        $quantity = $request->quantity;

        // get quantity from data
        $product = Product::findOrFail($id);
        $quantityDB = $product->quantity;

        if ($quantity > $quantityDB) {
            return response()->json(['message' => 'The product is out stock.'], 500);
        }

        // default show success message
        return response()->json(['message' => 'The product is in stock.']);
    }
}
