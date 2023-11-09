@extends('layouts.master')


@section('content')

<div class="main-content mt-5">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Destruir as Postagens</h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="" class="btn btn-success mx-1">Voltar</a>
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
                    <tr>
                        <th scope="row">1</th>
                        <td>
                            <img src="https://picsum.photos/200" alt="" width="80">
                        </td>
                        <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</td>
                        <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        </td>
                        <td>News</td>
                        <td>10/10/2022</td>
                        <td>
                            <a href="#" class="btn-sm btn-success">Listar</a>
                            <a href="#" class="btn-sm btn-primary">Editar</a>
                            <a href="#" class="btn-sm btn-danger">Excluir</a>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection