@extends('adminlte::page')

@section('title', 'Confirmar Transferência Saldo')

@section('content_header')
    <h1 class="m-0 text-dark">Confirmar Transferência</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Transferir</a></li>
        <li><a href="">Confirmar</a></li>
    </ol>
@stop

@section('content')
      <div class="card">
        <div class="card-header">
            <h3>Confirmar Transferência</h3>
        </div>
        <div class="card-body">
          @include('admin.includes.alerts')

          <p><strong>Recebedor: </strong>{{ $sender->name }}</p>
          <p><strong>Seu saldo atual: </strong>{{ number_format($balance->amount, 2, '.', '')}}</p>
          
           <form method="POST" action="{{ route('transfer.store') }}">
              
                {!! csrf_field() !!}

                <input type="hidden" name="sender_id" value="{{ $sender->id }}">

               <div class="form-group">
                   <input type="text" name="value" placeholder="Valor:" class="form-control">
               </div>
               <div class="form-group">
                   <button type="submit" class="btn btn-success">Transferir</button>
               </div>
           </form>
        </div>
    </div>
@stop
