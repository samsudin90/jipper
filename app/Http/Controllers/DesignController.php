<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Design;
use App\Models\Product;
use App\Models\Category;
use App\Models\ImageDesign;

class DesignController extends Controller
{
    public function index() {
        $title = "design only";
        $data = Design::all();

        return View('design.index', compact(['title', 'data']));
    }

    public function indexManu() {
        $title = "design only and manufactur";
        $category = Category::all();
        $product = Product::all();

        return View('design.manu', compact(['title', 'product', 'category']));
    }

    public function indexAdmin() {
        $title = "Design";
        $data = Design::all();

        return View('dashboard.design', compact(['title', 'data']));
    }

    public function show($id) {
        $product = Design::findOrFail($id);
        $title = $product->name;

        return View('design.detail', compact(['title', 'product']));
    }

    public function showManu($id) {
        $product = Product::findOrFail($id);
        $title = $product->name;

        return View('design.manuDetail', compact(['title', 'product']));
    }

    public function addImage($id) {
        $data = Design::findOrFail($id);

        return View('dashboard.addImageDesign', compact('data'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        Design::create($validated);

        return redirect('/admin/design')->with(['success' => 'add design success']);
    }

    public function storeImage(Request $request) {
        $validated = $request->validate([
            'design_id' => 'required',
            'images' => 'required'
        ]);

        foreach ($request->file('images') as $img) {
            $img->storeAs('public/designs', $img->hashName());
            ImageDesign::create([
                'design_id' => $request->design_id,
                'path' => $img->hashName()
            ]);
        }

        return redirect('/admin/design')->with(['success' => 'add images success']);
    }

    public function edit($id) {
        $data = Design::findOrFail($id);
        
        return View('dashboard.designDetail', compact('data'));
    }

    public function update(Request $request, $id) {
        // dd($request);
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $prod = Design::findOrFail($id);

        $prod->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price
        ]);

        return redirect('/admin/design')->with(['success' => 'update design success']);
    }

    public function destroy($id) {
        $des = Design::findOrFail($id);
        
        foreach ($des->images as $i) {
            $img = ImageDesign::findOrFail($i->id);

            unlink(storage_path('app/public/designs/'.$img->path));
            $img->delete();
        }

        $des->delete();

        return redirect('/admin/design')->with(['success' => 'delete design success']);
    }

    public function destroyImage($id) {
        $img = ImageDesign::findOrFail($id);

        unlink(storage_path('app/public/designs/'.$img->path));
        $img->delete();
        
        return redirect()->back()->with(['success' => 'delete images success']);
        
    }
}
