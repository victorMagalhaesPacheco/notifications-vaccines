@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ !$person ? 'Cadastro' : 'Atualização' }} de Usuário</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Painel de Controle</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('persons.index') }}">Lista de Usuários</a></li>
                    <li class="breadcrumb-item active">{{ !$person ? 'Cadastro' : 'Atualização' }} de Usuário</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @include('flash-message')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Incluir/Atualizar Usuário</h3>
        </div>
        
        <form action="{{ route('persons.store') }}" method="post">
            @csrf
            @if ($person)
                <input type="hidden" name="id" value="{{ $person->id }}" />
            @endif
            <div class="card-body">
                <div class="form-group required">
                    <label for="name" class="control-label">Nome do responsável (completo):</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome" value="{{ old('name', $person->name ?? '') }}" required>
                </div>
                <div class="form-group required">
                    <label for="name" class="control-label">Nome do responsável para a notificação:</label>
                    <input type="text" class="form-control" id="name_notification" name="name_notification" placeholder="Informe o nome para a notificação" value="{{ old('name_notification', $person->name_notification ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">E-mail:</label>
                    <input type="mail" class="form-control" id="email" name="email" placeholder="Informe o e-mail" value="{{ old('email', $person->email ?? '') }}">
                </div>
                <div class="form-group required">
                    <label for="name" class="control-label">Telefone (SMS e WhatsApp):</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Informe o telefone" value="{{ old('phone', $person->phone ?? '') }}" required>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Crianças</h3>
                        
                    </div>
                    <div class="card-body">
                        <div id="container-child">
                            @if($person)
                                @foreach ($person->childrens as $child)
                                    <div class="row align-items-center" id="row-child" >
                                        <div class="col-sm-4">
                                            <div class="form-group required">
                                                <label for="name" class="control-label">Nome da criança (completo): </label>
                                                <input type="text" class="form-control" class="childrens" name="childrens[]" placeholder="Informe o nome da criança (completo)" value="{{ $child->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group required">
                                                <label for="name" class="control-label">Nome da criança para notificação: </label>
                                                <input type="text" class="form-control" class="childrens_notification" name="childrens_notification[]" placeholder="Informe o nome da criança para a notificação" value="{{ $child->name_notification }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group required">
                                                <label for="birth" class="control-label">Data de nascimento: </label>
                                                <input type="date" class="form-control" class="birth" name="birth[]" placeholder="Informe a data de nascimento" value="{{ $child->birth }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-1 ">
                                            <button type="button" class="btn btn-danger btn-delete-child">
                                                <i class="far fa-times-circle"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-info" id="btn-new-child"><i class="fas fa-plus"></i> Nova criança</button>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

@stop

@section('js')
    <script src="{{ asset('vendor/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('#phone').inputmask('(99)99999999[9]')

            $('#btn-new-child').click(function() {
                var rowChild = '<div class="row align-items-center" id="row-child" > <div class="col-sm-4"> <div class="form-group required"> <label for="name" class="control-label">Nome da criança (completo): </label> <input type="text" class="form-control" class="childrens" name="childrens[]" placeholder="nome da criança (completo)" required> </div></div><div class="col-sm-4"> <div class="form-group required"> <label for="name" class="control-label">Nome da criança para notificação: </label> <input type="text" class="form-control" class="childrens_notification" name="childrens_notification[]" placeholder="nome da criança para a notificação" required> </div></div><div class="col-sm-3"> <div class="form-group required"> <label for="birth" class="control-label">Data de nascimento: </label> <input type="date" class="form-control" class="birth" name="birth[]" placeholder="Informe a data de nascimento" required> </div></div><div class="col-sm-1 "> <button type="button" class="btn btn-danger btn-delete-child"> <i class="far fa-times-circle"></i> </button> </div></div>';    
                $("#container-child").append(rowChild);
            });

            $(document).on('click', '.btn-delete-child', function () {
                console.log($(this).parent().parent().remove());
            });

        });
    </script>
@stop

@include('commom')