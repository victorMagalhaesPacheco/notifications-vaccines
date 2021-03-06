@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Histórico de notificações</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Painel de Controle</a></li>
                    <li class="breadcrumb-item active">Histórico de notificações</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="notifications" class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>Notificação</th>
                        <th>Plataforma de envio</th>
                        <th>Pessoas</th>
                        <th>Para</th>
                        <th>Mensagem</th>
                        <th>Data</th>
                        <th>SID</th>
                        <th>#id</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notificationsSent as $notification)
                        <tr>
                            <td>{{ $notification->notification->name }}</td>
                            <td>{{ $notification->platform->name }}</td>
                            <td>{{ $notification->person->name }}</td>
                            <td>{{ $notification->to }}</td>
                            <td>{!! $notification->body !!}</td>
                            <td>{{ \Carbon\Carbon::parse($notification->created_at)->format('d/m/Y H:i:s') ?? '---' }}</td>
                            <td>{{ $notification->sid ?? '---' }}</td>
                            <td>{{ $notification->id }}</td>
                        </tr>

                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Notificação</th>
                        <th>Plataforma de envio</th>
                        <th>Pessoas</th>
                        <th>Para</th>
                        <th>Mensagem</th>
                        <th>Data</th>
                        <th>SID</th>
                        <th>#id</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@stop