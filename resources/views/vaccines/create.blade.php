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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Painel de Controle</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('vaccines.index') }}">Vacinas Cadastradas no Sistema</a></li>
                    <li class="breadcrumb-item active">{{ !$vaccine ? 'Cadastro' : 'Atualização' }} de vacina</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    @include('flash-message')
    <div style="margin-top: 15px;" class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Informação!</h5>
        <p>A inclusão de uma vacina neste cadastro tem por objetivo vincular uma notificação futura a este evento de vacinação, portanto caso a notificação possa ser útil para oportunizar mais de uma vacina em uma mesma data, as mesmas podem ser agrupadas neste cadastro.</p>
        <p>Ex: Se aos 12 meses a criança deve tomar as vacinas Meningo C, Pneumo 10 e Tríplice Viral, as mesmas podem ser agrupadas para envio de uma única notificação como lembrete desta data. Criando aqui a “Vacinação Meningo C + Pneumo 10 + Tríplice Viral”.</p>
    </div> 
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Incluir/Atualizar Vacina</h3>
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
                <button type="submit" class="btn btn-primary">Salvar</button>
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