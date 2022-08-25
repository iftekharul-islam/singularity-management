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
                    Outlet summary
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">
                        Summary
                        <a href="{{ route('outlet.create') }}" class="btn btn-primary ml-2">+ Outlet</a>
                    </h5>
                    <table class="mb-0 table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone no</th>
                            <th>Join Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($outlets as $outlet)
                            <tr>
                                <th scope="row">{{ $outlets->firstItem() + $loop->index }}</th>
                                <td>{{ $outlet->name }}</td>
                                <td>{{ $outlet->phone_no }}</td>
                                <td>{{ $outlet->created_at->format('d M, Y') }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('outlet.show', $outlet->id) }}" class="btn btn-info mr-2">show</a>
                                    <a href="{{ route('outlet.edit', $outlet->id) }}" class="btn btn-primary mr-2">Edit</a>
                                    <form action="{{ route('outlet.destroy', $outlet->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $outlets->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
