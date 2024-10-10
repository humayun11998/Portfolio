@extends('admin.admin_master')
@section('admin')

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Multi Image All</h4><br>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead style="text-align: center;">
                        <tr>
                            <th>Sl</th>
                            <th>About Multi image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($allMultiImages as $allMultiImage)
                            <tr>
                                <td style="text-align: center;">{{ $i++ }}</td>
                                <td style="text-align: center;">
                                    <img class="img-thumbnail" width="120" src="{{ asset($allMultiImage->multi_image) }}" alt="Image">
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('edit.multi.image', $allMultiImage->id) }}" class="btn btn-info " title="Edit Data"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('delete.multi.image', $allMultiImage->id) }}" class="btn btn-danger " title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>



</div>
</div>



@endsection
