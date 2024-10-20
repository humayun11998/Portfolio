@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    }
</style>

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Blog Page</h4>
                    <form method="POST" action="{{ route('store.blog') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                        <div class="col-sm-10">
                            <select name="blog_category_id" class="form-select @error('blog_category_id') is-invalid @enderror" id="blog_category">
                                <option selected="" value="0">Open this select menu</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->blog_category }}</option>
                                @endforeach
                            </select>
                            @error('blog_category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title</label>
                        <div class="col-sm-10">
                            <input name="blog_title" class="form-control @error('blog_title') is-invalid @enderror" type="text" value="">
                            @error('blog_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Blog Description</label>
                        <div class="col-sm-10">
                            <textarea id="elm1" name="blog_description"></textarea>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tags</label>
                        <div class="col-sm-10">
                            <input name="blog_tags" class="form-control" type="text" value="home,tech" data-role="tagsinput">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Blog Image</label>
                        <div class="col-sm-10">
                            <input name="blog_image" id="image" class="form-control" type="file">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <img id="showImage" class="img-thumbnail" width="150px" src="{{ url('upload/no_image.jpg') }}" alt="Portfolio image">
                        </div>
                    </div>
                    <input class="btn btn-info waves-effect waves-light" type="submit" value="Insert Blog">

                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>

<script type="text/javascript">

$(document).ready(function () {
    $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});


</script>

@endsection
