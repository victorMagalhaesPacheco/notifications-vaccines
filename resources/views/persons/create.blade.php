@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
    <h1>{{ !$person ? 'Cadastro' : 'Atualização' }} de pessoa</h1>
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
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome" value="{{ old('name', $person->name ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="mail" class="form-control" id="email" name="email" placeholder="Informe o e-mail" value="{{ old('email', $person->email ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="birth">Data de nascimento</label>
                    <input type="date" class="form-control" id="birth" name="birth" placeholder="Informe a data de nascimento" value="{{ old('birth', $person->birth ?? '') }}">
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
