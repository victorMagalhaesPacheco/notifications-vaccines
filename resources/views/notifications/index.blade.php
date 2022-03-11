@extends('adminlte::page')

@section('title', 'Notificações')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Notificações Cadastradas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Painel de Controle</a></li>
                    <li class="breadcrumb-item active">Notificações Cadastradas</li>
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
            <a href="{{ route('notifications.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Novo</button>
            </a>
            <a href="{{ route('notifications.send') }}?simulate=true">
                <button type="button" class="btn btn-success"><i class="fas fa-paper-plane"></i> Simular envio de notificações</button>
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="notifications" class="table table-bordered table-striped datatable">
                <thead>
                    <tr>
                        <th>#id</th>
                        <th>Vacina</th>
                        <th>Plataformas de envio</th>
                        <th>Nome da notificação</th>
                        <th>Dia para notificar após nascimento</th>
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
                                <a href="{{ route('notifications.create', ['id' => $notification->id]) }}" title="Atualizar registro">
                                    <i class="fas fa-pen"></i>
                                </a>&nbsp;
                                <a href="#" title="Visualizar detalhes">
                                    <i style="color: green;" data-toggle="modal" data-target="#modal-messages_{{ $notification->id }}"
                                        class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>

                        <div class="modal fade" id="modal-messages_{{ $notification->id }}">
                            <div class="modal-dialog modal-xl">
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
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="callout callout-info">
                                                            <h5>#ID</h5>
                                                            <p>#{{ $notification->id }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="callout callout-info">
                                                            <h5>Vacina</h5>
                                                            <p>{{ $notification->vaccine->name }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="callout callout-info">
                                                            <h5>Plataformas de envio</h5>
                                                            @forelse ($notification->platforms as $notificationPlatform)
                                                                <span
                                                                    class="badge bg-info">#{{ $notificationPlatform->platform->id }}
                                                                    -
                                                                    {{ $notificationPlatform->platform->name }}</span>
                                                            @empty
                                                                ---
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="callout callout-info">
                                                            <h5>Nome</h5>
                                                            <p>{{ $notification->name }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="callout callout-info">
                                                            <h5>Dia para notificar após nascimento</h5>
                                                            <p>{{ $notification->days }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="callout callout-info">
                                                            <h5>Alerta adicional</h5>
                                                            <p>{{ $notification->alertdaysbefore }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="callout callout-info">
                                                            <h5>Situação</h5>
                                                            <p>{{ \App\Models\Notification::listStatus($notification->status) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="callout callout-info">
                                                            <h5>Data de criação</h5>
                                                            <p>{{ \Carbon\Carbon::parse($notification->created_at)->format('d/m/Y H:i:s') ?? '---' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="callout callout-info">
                                                            <h5>Ultima atualização</h5>
                                                            <p>{{ \Carbon\Carbon::parse($notification->updated_at)->format('d/m/Y H:i:s') ?? '---' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-bullhorn"></i>
                                                    Plataformas e mensagens enviadas
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($notification->platforms as $notificationPlatform)
                                                    <div class="callout callout-success">
                                                        <h5>#{{ $notificationPlatform->id }} -
                                                            {{ $notificationPlatform->platform->name }}</h5>
                                                        <p>{{ $notificationPlatform->message }}</p>
                                                         @foreach ($notification->sent as $sent)
                                                            @if($sent->platform_id == $notificationPlatform->platform_id)
                                                                <div class="callout callout-info">
                                                                    <small class="badge badge-info">#SID:</small> {{ $sent->sid }}<br>
                                                                    <small class="badge badge-info">Para:</small>  {{ '#' . $sent->person->id . ' | ' . $sent->person->name . ' | ' . $sent->to }}<br>
                                                                    <small class="badge badge-info">Mensagem:</small>  {{ $sent->body }}<br>
                                                                    <small class="badge badge-info">Enviado em:</small>  {{ \Carbon\Carbon::parse($sent->created_at)->format('d/m/Y H:i:s') ?? '---' }}<br>
                                                                </div>
                                                            @endif
                                                            
                                                         @endforeach
                                                        
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
                        <th>Plataformas de envio</th>
                        <th>Nome</th>
                        <th>Dia para notificar após nascimento</th>
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
            $('[data-toggle="tooltip"]').tooltip();

            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        });
    </script>
@stop
