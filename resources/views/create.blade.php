@extends('layouts.master')


@section('content')

<div class="main-content mt-5">
    @if($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-danger">{{$error}}</div>
    @endforeach
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Criação de Postagem</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="#" class="btn btn-success mx-1">Voltar</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Imagem</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Título</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Categoria</label>
                    <select id="" class="form-control" name="category_id">
                        <option value="">Select</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="form-label">Descrição</label>
                    <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group mt-3">
                    <button class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection