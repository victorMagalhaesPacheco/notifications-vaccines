@extends('adminlte::page')

@section('title', 'Notificações')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Histórico de notificações</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
                    <li class="breadcrumb-item active">Histórico de notificações</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="notifications" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#id</th>
                        <th>Notificação</th>
                        <th>Plataforma</th>
                        <th>Pessoas</th>
                        <th>SID</th>
                        <th>Para</th>
                        <th>Mensagem</th>
                        <th>Data de envio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notificationsSent as $notification)
                        <tr>
                            <td>{{ $notification->id }}</td>
                            <td>{{ $notification->notification->name }}</td>
                            <td>{{ $notification->platform->name }}</td>
                            <td>{{ $notification->person->name }}</td>
                            <td>{{ $notification->sid ?? '---' }}</td>
                            <td>{{ $notification->to }}</td>
                            <td>{{ $notification->body }}</td>
                            <td>{{ \Carbon\Carbon::parse($notification->created_at)->format('d/m/Y H:i:s') ?? '---' }}
                        </tr>

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#id</th>
                        <th>Notificação</th>
                        <th>Plataforma</th>
                        <th>Pessoas</th>
                        <th>SID</th>
                        <th>Para</th>
                        <th>Mensagem</th>
                        <th>Data de envio</th>
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
            $('#notifications').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_pt.json"
                },
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop
