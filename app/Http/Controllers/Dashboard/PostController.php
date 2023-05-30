<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
//use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return route("post.create");
        
        //return route("post.create");
        //return redirect()->route("post.create");
        //return to_route("post.create");
        $posts = Post::paginate(2);
        return view('dashboard.post.index', compact('posts'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('id', 'title');
        $post = new Post();
        //dd($categories);

        echo view('dashboard.post.create', compact('categories', 'post'));

        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //$categories = Category::get();

       // $validated = $request->validate('Request');

        //dd($data);
        //$validated = $request->validate(StoreRequest::myRules());
        // dd($validated);

        //$data = array_merge($request->all(),['image' => '']);
        // //dd($data);
        // $data = $request->validated();
        // $data['slug']=Str::slug($data['title']);
        // dd($data);
        Post::create($request->validated());

        return to_route("post.index")->with('status',"Se registro correctamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //echo "Hola";
        return view("dashboard.post.show",compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id', 'title');

        echo view('dashboard.post.edit', compact('categories','post'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        //dd($request->validated());
        $data = $request->validated();
        if(isset ($data["image"])){


            $data["image"] = $filename = time().".".$data["image"]->extension();
            $request->image->move(public_path("image/otro"), $filename);
        }
        $post->update($data);
        //$request->session()->flash('status',"Registro actualizado");
        return to_route("post.index")->with('status',"Registro actualizado");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        
        $post->delete();
        return to_route("post.index")->with('status',"Registro Eliminado");
    }
}
