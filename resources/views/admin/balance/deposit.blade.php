@extends('adminlte::page')

@section('title', 'Nova Recarga')

@section('content_header')
    <h1 class="m-0 text-dark">Realizar Depósito</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Depositar</a></li>
    </ol>
@stop

@section('content')
      <div class="card">
        <div class="card-header">
            <h3>Depositar</h3>
        </div>
        <div class="card-body">
          @include('admin.includes.alerts')
          
           <form method="POST" action="{{ route('deposit.store') }}">
                {!! csrf_field() !!}

               <div class="form-group">
                   <input type="text" name="value" placeholder="Valor a depositar" class="form-control">
               </div>
               <div class="form-group">
                   <button type="submit" class="btn btn-success">Depositar</button>
               </div>
           </form>
        </div>
    </div>
@stop
