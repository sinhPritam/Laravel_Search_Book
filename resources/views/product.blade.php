@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Auth::user()->isProductAdmin())
        <div class="col-md-12 mb-4">
            <div class="btn-toolbar" style="float: right" role="toolbar" aria-label="">
                <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm ml-1" data-toggle="tooltip" title="Add Product" id="addProduct"><i class="fa fa-plus-circle"></i></a>
            </div>
        </div>
        @endif
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Phone</th>
                    <th>Genre</th>
                    <th>Description</th>
                    <th>Isbn</th>
                    <th>Image</th>
                    <th>Published</th>
                    <th>Publisher</th>
                    @if(Auth::user()->isProductAdmin())
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($bookdetails as $user)
                <tr>
                    <td>{{ $user->title }}</td>
                    <td>{{ $user->author }}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->genre}}</td>
                    <td>{{ $user->description }}</td>
                    <td>{{$user->isbn}}</td>
                    @if(!preg_match('/http:/', $user->image))
                    <td><img src="{{asset('public/image/'.$user->image)}}" alt="" width="60" height="60"></td>
                    @else
                    <td><img src="{{$user->image}}" alt="" width="60" height="60"></td>
                    @endif

                    <td>{{$user->published}}</td>
                    <td>{{ $user->publisher }}</td>
                    @if(Auth::user()->isProductAdmin())
                    <td>
                        <div class="btn-group btn-group-sm" group="group" aria-label="User Actions">
                            <a href="{{route('product.edit',$user->id)}}" class="mr-1 edit-group" id="10"><i class="fa fa-pencil fa-lg" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>

                            <a href="#" class="delete_product" data-id="{{$user->id}}"><i class="fa fa-trash fa-lg" data-toggle="tooltip" data-placement="top" title="delete"></i></a>
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center;">There are no books available.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {!! $bookdetails->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection
@push('after-scripts')
<script>
    var deleteUrl = "{{route('product.delete')}}";

    $(document).ready(function() {
        $('.delete_product').on('click', function(e) {
            let id = $(this).data('id')

            let swalWithBootstrapButtons = Swal.mixin({
                // customClass: {
                //     confirmButton: 'btn btn-success',
                //     cancelButton: 'btn btn-danger'
                // },
                // buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: deleteUrl,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            'id': id
                        },
                        method: "POST",
                        success: function(response) {
                            console.log(response);
                            if (response.data.status == 200) {
                                swalWithBootstrapButtons.fire({
                                    text: response.data.msg,
                                    icon: 'success',
                                }).then(() => {
                                    window.location.reload();
                                })

                            }
                        },

                    });
                }
            })
        })
    })
</script>
@endpush