@extends('admin.admin_master')
@section('admin')

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Blog Category Page</h4><br>
                    <form method="POST" action="{{ route('store.blog.category') }}">
                        @csrf
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                        <div class="col-sm-10">
                            <input name="category_name" class="form-control @error('category_name') is-invalid @enderror" type="text" value="">
                            @error('category_name')
                            <span class="text-danger is-invalid">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <input class="btn btn-info waves-effect waves-light" type="submit" value="Add Blog Category">

                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>

@endsection
