@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Company</div>

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
                        <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="m-3">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control-file" id="logo" name="logo">
                            </div>

                            <div class="m-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter company name">
                            </div>

                            <div class="m-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter email">
                            </div>

                            <div class="m-3">
                                <label for="website">Website</label>
                                <input type="url" class="form-control" id="website" name="website"
                                    placeholder="Enter website URL">
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('company.index') }}" class="btn btn-secondary m-3">Cancel</a>
                                <button type="submit" class="btn btn-primary m-3">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
