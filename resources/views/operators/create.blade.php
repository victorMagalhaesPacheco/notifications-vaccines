@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ !$operator ? 'Cadastro' : 'Atualização' }} de Operador</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Painel de Controle</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('operators.index') }}">Lista de Operadores</a></li>
                    <li class="breadcrumb-item active">{{ !$operator ? 'Cadastro' : 'Atualização' }} de Operador</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @include('flash-message')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Incluir/Atualizar Operador</h3>
        </div>
        
        <form action="{{ route('operators.store') }}" method="post">
            @csrf
            @if ($operator)
                <input type="hidden" name="id" value="{{ $operator->id }}" />
            @endif
            <div class="card-body">
                <div class="form-group ">
                    <label for="name" class="control-label">Nome do operador:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome" value="{{ old('name', $operator->name ?? '') }}" required>
                </div>
                <div class="form-group ">
                    <label for="email" class="control-label">E-mail:</label>
                    <input type="mail" class="form-control" id="email" name="email" placeholder="Informe o e-mail" value="{{ old('email', $operator->email ?? '') }}" required>
                </div>
                @if ($operator)
                    <div class="form-group">
                        <label  class="control-label">Atualizar senha?</label>
                        <select class="form-control" id="password_update" style="width: 100%;" name="password_update">
                            <option value="N">Não</option>
                            <option value="S">Sim</option>
                        </select>
                    </div>
                @endif
                <div class="form-group ">
                    <label for="name" class="control-label">Senha:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Informe a senha" required>
                </div>
                <div class="form-group ">
                    <label for="name" class="control-label">Confirmação de Senha:</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Informe a confirmação de senha" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

@stop

@section('js')
    <script>
        $(document).ready(function() {

            confirmPassword();

            $("#password_update").change(function() {
                confirmPassword();
            }); 
            
            function confirmPassword() {
                var passwordUpdate = $("#password_update").val();
                if (typeof passwordUpdate !== 'undefined') {
                    if (passwordUpdate == 'N') {
                        $("#password").attr('disabled', true);
                        $("#password_confirm").attr('disabled', true);
                    } else {
                        $("#password").attr('disabled', false);
                        $("#password_confirm").attr('disabled', false);
                    }
                } 
            }
        });
    </script>
@stop
@include('commom')