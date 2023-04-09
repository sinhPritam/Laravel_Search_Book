@extends('layouts.app')

@section('content')
<style>
    .error {
        color: red;
    }
</style>
{!!Form::model($bookdetails, array('route' => array('product.update'),'enctype' =>'multipart/form-data')) !!}
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
                        <label for="title" class="requireField">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$bookdetails->title}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="author" class="requireField">Author:</label>
                        <input type="text" class="form-control" id="author" name="author" value="{{$bookdetails
                        ->author}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description">{{$bookdetails
                        ->description}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="isbn">Isbn:</label>
                        <input type="number" class="form-control" name="isbn" id="isbn" value="{{$bookdetails->isbn}}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="genre">Genre:</label>
                        <input type="text" class="form-control" id="genre" name="genre" value="{{$bookdetails->genre}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="published">Published:</label>
                        <input type="date" class="form-control" id="published" name="published" value="{{$bookdetails->published}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="publisher">Publisher:</label>
                        <input type="text" class="form-control" id="publisher" name="publisher" value="{{$bookdetails->publisher}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                </div>
            </div>
            <input name="id" type="hidden" value="{{ $bookdetails->id }}">
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col" style="text-align: right;">
                    <a class="btn btn-danger btn-sm mr-2" href="{{route('getProductList')}}">Cancel</a>
                    <button class="btn btn-sm btn-info" type="submit">Update</button>
                </div>
            </div>
        </div>
    </div>

</div>
{!! Form::close() !!}
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
                title: {
                    required: true,
                    maxlength: 30
                },
                author: {
                    required: true,
                    maxlength: 30
                },
            },
            messages: {
                title: {
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