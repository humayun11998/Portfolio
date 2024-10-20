@extends('admin.admin_master')
@section('admin')

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Blog Category All</h4><br>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead style="text-align: center;">
                        <tr>
                            <th>Sl</th>
                            <th>Blog Category</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($blogCategory as $item)
                            <tr>
                                <td style="text-align: center;">{{ $i++ }}</td>
                                <td style="text-align: center;">{{ $item->blog_category }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('edit.blog.category', $item->id) }}" class="btn btn-info " title="Edit Data"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('delete.blog.category', $item->id) }}" class="btn btn-danger " title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
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
