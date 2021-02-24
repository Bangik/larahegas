<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    return view('admin.categories.index', compact('categories'));
  }
  public function create()
  {
    return view('admin.categories.create');
  }
  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required'
    ]);

    $category = new Category();
    $category->name = $request->name;
    $category->save();
    toastr()->success('Data has been added successfully!');

    return redirect()->route('categories');
  }
  public function edit($id)
  {
    $category = Category::find($id);

    return view('admin.categories.edit', compact('category'));
  }
  public function update(Request $request, $id)
  {
    $category = Category::find($id);
    $category->name = $request->name;
    $category->save();
    toastr()->success('Data has been updated successfully!');
    return redirect()->route('categories');
  }
  public function delete($id)
  {
    $category = Category::find($id);
    $category->delete();
    toastr()->success('Data has been deleted successfully!');
    return redirect()->route('categories');
  }
}
