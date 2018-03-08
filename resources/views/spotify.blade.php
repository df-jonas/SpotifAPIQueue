@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <p>Your account is not set up with Spotify yet.</p>
                        <ul>
                            <li><a href="{{ route("spotify.redirect") }}">Authorize your account.</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
