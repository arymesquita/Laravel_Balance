@extends('adminlte::page')

@section('title', 'Home Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Saldo</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('balance.deposit') }}" class="btn btn-primary">Depositar</a>
            @if($amount > 0)
                <a href="{{ route('balance.withdrawn') }}" class="btn btn-danger">Sacar</a>
            @endif

             @if($amount > 0)
                <a href="{{ route('balance.transfer') }}" class="btn btn-info">Transferir</a>
            @endif
        </div>
        <div class="card-body">
            @include('admin.includes.alerts')
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>R$ {{ number_format($amount, 2, '.', '') }}</h3><!--Pode usar o recurso de Mutators(Pesquisar este recurso)-->

                <p>Valor</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('transfer.historic') }}" class="small-box-footer">Histórico <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
    </div>
@stop
<!--
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Você está logado !</p>
                </div>
            </div>
        </div>
    </div>
@stop
-->