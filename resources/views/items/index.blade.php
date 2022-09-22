@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Registrar Item') }}</div>
                    {{ csrf_field() }}
                    <div class="card-body">
                        <form action="{{ url('/items') }}" method="post">
                            <div class="form-group">
                                <label for="name">Nombre ded item</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Ingresar el nombre del item y presionar ENTER">
                            </div>
                        </form>

                    </div>
                </div>

                <div class="card my-2">
                    <div class="card-header">{{ __('Items') }}</div>
                    <div class="card-body">
                        <form action="{{ url('/items') }}" method="get">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre"
                                    value="{{ $search }}">
                            </div>
                        </form>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Fecha de registro</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>

                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <form action="{{ url('/items/' . $item->id) }}" method="post">
                                                {{ method_field('delete') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end">
                            {{ $items->appends(['search' => $search])->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
