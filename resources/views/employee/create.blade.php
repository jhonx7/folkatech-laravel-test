@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Employee {{ $company->name }}</div>

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
                        <form action="{{ route('employee.store', ['companyId' => $company->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="m-3">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname"
                                    placeholder="Enter employee first name">
                            </div>

                            <div class="m-3">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    placeholder="Enter employee last name">
                            </div>

                            <div class="m-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email">
                            </div>

                            <div class="m-3">
                                <label for="phone">Website</label>
                                <input type="phone" class="form-control" id="phone" name="phone"
                                    placeholder="Enter phone number">
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('employee.index', ['companyId' => $company->id]) }}"
                                    class="btn btn-secondary m-3">Cancel</a>
                                <button type="submit" class="btn btn-primary m-3">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
