<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        //Carregamento das categorias
        $categories = Category::all();
        return view('create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validações
      $request->validate([
        'image' => ['required', 'max:2028', 'image'],
        'title' => ['required', 'max:255'],
        'category_id' => ['required','integer'],
        'description' => ['required'],
      ]);

     //Upload da imagem

     $fileName = time().'_'.$request->image->getClientOriginalName(); 
     $filePath = $request->image->storeAs('uploads', $fileName, 'public');//uploads/fileName
     
     //Criar o post
     $post = new Post();
     $post->title = $request->title;
     $post->category_id = $request->category_id;
     $post->description = $request->description;
     $post->image = 'storage/'.$filePath; //storage/uploads/fileName
     $post->save();
    
     return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrfail($id);
        $categories = Category::all();
        return view('edit',compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Validações

        $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => ['required', 'integer'],
            'description' => ['required']
        ]);

      

        $post = Post::findOrfail($id);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'max:2028', 'image'],
            ]);
            
            //Uploads de imagem
            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $filePath = $request->image->storeAs('uploads', $fileName, 'public'); //uploads/fileName

            File::delete(public_path($post->image));

            $post->image = 'storage/'.$filePath; //storage/uploads/fileName
        }

        //Criar o post

        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->description = $request->description;

        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
