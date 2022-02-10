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
                    <select class="form-control select2" id="vaccine_id" style="width: 100%;" name="vaccine_id" required>
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
                    <label  class="control-label">Plataformas</label>
                    <select class="form-control select2" id="platform_ids" style="width: 100%;" name="platform_ids[]" multiple="multiple" required>
                        <option value="">--- Selecione a(s) plataforma(s) ---</option>
                        @foreach ($platforms as $platform)
                            <option 
                                @if (!empty(old('platform_ids')) && in_array($platform->id, old('platform_ids')) || isset($notification->platforms) && in_array($platform->id, $notification->platforms->pluck('platform_id')->toArray()))
                                    selected
                                @endif  
                            
                            value="{{ $platform->id }}">#{{ $platform->id }} - {{ $platform->name }}</option>
                        @endforeach
                    </select>
                    <i>
                        Palavras dinâmicas:<br> 
                        Nome responsável = <b>[person.name]</b> (Ex.: Olá [person.name], seu filho deve ser vacinado em breve.)<br>
                        Nome criança = <b>[child.name]</b> (Ex.: Olá Responsável, seu filho [child.name] deve ser vacinado em breve.)
                    </i>
                </div>
                @foreach ($platforms as $platform)
                    <div class="form-group required div_platform" id="div_platform_{{ $platform->id }}" style="display: none;">
                        <label for="message" class="control-label">Mensagem para a plataforma: {{ $platform->name }}</label>
                            @if (!empty($notification))
                                @foreach ($notification->platforms as $notificationPlatform)
                                    @if ($notificationPlatform->platform_id == $platform->id)
                                        @php
                                            $message = $notificationPlatform->message
                                        @endphp
                                    @endif
                                @endforeach
                            @endif
                        
                        <textarea class="form-control" class="message_platform" name="message_platform_{{ $platform->id }}" id="message_platform_{{ $platform->id }}" placeholder="Digite a mensagem da notificação aqui">{{ old('message_platform_' . $platform->id, $message ?? '') }}</textarea>
                    </div>
                @endforeach
                
                <div class="form-group required">
                    <label for="days" class="control-label">Dias para vacinação após nascimento</label>
                    <input type="number" class="form-control" id="days" name="days" placeholder="Informe a quantidade de dias para envio da notificação" value="{{ old('days', $notification->days ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="alertdaysbefore">Alertar notificação com quantos dias de antes?</label>
                    <input type="number" class="form-control" id="alertdaysbefore" name="alertdaysbefore" placeholder="Informe com quantos dias você deseja alertar sobre a notificação" value="{{ old('alertdaysbefore', $notification->alertdaysbefore ?? '') }}">
                </div>
                <div class="form-group required">
                    <label  class="control-label">Situação</label>
                    <select class="form-control" style="width: 100%;" name="status" required>
                        <option value="">--- Selecione a situação da notificação ---</option>
                        @foreach ($notificationListStatus as $key => $value)
                            <option 
                            @if (old('status') == $key || ($notification && $notification->status == $key))
                                selected
                            @endif    
                            
                            value="{{ $key }}">{{ $value }}</option>
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

            ruleFieldsPlatforms();

            $('#vaccine_id').select2({
                'placeholder': 'Selecione a vacina'
            });
            $('#platform_ids').select2({
                'placeholder': 'Selecione a(s) plataforma(s)'
            });

            $("#platform_ids").change(function() {
                ruleFieldsPlatforms();
            });

            function ruleFieldsPlatforms() {
                $(".div_platform").hide('slow');

                var platforms = $("#platform_ids").val();

                $(".message_platform").removeAttr('required');

                platforms.forEach(value => {
                    $("#div_platform_" + value).show('slow');
                    $("#message_platform_" + value).attr('required', 'required');
                    
                });
            }
        });
    </script>
@stop

@include('commom')