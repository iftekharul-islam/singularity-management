@extends('layouts.admin.app')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-display2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                    User Create
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="position-relative form-group">
                            <label for="exampleName" class="">Name</label>
                            <input name="name" id="exampleName" placeholder="Enter your name" type="text" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="exampleEmail" class="">Email</label>
                            <input name="email" id="exampleEmail" placeholder="Enter your email" type="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="examplePassword" class="">Password</label>
                            <input name="password" id="examplePassword" placeholder="Type your password" type="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="exampleConPassword" class="">Confirm Password</label>
                            <input name="password_confirmation" id="exampleConPassword" placeholder="Confirm your password" type="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
