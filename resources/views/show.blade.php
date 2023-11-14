@extends('layouts.master')


@section('content')

<div class="main-content mt-5">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Lista de Postagens</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{route('posts.create')}}" class="btn btn-success mx-1">Criar</a>
                    <a href="{{route('posts.trashed', $post->id)}}" class="btn btn-warning mx-1">Destruir</a>
                </div>

            </div>

        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered border-dark">
                
                <tbody>
                    
                  {{-- <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>
                            <img src="{{asset($post->image)}}" alt="" width="80">
                        </td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->description}}</td>
                        <td>{{$post->category_id}}</td>
                        <td>{{date('d/m/Y', strtotime($post->created_at))}}</td>
                        <td>
                            <a href="#" class="btn-sm btn-success">Listar</a>
                            <a href="{{route('posts.edit', $post->id)}}" class="btn-sm btn-primary">Editar</a>
                            <a href="{{route('posts.destroy', $post->id)}}" class="btn-sm btn-danger">Excluir</a>
                        </td>
                    </tr> --}}
                 <tr>
                    <td>Id</td>
                    <td>{{$post->id}}</td>
                 </tr>
                 <tr>
                    <td>Imagem</td>
                    <td><img src="{{asset($post->image)}}" alt="" width="80"></td>
                 </tr>
                 <tr>
                    <td>Título</td>
                    <td>{{$post->title}}</td>
                 </tr>
                 <tr>
                    <td>Descrição</td>
                    <td>{{$post->description}}</td>
                 </tr>
                 <tr>
                    <td>Categorias</td>
                    <td>{{$post->category_id}}</td>
                 </tr>
                 <tr>
                    <td>Data de Publicação</td>
                    <td>{{date('d/m/Y', strtotime($post->created_at))}}</td>
                 </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection