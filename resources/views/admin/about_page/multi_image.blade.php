@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Multi Image</h4><br>
                    <form method="POST" action="{{ route('store.multi.image') }}" enctype="multipart/form-data">
                        @csrf
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">About Multi Image</label>
                        <div class="col-sm-10">
                            <input name="multi_image[]" id="image" class="form-control" type="file" multiple="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <img id="showImage" class="img-thumbnail" width="150px" src="{{ url( 'upload/no_image.jpg') }}" alt="Card image cap">
                        </div>
                    </div>
                    <input class="btn btn-info waves-effect waves-light" type="submit" value="Add Multi image">

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
    });""
});


</script>

@endsection
