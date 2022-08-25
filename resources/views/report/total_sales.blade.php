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
                    Total Sales
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Summary <a href="{{ route('export.report') }}" class="btn btn-primary ml-2">Export list</a></h5>
                    <table class="mb-0 table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Store Name</th>
                            <th>Brand Name</th>
                            <th>Product Category</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Sale Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $key=>$report)
                                <tr>
                                    <th scope="row">{{ $reports->firstItem() + $loop->index }}</th>
                                    <td>{{ $report->store }}</td>
                                    <td>{{ $report->brand }}</td>
                                    <td>{{ $report->product_category }}</td>
                                    <td>{{ $report->product_name }}</td>
                                    <td>{{ $report->price }}</td>
                                    <td>{{ $report->created_at->format('d M, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $reports->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
