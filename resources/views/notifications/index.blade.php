@extends('adminlte::page')

@section('title', 'Notificações')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Lista de notificações</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
                    <li class="breadcrumb-item active">Lista de notificações</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-header">
            Ações
        </div>
        <div class="card-body">
            <a href="{{ route('notifications.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Novo</button>
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="notifications" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#id</th>
                        <th>Vacina</th>
                        <th>Plataformas</th>
                        <th>Nome</th>
                        <th>Dias para vacinação após nascimento</th>
                        <th>Situação</th>
                        <th>Data de criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $notification->id }}</td>
                            <td>{{ $notification->vaccine->name }}</td>
                            <td>
                                @forelse ($notification->platforms as $notificationPlatform)
                                    <span class="badge bg-info">#{{ $notificationPlatform->platform->id }} -
                                        {{ $notificationPlatform->platform->name }}</span>
                                @empty
                                    ---
                                @endforelse
                            </td>
                            <td>{{ $notification->name }}</td>
                            <td>{{ $notification->days }}</td>
                            <td>{{ \App\Models\Notification::listStatus($notification->status) }}</td>
                            <td>{{ \Carbon\Carbon::parse($notification->created_at)->format('d/m/Y H:i:s') ?? '---' }}
                            </td>
                            <td>
                                <a href="{{ route('notifications.create', ['id' => $notification->id]) }}"
                                    data-toggle="tooltip" data-placement="top" title="Atualizar registro">
                                    <i class="fas fa-pen"></i>
                                </a>&nbsp;
                                <a href="#" data-toggle="tooltip" data-placement="top" title="Visualizar detalhes">
                                    <i style="color: green;" data-toggle="modal" data-target="#modal-messages_{{ $notification->id }}"
                                        class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>

                        <div class="modal fade" id="modal-messages_{{ $notification->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detalhes da notificação</h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-bullhorn"></i>
                                                    Notificação em detalhes
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="callout callout-info">
                                                    <h5>#ID</h5>
                                                    <p>#{{ $notification->id }}</p>
                                                </div>
                                                <div class="callout callout-info">
                                                    <h5>Vacina</h5>
                                                    <p>{{ $notification->vaccine->name }}</p>
                                                </div>
                                                <div class="callout callout-info">
                                                    <h5>Plataformas</h5>
                                                    @forelse ($notification->platforms as $notificationPlatform)
                                                        <span
                                                            class="badge bg-info">#{{ $notificationPlatform->platform->id }}
                                                            -
                                                            {{ $notificationPlatform->platform->name }}</span>
                                                    @empty
                                                        ---
                                                    @endforelse
                                                </div>
                                                <div class="callout callout-info">
                                                    <h5>Nome</h5>
                                                    <p>{{ $notification->name }}</p>
                                                </div>
                                                <div class="callout callout-info">
                                                    <h5>Dias para vacinação após nascimento</h5>
                                                    <p>{{ $notification->days }}</p>
                                                </div>
                                                <div class="callout callout-info">
                                                    <h5>Alertar notificação em dias antes</h5>
                                                    <p>{{ $notification->alertdaysbefore }}</p>
                                                </div>
                                                <div class="callout callout-info">
                                                    <h5>Situação</h5>
                                                    <p>{{ \App\Models\Notification::listStatus($notification->status) }}
                                                    </p>
                                                </div>

                                                <div class="callout callout-info">
                                                    <h5>Data de criação</h5>
                                                    <p>{{ \Carbon\Carbon::parse($notification->created_at)->format('d/m/Y H:i:s') ?? '---' }}
                                                    </p>
                                                </div>
                                                <div class="callout callout-info">
                                                    <h5>Ultima atualização</h5>
                                                    <p>{{ \Carbon\Carbon::parse($notification->updated_at)->format('d/m/Y H:i:s') ?? '---' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-bullhorn"></i>
                                                    Mensagens e plataformas
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($notification->platforms as $notificationPlatform)
                                                    <div class="callout callout-success">
                                                        <h5>#{{ $notificationPlatform->id }} -
                                                            {{ $notificationPlatform->platform->name }}</h5>
                                                        <p>{{ $notificationPlatform->message }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#id</th>
                        <th>Vacina</th>
                        <th>Plataformas</th>
                        <th>Nome</th>
                        <th>Dias para vacinação após nascimento</th>
                        <th>Situação</th>
                        <th>Data de criação</th>
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
            $('#notifications').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_pt.json"
                },
                "autoWidth": false,
                "responsive": true,
            });

            $('[data-toggle="tooltip"]').tooltip();

            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        });
    </script>
@stop
