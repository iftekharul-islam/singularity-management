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
                    Sales Summary
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <form action="{{ route('admin.sales.summary') }}" method="get">
                    <div class="card-body d-flex">
                        <div class=" form-group col-4">
                            <label for="searchField" class="">Search</label>
                            <input name="search" id="searchField" placeholder="Store, Brand, Category, Product name" type="search" value="{{ request()->get('search') ?? '' }}" class="form-control">
                        </div>
                        <div class=" form-group col-3">
                            <label for="sDate" class="">Start Date</label>
                            <input name="start_date" id="sDate" type="date" value="{{ request()->get('start_date') ?? '' }}" class="form-control">
                        </div>
                        <div class=" form-group col-3">
                            <label for="eDate" class="">End Date</label>
                            <input name="end_date" id="eDate" type="date" value="{{ request()->get('end_date') ?? '' }}" class="form-control">
                        </div>
                        <div class=" form-group col-2 mt-1">
                            <button type="submit" class="btn btn-primary mt-4">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <form action="{{ route('filter.export.report') }}" method="get">
                        <h5 class="card-title">
                            Summary
                            <input type="hidden" name="search" value="{{ request()->get('search') ?? '' }}">
                            <input type="hidden" name="start_date" value="{{ request()->get('start_date') ?? '' }}">
                            <input type="hidden" name="end_date" value="{{ request()->get('end_date') ?? '' }}">
                            <button type="submit" class="btn btn-primary ml-2">Export list</button>
                        </h5>
                    </form>
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
