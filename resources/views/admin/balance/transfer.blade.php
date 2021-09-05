@extends('adminlte::page')

@section('title', 'Transferir Saldo')

@section('content_header')
    <h1 class="m-0 text-dark">Transferir</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Transferir</a></li>
    </ol>
@stop

@section('content')
      <div class="card">
        <div class="card-header">
            <h3>Transferir Saldo (Informe o titular )</h3>
        </div>
        <div class="card-body">
          @include('admin.includes.alerts')
          
           <form method="POST" action="{{ route('confirm.transfer') }}">
              
                {!! csrf_field() !!}

               <div class="form-group">
                   <input type="text" name="sender" placeholder="Tranferir para (digite o nome ou e-mail)" class="form-control">
               </div>
               <div class="form-group">
                   <button type="submit" class="btn btn-success">Próxima Etapa</button>
               </div>
           </form>
        </div>
    </div>
@stop
