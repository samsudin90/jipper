<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Bahan;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index() {
        $title = "Home";
        return View('dashboard.index', compact('title'));
    }

    // Category

    public function indexCategory() {
        $title = "Category";
        $data = Category::all();
        return View('dashboard.category', compact(['data', 'title']));
    }

    public function storeCategory(Request $request) {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        Category::create($validated);

        return redirect('/admin/category')->with(['success' => 'add category success']);

    }

    public function editCategory($id) {
        $data = Category::findOrFail($id);

        return View('dashboard.categoryDetail', compact('data'));
    }

    public function updateCategory(Request $request, $id) {
        $validated = $request->validate(['name' => 'required']);

        $cat = Category::findOrFail($id);

        $cat->update([
            'name' => $request->name
        ]);

        return redirect('/admin/category')->with(['success' => 'update category success']);
    }

    public function destroyCategory($id) {
        $cat = Category::findOrFail($id);

        $cat->delete();

        return redirect('/admin/category')->with(['success' => 'delete category success']);
    }

    // Material

    public function indexMaterial() {
        $title = "Material";
        $data = Bahan::all();
        // dd($data);
        return View('dashboard.material', compact(['data', 'title']));
    }

    public function storeMaterial(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Bahan::create([
            'nama' => $request->name,
            'deskripsi' => $request->description
        ]);

        return redirect('/admin/material')->with(['success' => 'add material success']);
    }

    public function editMaterial($id) {
        $data = Bahan::findOrFail($id);

        return View('dashboard.materialDetail', compact('data'));
    }

    public function updateMaterial(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $mat = Bahan::findOrFail($id);

        $mat->update([
            'nama' => $request->name,
            'deskripsi' => $request->description
        ]);

        return redirect('/admin/material')->with(['success' => 'update material success']);
    }

    public function destroyMaterial($id) {
        $cat = Bahan::findOrFail($id);

        $cat->delete();

        return redirect('/admin/material')->with(['success' => 'delete material success']);
    }

    // product
    public function indexProduct() {
        $title = "Product";
        $data = Product::all();
        $bahan = Bahan::all();
        
        return View('dashboard.product', compact(['data', 'title', 'bahan']));
    }

    public function storeProduct(Request $request) {
        // $d = 1;
        // if(empty($request->design_only)) {
        //     $d = 2;
        // }
        // dd($d);
        $validated = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        $design_only = 0;
        $harga = 0;
        $harga_design = 0;

        if(empty($request->design_only)) {
            $harga = $request->harga;
            $harga_design = $request->harga_design;
        } else {
            $design_only = $request->design_only;
            $harga_design = $request->harga_design;
        }

        Product::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $harga,
            'harga_design' => $harga_design,
            'design_only' => $design_only
        ]);

        return redirect('/admin/product')->with(['success' => 'add product success']);
    }

    public function editProduct($id) {
        $data = Product::findOrFail($id);
        $mat = Bahan::all();
        // dd($data->materials);
        return View('dashboard.productDetail', compact('data', 'mat'));
    }

    public function updateProduct(Request $request, $id) {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'mat' => 'required'
        ]);

        $prod = Product::findOrFail($id);

        if($request->mat[0] != "kosong") {
            $prod->bahans()->detach($request->mat);
        }

        $prod->bahans()->attach($request->materials);

        $prod->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id
        ]);

        return redirect('/admin/product')->with(['success' => 'update product success']);
    }
    
    public function destroyProduct($id) {
        $prod = Product::findOrFail($id);
        
        foreach ($prod->images as $i) {
            $img = Image::findOrFail($i->id);

            unlink(storage_path('app/public/products/'.$img->path));
            $img->delete();
        }

        $prod->delete();

        return redirect('/admin/product')->with(['success' => 'delete product success']);
    }

    // images
    public function addImage($id) {
        $data = Product::findOrFail($id);

        return View('dashboard.addImage', compact('data'));
    }
    

    public function storeImage(Request $request) {
        $validated = $request->validate([
            'product_id' => 'required',
            'images' => 'required'
        ]);

        foreach ($request->file('images') as $img) {
            $img->storeAs('public/products', $img->hashName());
            Image::create([
                'product_id' => $request->product_id,
                'path' => $img->hashName()
            ]);
        }

        return redirect('/admin/product')->with(['success' => 'add images success']);
    }

    public function destroyImage($id) {
        $img = Image::findOrFail($id);

        unlink(storage_path('app/public/products/'.$img->path));
        $img->delete();
        
        return redirect()->back()->with(['success' => 'delete images success']);
        
    }

    // produk material
    public function addMaterial($id) {
        $data = Product::findOrFail($id);
        $mat = Bahan::all();

        return View('dashboard.addMaterial', compact(['data', 'mat']));
    }

    public function storeProductMaterial(Request $request) {
        // dd($request);
        $validated = $request->validate([
            'product_id' => 'required',
            'materials' => 'required'
        ]);

        $product = Product::findOrFail($request->product_id);
        $product->bahans()->attach($request->materials);

        return redirect('/admin/product')->with(['success' => 'add material to product success']);
    }
}
