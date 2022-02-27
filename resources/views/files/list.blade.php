@extends('layouts.master')

@section('pagecss')

<!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


@endsection

@section('contentheader')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">User List</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">User List</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection


@section('content')
	
      <div class="container-fluid">

	  @if (count($errors) > 0)
	        <div class="alert alert-danger flash_msg">
	            <strong>Whoops!</strong> There were some problems with your input.<br><br>
	            <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	            </ul>
	        </div>
	    @endif

	    @if(Session::has('flash_message'))
	        <div style="font-size: 18px;font-style: italic;margin-top:15px;font-weight: bold;" class="flash_msg alert alert-{{ session('status_color') }}">
	            <span class="fa fa-check-square-o"></span><em> {!! session('flash_message') !!}</em>
	        </div>
	    @endif


        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>File Name</th>
                    <th>Total Uploaded</th>
                    <th>Total Process</th>
                    <th>Group</th>
                  </tr>
                  </thead>
                  


                  <tbody>
                  <?php $i=0; ?>
                  @foreach ($FileData as $FileDatas)
                  
                  <tr>
                    <td>{{ $FileDatas->original_name }}</td>
                    <td>{{ $FileDatas->total_uploaded }}</td>
                    <td>{{ $FileDatas->total_process }}</</td>
                    <td>
                    <a href="{{ route('view-group-details', ['id'=>$FileDatas->id]) }}" class="btn btn-secondary btn-xl" style="padding: 2px 11px;" target="_blank">Group</a>

                    </td>
                  </tr>

                   @endforeach
                  </tbody>
                  

                  <tfoot>
                  <tr>
                  	<th>File Name</th>
                    <th>Total Uploaded</th>
                    <th>Total Process</th>
                    <th>Group</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->


@endsection


@section('scripts')

<!-- DataTables  & Plugins -->
<script src="{{  asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{  asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{  asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{  asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{  asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{  asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{  asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{  asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{  asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{  asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{  asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{  asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>



<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');



    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

  });
</script>


<script type="text/javascript">
$(document).ready(function(){
    $(".flash_msg").animate({opacity: "0"},3000);
    $(".flash_msg").slideUp(1000);
});
</script>



@endsection