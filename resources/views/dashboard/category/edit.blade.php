@extends('dashboard.layout')

@section('content')
<h1>Actualizar category: {{  $category->title }}</h1>

//@include('dashboard.fragment._errors-form')

 <form action="{{ route( 'category.update', $category->id) }}" method= "post">
    
    @csrf
    @method("PATCH")
    @include('dashboard.fragment._errors-form')

    
     
    <label for="">Titulo</label>
    <input type="text" name="title" value="{{ old("title",  $category->title) }}">

    <label for="">Slug</label>
    <input type="text" name="slug" value="{{ old("slug",  $category->slug) }}">



    <button type="submit">Enviar</button>

   