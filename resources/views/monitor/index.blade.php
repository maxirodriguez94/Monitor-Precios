@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Monitoreo de precions') }}</div>
                    <div class="card-body">
                        <form action="{{ url('/monitor') }}" method="get">
                            <div class="form-group">
                                <label for="search">Buscar item</label>
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Ingresar nombre de item y presionar Enter" value="{{ $search }}">
                            </div>
                        </form>

                        <p>Valores cargados en la ultima semana ({{ $startDate }} - {{ $endDate }})</p>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Menor valor</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->lowestValue($startDate, $endDate) }}</td>
                                        <td>
                                            <a href="{{ route('monitor', [
                                                'search' => $search,
                                                'page' => $items->currentPage(),
                                                'item_id' => $item->id,
                                            ]) }}"
                                                class="btn btn-primary">
                                                Ver Detalles
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $items->appends(['search' => $search])->links() }}
                    </div>
                </div>


                    <div class="card mt-4">
                        <div class="card-header">{{ __('Detalles del item seleccionado') }}</div>

                        <div class="card-body">
                            <a href="{{ url('items/' . $item_id . '/prices') }}" class="btn btn-success">
                                Descargar como Excel
                            </a>
                            <table class="table table-hover mt-2">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Ubicacion</th>
                                        <th>Valor Cargado</th>
                                        <th>Fecha de carga</th>
                                        @if (auth()->user()->is_admin)
                                            <th>Opciones</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prices as $price)
                                        <tr>
                                            <td>{{ $price->user->name }}</td>
                                            <td>{{ $price->location->name }}</td>
                                            <td>{{ $price->value }}</td>
                                            <td>{{ $price->created_at }}</td>
                                            @if (auth()->user()->is_admin)
                                                <td>
                                                    <form action="{{ url('/prices/' . $price->id) }}" method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-danger">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
            </div>

        </div>
    </div>

    </div>
@endsection
