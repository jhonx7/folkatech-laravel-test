@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>Companies</div>
                        <a href="{{ route('company.create') }}" class="btn btn-primary float-right">Add</a>
                    </div>

                    <div class="card-body">
                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Website</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $company)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            @if ($company->logo)
                                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo"
                                                    width="50">
                                            @else
                                                <img src="default.png" alt="Default Logo" width="50">
                                            @endif
                                        </td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->website }}</td>
                                        <td>
                                            <a href="{{ route('company.show', $company->id) }}"
                                                class="btn btn-secondary m-1">
                                                Detail
                                            </a>
                                            <a href="{{ route('company.edit', $company->id) }}" class="btn btn-success m-1">
                                                Edit
                                            </a>

                                            <button
                                                onclick="event.preventDefault();
                                                     document.getElementById('{{ 'delete' . $key }}').submit();"
                                                class="btn btn-danger m-1">
                                                Delete
                                            </button>
                                            <form id="{{ 'delete' . $key }}"
                                                action="{{ route('company.destroy', $company->id) }}" method="POST"
                                                class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
