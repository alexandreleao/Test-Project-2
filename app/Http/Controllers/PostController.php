<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use File;

class PostController extends Controller
{
    public function __construct()
    {
       // $this->middleware('authCheck2')->only(['create', 'show']);
       $this->middleware('authCheck2')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     
        $posts = Cache::remember('posts-page-'.request('page', 1), 60*3, function () {
            return Post::with('category')->paginate(2);
        });

        // $posts = Cache::rememberForever('posts', function () {
        //     return Post::with('category')->paginate(2);
        // });

        return view('index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $this->authorize('create_post');
        //Carregamento das categorias
        $categories = Category::all();
        return view('create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create_post');
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
    {   $this->authorize('edit_post');
        
        $post = Post::findOrfail($id);
        return view('show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('edit_post');

        $post = Post::findOrfail($id);
        $categories = Category::all();
        return view('edit',compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('edit_post');
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
     $this->authorize('delete_post');

      $post = Post::findOrfail($id);
      $post->delete();

      return redirect()->route('posts.index');
    }

    public function trashed()
    {   
        $this->authorize('delete_post');

         $posts = Post::onlyTrashed()->get();
         return view('trashed',compact('posts'));
    }

    public function restore($id)
    {   
        $this->authorize('delete_post');

        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $this->authorize('delete_post');

        $post = Post::onlyTrashed()->findOrFail($id);

        File::delete(public_path($post->image));
        
        $post->forceDelete();

        return redirect()->back();

        
    }
}
