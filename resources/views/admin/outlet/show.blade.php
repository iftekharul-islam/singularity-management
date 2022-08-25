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
                    Outlet Details
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <table class="mb-0 table table-hover table-borderless">
                        <tbody>
                        <tr>
                            <th>Name</th>
                            <th>{{ $outlet->name }}</th>
                        </tr>
                        <tr>
                            <th>Phone no</th>
                            <td>{{ $outlet->phone_no }}</td>
                        </tr>
                        <tr>
                            <th>Latitude</th>
                            <td>{{ $outlet->latitude }}</td>
                        </tr>
                        <tr>
                            <th>Longitude</th>
                            <td>{{ $outlet->longitude }}</td>
                        </tr>
                        <tr>
                            <th>Join date</th>
                            <td>{{ $outlet->created_at->format('d M, Y') }}</td>
                        </tr>
                        <tr>
                            <th>image</th>
                            <td>
                                <img width="100" height="100" class="rounded-circle" src="{{ asset($outlet->img_url) }}" alt="">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

