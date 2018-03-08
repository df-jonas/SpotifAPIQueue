@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <label for="editable-search">Zoeken</label>
                        <select id="editable-search" name="search" class="form-control">
                            <option>Nummer 1</option>
                            <option>Nummer 2</option>
                            <option>Nummer 3</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
