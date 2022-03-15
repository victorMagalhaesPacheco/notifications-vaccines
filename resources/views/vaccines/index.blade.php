@extends('adminlte::page')

@section('title', 'Vacinas')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Vacinas Cadastradas no Sistema</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Painel de Controle</a></li>
                    <li class="breadcrumb-item active">Vacinas Cadastradas no Sistema</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @include('flash-message')
    <div class="card">
        <div class="card-header">
            Ações
        </div>
        <div class="card-body">
            <a href="{{ route('vaccines.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Novo</button>
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="vaccines" class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data de criação do registro</th>
                        <th>#id</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vaccines as $vaccine)
                        <tr>
                            <td>{{ $vaccine->name }}</td>
                            <td data-order="{{ \Carbon\Carbon::parse($vaccine->created_at) }}">{{ \Carbon\Carbon::parse($vaccine->created_at)->format('d/m/Y H:i:s') ?? '---' }}</td>
                            <td>{{ (int)$vaccine->id }}</td>
                            <td>
                                <a href="{{ route('vaccines.create', ['id' => $vaccine->id]) }}" data-toggle="tooltip"
                                    data-placement="top" title="Atualizar registro">
                                    <i class="fas fa-pen"></i>
                                </a>&nbsp;
                                <a style="color: red;" title="Deletar registro?" href="#"
                                    data-href="{{ route('vaccines.delete', ['id' => $vaccine->id]) }}" data-toggle="modal"
                                    data-target="#confirm-delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
               
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    @include('modal',
        [
            'idModal' => 'confirm-delete',
            'title' => 'Confirmação',
            'message' => 'Você tem certeza que desejar remover o registro?',
            'type' => 'danger'
        ]
    )
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        });
    </script>
@stop
