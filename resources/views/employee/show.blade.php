@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <div class="card text-center" style="width: 18rem;">

                <div class="card-body justify-content-center">
                    <h5 class="card-title">{{ $data->firstname . ' ' . $data->lastname }}</h5>
                    <p class="card-text">{{ $data->email }}</p>
                    <p class="card-text">{{ $data->phone }}</p>

                </div>
            </div>
        </div>
    </div>
@endsection
