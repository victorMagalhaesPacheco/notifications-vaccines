@extends('adminlte::page')

@section('title', 'Simulação de Notificações')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Simulação de Notificações</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Painel de Controle</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('notifications.index') }}">Notificações Cadastradas</a></li>
                    <li class="breadcrumb-item active">Simulação de notificações</li>
                </ol>
            </div>
        </div>
    </div>
@stop
@include('flash-message')
@section('content')
    <div class="card">
        <div class="card-header">
            Ações
        </div>
        <div class="card-body">
            <a href="{{ route('notifications.send') }}">
                <button type="button" class="btn btn-success"><i class="fas fa-paper-plane"></i> Forçar Envio</button>
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="simulate" class="table">
                <thead>
                    <tr>
                        <th>Plataforma de envio</th>
                        <th>Responsável</th>
                        <th>Para</th>
                        <th>Mensagem</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notifications as $notification)
                        <tr>
                            <td>{{ $notification['platform'] }}</td>
                            <td>{{ $notification['person'] }}</td>
                            <td>{{ $notification['to'] }}</td>
                            <td>{!! $notification['body'] !!}</td>                          
                        </tr>
                    @empty
                        <tr>
                            <td>Nenhum registro para simulação encontrado.</td>                        
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th>Plataforma de envio</th>
                        <th>Responsável</th>
                        <th>Para</th>
                        <th>Mensagem</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@stop
