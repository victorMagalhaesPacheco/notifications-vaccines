@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Operadores Cadastrados</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Painel de Controle</a></li>
                <li class="breadcrumb-item active">Operadores Cadastrados</li>
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
        <a href="{{ route('operators.create') }}">
            <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Novo</button>
        </a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table id="operators" class="table table-bordered table-striped datatable">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Data do registro</th>
                    <th>ID</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($operators as $operator)
                    <tr>
                        <td>{{ $operator->name }}</td>
                        <td>{{ $operator->email ?? '---' }}</td>
                        <td>{{ \Carbon\Carbon::parse($operator->created_at)->format('d/m/Y H:i:s') ?? '---' }}</td>
                        <td>{{ $operator->id ?? '---' }}</td>
                        
                        <td>
                            <a href="{{ route('operators.create', ['id' => $operator->id]) }}" data-toggle="tooltip" data-placement="top" title="Atualizar registro">
                                <i class="fas fa-pen"></i>
                            </a>&nbsp;
                            <a style="color: red;" title="Deletar registro?" href="#" data-href="{{ route('operators.delete', ['id' => $operator->id]) }}" data-toggle="modal" data-target="#confirm-delete">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Data do registro</th>
                    <th>ID</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
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