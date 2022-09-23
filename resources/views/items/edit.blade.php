@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Item # {{ $item->id }}</div>

                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-danger">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                        <form action="{{ url('/items/' . $item->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('put') }}
                            <div class="form-group">
                                <label for="name">Item</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $item->name }}"z </div>

                                <button type="submit" class="btn btn-primary">Guardar cambios</button>

                                <a href="{{ url('/items') }}" class="btn btn-secondary">
                                    Cancelar y volver sin guardar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
