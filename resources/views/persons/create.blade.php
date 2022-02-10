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
                <div class="form-group required">
                    <label for="name" class="control-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Informe o nome" value="{{ old('name', $person->name ?? '') }}" required>
                </div>
                <div class="form-group required">
                    <label for="email" class="control-label">E-mail</label>
                    <input type="mail" class="form-control" id="email" name="email" placeholder="Informe o e-mail" value="{{ old('email', $person->email ?? '') }}" required>
                </div>
                <div class="form-group required">
                    <label for="name" class="control-label">Telefone (SMS e WhatsApp)</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Informe o telefone" value="{{ old('phone', $person->phone ?? '') }}" required>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Filhos</h3>
                        
                    </div>
                    <div class="card-body">
                        <div id="container-child">
                            @if($person)
                                @foreach ($person->childrens as $child)
                                    <div class="row align-items-center" id="row-child" >
                                        <div class="col-sm-6">
                                            <div class="form-group required">
                                                <label for="name" class="control-label">Nome</label>
                                                <input type="text" class="form-control" class="childrens" name="childrens[]" placeholder="Informe o nome do filho" value="{{ $child->name }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group required">
                                                <label for="birth" class="control-label">Data de nascimento</label>
                                                <input type="date" class="form-control" class="birth" name="birth[]" placeholder="Informe a data de nascimento" value="{{ $child->birth }}">
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
                        <button type="button" class="btn btn-info" id="btn-new-child"><i class="fas fa-plus"></i> Novo filho</button>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>

@stop

@section('js')
    <script src="{{ asset('vendor/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('#phone').inputmask('(99)99999-9999')

            $('#btn-new-child').click(function() {
                var rowChild = '<div class="row align-items-center" id="row-child" > <div class="col-sm-6"> <div class="form-group required"> <label for="name" class="control-label">Nome</label> <input type="text" class="form-control" class="childrens" name="childrens[]" placeholder="Informe o nome do filho"> </div> </div> <div class="col-sm-5"> <div class="form-group required"> <label for="birth" class="control-label">Data de nascimento</label> <input type="date" class="form-control" class="birth" name="birth[]" placeholder="Informe a data de nascimento"> </div> </div> <div class="col-sm-1 "> <button type="button" class="btn btn-danger btn-delete-child"> <i class="far fa-times-circle"></i> </button> </div> </div>';    
                $("#container-child").append(rowChild);
            });

            $(document).on('click', '.btn-delete-child', function () {
                console.log($(this).parent().parent().remove());
            });

        });
    </script>
@stop

@include('commom')