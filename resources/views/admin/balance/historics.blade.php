@extends('adminlte::page')

@section('title', 'Histórico de Movimentações')

@section('content_header')
    <h1 class="m-0 text-dark">Histórico da conta</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Histórico</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('historic.search') }}" method="POST" class="form form-inline">
                {!! csrf_field() !!}
                <input type="text" name="id" class="form-control" placeholder="ID">
                <input type="date" name="date" class="form-control">
                <select name="type" class="form-control">
                    <option value="">-- Selecione o tipo --</option>
                    @foreach ($types as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                </select>


                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>

        </div>
           
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Valor</th>
              <th>Tipo</th>
              <th>Data</th>
              <th>Titular</th>
            </tr>
          </thead>
          <tbody>
            @forelse($historics as $historic)
            <tr>
              
              <td>{{ $historic->id }}</td>
              <td>{{ number_format($historic->amount, 2, ',', '.') }}</td>
              <td>{{ $historic->type($historic->type) }}</td>
              <td>{{ $historic->date }}</td>
              <td>
                  @if ($historic->user_id_transaction)
                        {{  $historic->userSender->name }}

                  @else

                  @endif
              </td>
            </tr>
            @empty
            @endforelse
          </tbody>
        </table>

        @if (isset($dataForm))
            {!!  $historics->appends($dataForm)->links()  !!}
        @else
             {!!  $historics->links()  !!}
        @endif

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