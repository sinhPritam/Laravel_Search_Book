@extends('layouts.app')

@section('content')
<style>
    .error {
        color: red;
    }

    .requireField:after {
        content: '*';
        color: red;
        padding-left: 5px;
    }
</style>
<form id="product_create_form" action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Product Management
                            <small class="text-muted">Add product</small>
                        </h4>
                    </div>
                    <!--col-->
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="book_title" class="requireField">Title:</label>
                            <input type="text" class="form-control" id="book_title" name="book_title">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author" class="requireField">Author:</label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="isbn">Isbn:</label>
                            <input type="number" class="form-control" name="isbn" id="isbn">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="genre">Genre:</label>
                            <input type="text" class="form-control" id="genre" name="genre">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="published">Published:</label>
                            <input type="date" class="form-control" id="published" name="published">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="publisher">Publisher:</label>
                            <input type="text" class="form-control" id="publisher" name="publisher">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" id="image" name="image" accept="image/*">
                        </div>
                    </div>
                </div>
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col" style="text-align: right;">
                        <a class="btn btn-danger btn-sm mr-2" href="{{route('getProductList')}}">Cancel</a>
                        <button class="btn btn-sm btn-info" type="submit">Create</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection
@push('after-scripts')
<script>
    $(document).ready(function() {
        $('#product_create_form').submit(function(e) {
            e.preventDefault()
            console.log('2121')
            $("#product_create_form").valid()
        })
        console.log($('#product_create_form'))
        $("#product_create_form").validate({
            rules: {
                book_title: {
                    required: true,
                    maxlength: 30
                },
                author: {
                    required: true,
                    maxlength: 30
                },
            },
            messages: {
                book_title: {
                    required: "The title field is required",
                },
                author: {
                    required: "The author field is required",
                }
            },
            errorPlacement: function(error, e) {
                error.insertAfter(e);
            },
            // define validation rules
            submitHandler: function(form) {
                form.submit();
            }
        });
    })
</script>
@endpush