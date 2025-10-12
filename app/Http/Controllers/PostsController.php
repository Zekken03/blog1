<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        $posts= Post::all();
        return view('admin.posts')->with('posts',$posts);
    }
    public function showAdd() {
        $categories = Category::all();

            return view('admin.post_add')
                ->with('categories', $categories);
    }
    public function store (Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category_id'=>'required'
        ], [
            'title.required' => 'El título es obligatorio.',
            'content.required' => 'El contenido es obligatorio.',
            'image.image' => 'Debe ser una imagen válida.',
            'category_id.required' => 'Seleccione una categoria'
        ]);

        $file = $request->file('image');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        //debe crear la carpeta posts en public
        $file->move(public_path('posts/'), $filename);
        
        $post = new Post();
        $post->title=$request->title;
        $post->description=$request->description;
        $post->content=$request->content;
        $post->img=$filename;
        $post->category_id=$request->category_id;
        $post->likes=0;
        $post->user_id=Auth::user()->id;//el que esta loggeado
        $post->save();
        
        return redirect()
            ->back()
            ->with('success', "Post insertado correctamente");
    }
}
