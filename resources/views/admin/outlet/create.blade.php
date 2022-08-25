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
                    Outlet Create
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{ route('outlet.store') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="position-relative form-group">
                            <label for="exampleName" class="">Name</label>
                            <input name="name" id="exampleName" placeholder="Enter Outlet name" type="text" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="examplePh" class="">Phone no</label>
                            <input name="phone_no" id="examplePh" placeholder="Enter Outlet number" type="number" step="00.01" class="form-control @error('phone_no') is-invalid @enderror" required>
                            @error('phone_no')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="exampleLa" class="">Latitude</label>
                            <input name="latitude" id="exampleLa" placeholder="Enter Outlet latitude" type="number" step="00.01" class="form-control @error('latitude') is-invalid @enderror" required>
                            @error('latitude')
                            <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="exampleLo" class="">Latitude</label>
                            <input name="longitude" id="exampleLo" placeholder="Enter Outlet longitude" type="number" class="form-control @error('longitude') is-invalid @enderror" required>
                            @error('longitude')
                            <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="position-relative form-group">
                            <label for="exampleFile" class="">File</label>
                            <input name="img_url" id="exampleFile" type="file" class="form-control-file" required>
                            @error('img_url')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
