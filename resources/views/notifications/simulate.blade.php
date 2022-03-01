@extends('adminlte::page')

@section('title', 'Simulação de Notificações')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Simulação de notificações notificações</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('notifications.index') }}">Lista de notificações</a></li>
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
                <button type="button" class="btn btn-success"><i class="fas fa-paper-plane"></i> Enviar</button>
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="simulate" class="table">
                <thead>
                    <tr>
                        <th>Plataforma</th>
                        <th>Responsável</th>
                        <th>Para</th>
                        <th>Mensagem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $notification['platform'] }}</td>
                            <td>{{ $notification['person'] }}</td>
                            <td>{{ $notification['to'] }}</td>
                            <td>{{ $notification['body'] }}</td>                          
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Plataforma</th>
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