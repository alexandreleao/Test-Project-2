@extends('layouts.master')


@section('content')

<div class="main-content mt-5">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Postagens destruídas</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{route('posts.create')}}" class="btn btn-success mx-1">Criar</a>
                    <a href="#" class="btn btn-warning mx-1">Destruir</a>
                </div>

            </div>

        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered border-dark">
                <thead style="background:#f2f2f2">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" style="width: 10%">Imagem</th>
                        <th scope="col" style="width: 20%">Titulo</th>
                        <th scope="col" style="width: 30%">Descrição</th>
                        <th scope="col" style="width: 10%">Categoria</th>
                        <th scope="col" style="width: 10%">Data de Publicação</th>
                        <th scope="col" style="width: 20%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>
                            <img src="{{asset($post->image)}}" alt="" width="80">
                        </td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->description}}</td>
                        <td>{{$post->category_id}}</td>
                        <td>{{date('d/m/Y', strtotime($post->created_at))}}</td>
                        <td>
                            <div class="d-flex">
                            <form action="{{route('posts.restore', $post->id)}}" method="POST" style="display: inline">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn-sm btn-success">Restaurar</button>
                            </form>
                            <form action="{{route('posts.destroy', $post->id)}}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection