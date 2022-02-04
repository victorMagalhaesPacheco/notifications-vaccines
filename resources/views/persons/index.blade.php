@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
<h1>Pessoas</h1>
@stop

@section('content')
<p>Lista das pessoas.</p>
<div class="card">
    @include('flash-message')    
    <div class="card-header">
        Ações
    </div>
    <div class="card-body">
        <a href="{{ route('persons.create') }}">
            <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Novo</button>
        </a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <table id="persons" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#id</th>
                    <th>Nome</th>
                    <th>Filhos</th>
                    <th>E-mail</th>
                    <th>Data de nascimento</th>
                    <th>Data de criação do registro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($persons as $person)
                    <tr>
                        <td>{{ $person->id }}</td>
                        <td>{{ $person->name }}</td>
                        <td>
                            @forelse ($person->childrens as $child)
                                <span class="badge bg-info">#{{ $child->id }} - {{ $child->name }}</span>    
                            @empty
                                ---
                            @endforelse
                        </td>
                        <td>{{ $person->email ?? '---' }}</td>
                        <td>{{ \Carbon\Carbon::parse($person->birth)->format('d/m/Y') ?? '---' }}</td>
                        <td>{{ \Carbon\Carbon::parse($person->created_at)->format('d/m/Y H:i:s') ?? '---' }}</td>
                        <td>
                            <a href="{{ route('persons.create', ['id' => $person->id]) }}" data-toggle="tooltip" data-placement="top" title="Atualizar registro">
                                <i class="fas fa-pen"></i>
                            </a>&nbsp;
                            <a style="color: red;" title="Deletar registro?" href="#" data-href="{{ route('persons.delete', ['id' => $person->id]) }}" data-toggle="modal" data-target="#confirm-delete">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#id</th>
                    <th>Nome</th>
                    <th>Filhos</th>
                    <th>E-mail</th>
                    <th>Data de nascimento</th>
                    <th>Data de criação do registro</th>
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
        $('#persons').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_pt.json"
            }
        });

        $('[data-toggle="tooltip"]').tooltip();

        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>
@stop