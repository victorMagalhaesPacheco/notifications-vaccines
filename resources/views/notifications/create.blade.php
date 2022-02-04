@extends('adminlte::page')

@section('title', 'Notificações')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ !$notification ? 'Cadastro' : 'Atualização' }} de notificação</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('notifications.index') }}">Lista de notificações</a></li>
                    <li class="breadcrumb-item active">{{ !$notification ? 'Cadastro' : 'Atualização' }} de notificação</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-header">
            <h3 class="card-title">Formulário de notificação</h3>
        </div>
        
        <form action="{{ route('notifications.store') }}" method="post">
            @csrf
            @if ($notification)
                <input type="hidden" name="id" value="{{ $notification->id }}" />
            @endif
            <div class="card-body">
                <div class="form-group required">
                    <label  class="control-label">Vacina</label>
                    <select class="form-control select2" style="width: 100%;" name="vaccine_id">
                        <option value="">--- Selecione a vacina ---</option>
                        @foreach ($vaccines as $vaccine)
                            <option 
                                @if (old('vaccine_id') == $vaccine->id || ($notification && $notification->vaccine_id == $vaccine->id))
                                    selected
                                @endif                                    
                            value="{{ $vaccine->id }}">#{{ $vaccine->id }} - {{ $vaccine->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group required">
                    <label for="name" class="control-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome da notificação" value="{{ old('name', $notification->name ?? '') }}" required>
                </div>
                <div class="form-group required">
                    <label for="message" class="control-label">Mensagem</label>
                    <textarea class="form-control" id="message" name="story" placeholder="Digite a mensagem da notificação aqui! Para a plataforma SMS, o tamanho máximo deve ser 160 caracteres sem acentos."></textarea>
                </div>
                <div class="form-group required">
                    <label for="dayhour" class="control-label">Dia e hora da notificação</label>
                    <input type="datetime" class="form-control" id="dayhour" name="dayhour" placeholder="Informe o dia e hora da notificação" value="{{ old('dayhour', $notification->dayhour ?? '') }}" required>
                </div>
                <div class="form-group required">
                    <label for="alertdaysbefore" class="control-label">Alertar notificação com quantos dias de antes?</label>
                    <input type="number" class="form-control" id="alertdaysbefore" name="alertdaysbefore" placeholder="Informe com quantos dias você deseja alertar sobre a notificação" value="{{ old('alertdaysbefore', $notification->alertdaysbefore ?? '') }}" required>
                </div>
                <div class="form-group required">
                    <label  class="control-label">Situação</label>
                    <select class="form-control" style="width: 100%;" name="status">
                        <option value="">--- Selecione a situação da notificação ---</option>
                        @foreach ($notificationListStatus as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop

@include('commom')