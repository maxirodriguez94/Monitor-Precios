@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cargar Valores') }}</div>

                    <div class="card-body">
                        <form action="{{ url('prices') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="location">Ubicacion</label>
                                <select name="location_id" id="location" class="form-control">
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="item">Item</label>
                                <select name="item_id" id="item" class="form-control">
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="value">Valor a cargar</label>
                                <input type="text" class="form-control" id="value" name="value" placeholder="00.00">
                            </div>
                            <div class="form-group">
                                <label for="date">Fecha actual</label>
                                <input type="date" id="date" class="form-control" value="{{ date('Y-m-d') }}"
                                    disabled>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">
                                Confirmar y cargar valor
                            </button>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        Ultimos valores cargados
                    </div>
                    <div class="car-body">
                        <table class="table table-hover">
                            <thead>
                                <th>Item</th>
                                <th>Ubicacion</th>
                                <th>Valor</th>
                                <th>Fecha carga</th>
                            </thead>
                            <tbody>
                                @foreach ($prices as $price )
                                <td>{{$price->item_id}}</td>
                                <td>{{$price->location_id}}</td>
                                <td>{{$price->value}}</td>
                                <td>{{$price->created_at}}</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
