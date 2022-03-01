@extends('adminlte::page')

@section('title', 'Vacinas')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ !$vaccine ? 'Cadastro' : 'Atualização' }} de vacina</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('vaccines.index') }}">Lista de vacinas</a></li>
                    <li class="breadcrumb-item active">{{ !$vaccine ? 'Cadastro' : 'Atualização' }} de vacina</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @include('flash-message')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Formulário de vacina</h3>
        </div>
        
        <form action="{{ route('vaccines.store') }}" method="post">
            @csrf
            @if ($vaccine)
                <input type="hidden" name="id" value="{{ $vaccine->id }}" />
            @endif
            <div class="card-body">
                <div class="form-group required">
                    <label for="name"  class="control-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome" value="{{ old('name', $vaccine->name ?? '') }}" required>
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