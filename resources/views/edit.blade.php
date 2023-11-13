@extends('layouts.master')


@section('content')

<div class="main-content mt-5">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Editar Postagem</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="#" class="btn btn-success mx-1">Voltar</a>
                </div>

            </div>

        </div>

        <div class="card-body">
          <form action="">
            <div class="form-group">
               <div>
                 <img style="width: 200px" src="{{asset($post->image)}}" alt="">
               </div>
                <label for="" class="form-label">Imagem</label>
                <input type="file" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Título</label>
                <input type="text" class="form-control" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label for="" class="form-label">Categoria</label>
               <select name="" id="" class="form-control">
                <option value="">Select</option>
                   @foreach($categories as $category)
                    <option {{$category->id == $post->category_id ? 'selected' : ''}}value="{{ $category->id }}">{{$category->name}}</option>
                   @endforeach
               </select>
            </div>
           
            <div class="form-group">
                <label for="" class="form-label">Descrição</label>
                <textarea name="" class="form-control" id="" cols="30" rows="10">{{$post->description}}</textarea>
            </div>
            <div class="form-group mt-3">
               <button class="btn btn-primary">Enviar</button>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection