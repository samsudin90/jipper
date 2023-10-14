<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index() {
        $title = 'Home';

        $product = Product::all();

        $user = Auth::user();
        return view('home', compact('title', 'product', 'user'));
    }

    public function detail($id) {
        $product = Product::findOrFail($id);
        $title = $product->nama;
        $user = Auth::user();

        return View('shop.detail', compact(['title', 'product', 'user']));
    }

    public function product($name) {
        $title = $name;
        $user = Auth::user();
        $product = Product::where('nama', $name)->get();
        $design = 'no';

        return view('shop.product', compact('title', 'user', 'product', 'design'));
    }
    
    public function design($name) {
        $title = $name;
        // dd($name);
        $user = Auth::user();
        $product = Product::where('nama', $name)->get();
        $design = 'yes';

        return view('shop.product', compact('title', 'user', 'product', 'design'));
    }

}
