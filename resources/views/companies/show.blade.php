@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <div class="card text-center" style="width: 18rem;">
                @if ($data->logo)
                    <img class="card-img-top" src="{{ asset('storage/' . $data->logo) }}" alt="Logo">
                @else
                    <img class="card-img-top" src="{{ asset('default.png') }}" alt="Default Logo">
                @endif
                <div class="card-body justify-content-center">
                    <h5 class="card-title">{{ $data->name }}</h5>
                    <p class="card-text">{{ $data->email }}</p>
                    <p class="card-text">{{ $data->website }}</p>
                    <a class="btn btn-primary" href="{{ route('employee.index', ['companyId' => $data->id]) }}">
                        Employees
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
