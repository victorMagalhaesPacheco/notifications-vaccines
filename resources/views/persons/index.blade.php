@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
<h1>Pessoas</h1>
@stop

@section('content')
<p>Lista das pessoas.</p>
<div class="card">
    <div class="card-body">
        <table id="persons" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#id</th>
                    <th>Nome</th>
                    <th>Filhos</th>
                    <th>E-mail</th>
                    <th>Data de criação</th>
                    <th>Data de atualização</th>
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
                        <td>{{ $person->created_at ?? '---' }}</td>
                        <td>{{ $person->updated_at ?? '---' }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#id</th>
                    <th>Nome</th>
                    <th>Filhos</th>
                    <th>E-mail</th>
                    <th>Data de criação</th>
                    <th>Data de atualização</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@stop

@section('js')
<script>
    $(document).ready(function() {
        $('#persons').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_pt.json"
            }
        });
    });
</script>
@stop