@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ !$person ? 'Cadastro' : 'Atualização' }} de pessoa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('persons.index') }}">Lista de pessoas</a></li>
                    <li class="breadcrumb-item active">{{ !$person ? 'Cadastro' : 'Atualização' }} de pessoa</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-header">
            <h3 class="card-title">Formulário de pessoa</h3>
        </div>
        
        <form action="{{ route('persons.store') }}" method="post">
            @csrf
            @if ($person)
                <input type="hidden" name="id" value="{{ $person->id }}" />
            @endif
            <div class="card-body">
                <div class="form-group">
                    <label>Responsável</label>
                    <select class="form-control select2" style="width: 100%;" name="person_id">
                        <option value="">--- Selecione a pessoa responsável ---</option>
                        @foreach ($persons as $p)
                            <option 
                                @if (old('person_id') == $p->id || ($person && $person->person_id == $p->id))
                                    selected
                                @endif                                    
                            value="{{ $p->id }}">#{{ $p->id }} - {{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group required">
                    <label for="name" class="control-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome" value="{{ old('name', $person->name ?? '') }}" required>
                </div>
                <div class="form-group required">
                    <label for="email" class="control-label">E-mail</label>
                    <input type="mail" class="form-control" id="email" name="email" placeholder="Informe o e-mail" value="{{ old('email', $person->email ?? '') }}" required>
                </div>
                <div class="form-group required">
                    <label for="birth" class="control-label">Data de nascimento</label>
                    <input type="date" class="form-control" id="birth" name="birth" placeholder="Informe a data de nascimento" value="{{ old('birth', $person->birth ?? '') }}" required>
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