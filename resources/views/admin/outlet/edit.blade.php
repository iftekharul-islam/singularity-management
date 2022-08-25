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
                    <form action="{{ route('outlet.update', $outlet->id) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="position-relative form-group">
                            <label for="exampleName" class="">Name</label>
                            <input name="name" id="exampleName" placeholder="Enter your name" type="text" value="{{ $outlet->name }}" class="form-control @error('name') is-invalid @enderror">
                        </div>
                        <div class="position-relative form-group">
                            <label for="examplePh" class="">Phone No</label>
                            <input name="phone_no" id="examplePh" type="number" value="{{ $outlet->phone_no }}" class="form-control @error('phone_no') is-invalid @enderror">
                        </div>
                        <div class="position-relative form-group">
                            <label for="exampleLa" class="">Latitude</label>
                            <input name="latitude" id="exampleLa" type="text" value="{{ $outlet->latitude }}" class="form-control @error('latitude') is-invalid @enderror">
                        </div>
                        <div class="position-relative form-group">
                            <label for="exampleLn" class="">Longitude</label>
                            <input name="longitude" id="exampleLn" type="text" value="{{ $outlet->longitude }}" class="form-control @error('longitude') is-invalid @enderror">
                        </div>
                        <div class="position-relative form-group">
                            <label for="exampleFile" class="">File</label>
                            <input name="img_url" id="exampleFile" type="file" class="form-control-file">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
