@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>{{ $company->name }} Employees</div>
                        <a href="{{ route('employee.create', ['companyId' => $company->id]) }}"
                            class="btn btn-primary float-right">Add</a>
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
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $employee)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $employee->firstname }}</td>
                                        <td>{{ $employee->lastname }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>
                                            <a href="{{ route('employee.show', ['companyId' => $company->id, 'id' => $employee->id]) }}"
                                                class="btn btn-secondary m-1">
                                                Detail
                                            </a>
                                            <a href="{{ route('employee.edit', ['companyId' => $company->id, 'id' => $employee->id]) }}"
                                                class="btn btn-success m-1">
                                                Edit
                                            </a>

                                            <button
                                                onclick="event.preventDefault();
                                                     document.getElementById('{{ 'delete' . $key }}').submit();"
                                                class="btn btn-danger m-1">
                                                Delete
                                            </button>
                                            <form id="{{ 'delete' . $key }}"
                                                action="{{ route('employee.destroy', ['companyId' => $company->id, 'id' => $employee->id]) }}"
                                                method="POST" class="d-none">
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
