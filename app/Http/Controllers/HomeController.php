<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Sample product data (this could be fetched from a database)
        $products = [
            ['id' => 1, 'name' => 'Product 1', 'price' => 29.99, 'image' => 'https://via.placeholder.com/150'],
            ['id' => 2, 'name' => 'Product 2', 'price' => 39.99, 'image' => 'https://via.placeholder.com/150'],
            ['id' => 3, 'name' => 'Product 3', 'price' => 49.99, 'image' => 'https://via.placeholder.com/150'],
            ['id' => 4, 'name' => 'Product 4', 'price' => 59.99, 'image' => 'https://via.placeholder.com/150'],
        ];

        return view('home', compact('products'));
    }
}
