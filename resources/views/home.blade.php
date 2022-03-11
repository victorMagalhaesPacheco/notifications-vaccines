@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Painel de Controle</h1>
@stop

@section('content')
    <p>Bem vindo ao sistema de notificações de vacinas.</p>
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $countPersons }}</h3>
                    <p>Usuários Cadastrados</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="{{ route('persons.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $countNotificationsEnabled }}</h3>
                    <p>Notificações ativas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <a href="{{ route('notifications.index') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $countNotificationsSent }}</h3>
                    <p>Notificações enviadas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check"></i>
                </div>
                <a href="{{ route('notifications.history') }}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
@stop
