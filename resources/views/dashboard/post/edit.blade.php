@extends('dashboard.layout')

@section('content')
<h1>Actualizar Post: {{ $post->title }}</h1>

//@include('dashboard.fragment._errors-form')

 <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
    
    @csrf
    @method("PUT")
    @include('dashboard.fragment._errors-form',["task" => "edit"])

    
     
    <label for="">Titulo</label>
    <input type="text" name="title" value="{{ old("title", $post->title) }}">

    <label for="">Slug</label>
    <input type="text" name="slug" value="{{ old("slug", $post->slug) }}">


    <label for="">Categoria</label>
    <select name="category_id">
        <option value=""></option>
        @foreach ($categories as $title => $id)
            <option {{ $post->category_id == $id ? "selected" : "" }} value="{{ $id }}">{{ $title }}</option>
        @endforeach
    </select>



    <label for="">Posteado</label>
    <select name="posted" id="">
        <option {{ $post->posted == "not" ? "selected" : "" }} value="not">No</option>
        <option {{ $post->posted == "yes" ? "selected" : "" }} value="yes">Si</option>
    </select>

    <label for="">Contenido</label>
    <textarea name="content">{{ $post->content }}</textarea>

    <label for="">Descripcion</label>
    <textarea name="description">{{ $post->description }} </textarea>

    //@if (isset($task) && $task == 'edit')
        //<label for="">Imagen</label> 
        //<input type="file" name="image">
    //@endif
    <label for="">Imagen</label> 
        <input type="file" name="image">

    <button type="submit">Enviar</button>

     //@if (isset($task) && $task == 'edit')
        <label for="">Imagen</label> 
        <input type="file" name="image">
    //@endif

 </form>
    
@endsection