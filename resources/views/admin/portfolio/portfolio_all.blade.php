@extends('admin.admin_master')
@section('admin')

<div class="page-content">
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Portfolio All Data</h4><br>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead style="text-align: center;">
                        <tr>
                            <th>Sl</th>
                            <th>Portfolio Name</th>
                            <th>Portfolio Title</th>
                            <th>Portfolio Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach ($portfolio as $item)
                            <tr>
                                <td style="text-align: center;">{{ $i++ }}</td>
                                <td style="text-align: center;">{{ $item->portfolio_name }}</td>
                                <td style="text-align: center;">{{ $item->portfolio_title }}</td>
                                <td style="text-align: center;">
                                    <img class="img-thumbnail" width="130" src="{{ asset($item->portfolio_image) }}" alt="Image">
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{ route('edit.portfolio', $item->id) }}" class="btn btn-info " title="Edit Data"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('delete.portfolio', $item->id) }}" class="btn btn-danger " title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
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
