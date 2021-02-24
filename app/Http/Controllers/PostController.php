<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

class PostController extends Controller
{
  public function index()
  {
    $posts = Post::all()->sortDesc();
    return view('admin.post.index', compact('posts'));
  }
  public function create(){
    $categoris = Category::all();
    return view('admin.post.create', compact('categoris'));
  }
  public function store(Request $request)
  {
    $this->validate($request, [
      'title' => 'required',
      'category_id' => 'required',
      'content' => 'required'
    ]);

    $post = new Post();
    $post->title = $request->title;
    $post->slug = Str::slug($request->title);
    $post->category_id = $request->category_id;
    $post->content = $request->content;

    $imagePath = "";
    if ($request-> hasFile('featured')) {
      $image = $request->featured;
      $imageName = time().$image->getClientOriginalName();
      $image->move('uploads/post/', $imageName);
      $imagePath = 'uploads/post/'.$imageName;
    }

    $post->featured = $imagePath;
    $post->save();

    toastr()->success('Data has been added successfully!');

    return redirect()->route('posts');
  }
  public function edit($id)
  {
    $categoris = Category::all();
    $keypost = Post::find($id);
    return view('admin.post.edit', compact('keypost', 'categoris'));
  }
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'title' => 'required',
      'category_id' => 'required',
      'content' => 'required'
    ]);

    $keypost = Post::find($id);
    $keypost->title = $request->title;
    $keypost->category_id = $request->category_id;
    $keypost->content = $request->content;

    if ($request->hasFile('featured')) {
      if (file_exists($keypost->featured)) {
        unlink($keypost->featured);
      }
      $image = $request->featured;
      $imageName = time().$image->getClientOriginalName();
      $image->move('uploads/post/', $imageName);
      $keypost->featured = 'uploads/post/'.$imageName;
    }

    $keypost->save();

    toastr()->success('Data has been updated successfully!');

    return redirect()->route('posts');
  }
  public function buang($id)
  {
    $keypost = Post::find($id);
    $keypost->delete();
    toastr()->success('Data has been trashed successfully!');

    return redirect()->route('posts');
  }
  public function trashed()
  {
    $posts = Post::onlyTrashed()->get();

    return view('admin.post.trashed', compact('posts'));
  }
  public function restore($id)
  {
    $post = Post::withTrashed()->where('id', $id)->first();
    $post->restore();
    toastr()->success('Data has been restored successfully!');
    return redirect()->back();
  }
  public function delete($id)
  {
    $keypost = Post::withTrashed()->where('id', $id)->first();;
    $keypost->forceDelete();
  
    if (file_exists($keypost->featured)) {
      unlink($keypost->featured);
    }
    toastr()->success('Data has been deleted successfully!');

    return redirect()->back();
  }
  public function upload(Request $request)
  {
    if($request->hasFile('upload')) {
      $originName = $request->file('upload')->getClientOriginalName();
      $fileName = pathinfo($originName, PATHINFO_FILENAME);
      $extension = $request->file('upload')->getClientOriginalExtension();
      $fileName = $fileName.'_'.time().'.'.$extension;
      $request->file('upload')->move(public_path('uploads/img-post'), $fileName);
      $CKEditorFuncNum = $request->input('CKEditorFuncNum');
      $url = asset('uploads/img-post/'.$fileName);
      $msg = 'Image successfully uploaded';
      $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

      @header('Content-type: text/html; charset=utf-8');
      echo $response;
    }
  }
}
