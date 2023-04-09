@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="form-outline mb-2 col-md-8">
            <!-- <input type="search" class="form-control" id="datatable-search-input">
            <label class="form-label" for="datatable-search-input">Search</label> -->
            <form method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Search Book you want..." aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn btn-success" type="submit" id="searchBtn">Search</button>
                </div>
            </form>
        </div>
        @if(Auth::user()->isProductAdmin())
        <div class="col-md-2">
            <a class="btn btn-success btn-sm" href="{{ url('/product') }}">Go to Product page</a>
        </div>
        @endif
        @if(isset($bookdetails))
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookdetails as $user)
                <tr>
                    <td><a href="{{ url('/product',$user->id) }}" class="underline">{{ $user->title }}</a></td>
                    <td>{{ $user->author }}</td>
                    <td>{{ $user->description }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center;">There are no book available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {!! $bookdetails->withQueryString()->links('pagination::bootstrap-5') !!}
        @endif
    </div>
</div>
@endsection