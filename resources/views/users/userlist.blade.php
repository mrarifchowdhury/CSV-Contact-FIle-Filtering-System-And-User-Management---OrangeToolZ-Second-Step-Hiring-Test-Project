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
                  	<th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  


                  <tbody>
                  <?php $i=0; ?>
                  @foreach ($allData as $allDatas)
                  
                  <tr>
                  	<td>{{++$i}}</td>
                    <td>{{ $allDatas->name }}</td>
                    <td>{{ $allDatas->email }}</td>
                    <td>
          


                    @if($allDatas->status == 1)

                       
                       <a href="#changeStatus{{$allDatas->id}}" class="btn btn-success btn-xl" style="padding: 2px 20px;" data-toggle="modal">Active</a>

                    @else

                      <a href="#changeStatus{{$allDatas->id}}" class="btn btn-danger btn-xl" style="padding: 2px 11px;" data-toggle="modal">Deactive</a>

                    @endif

                    </td>
                    <td>
                    	<a href="#editModal{{$allDatas->id}}" class="btn btn-secondary btn-xl" style="padding: 2px 11px;" data-toggle="modal">Edit</a>
                    </td>
                    <td>
                    	<a href="#my-modal{{$allDatas->id}}" class="btn btn-warning btn-xl rounded" data-toggle="modal" style="padding: 2px 11px;">Delete</a>
                    </td>
                  </tr>



            <!-- User Edit Modal Start -->
                        <div class="modal fade" id="editModal{{$allDatas->id}}" tabindex="-1" role="dialog">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
								<div class="modal-header">
								<h4 class="modal-title"><i class="fa fa-edit" style="color: #E08E0B"></i>Update Users</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</button>
								</div>
                                {!! Form::open(array('route' => ['users.update', $allDatas->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
                              <div class="modal-body">
                                <div class="form-group">
                                    <div class="col-md-12">
                                      <label for="name">Name: </label>
                                      <input type="text" class="form-control" value="{{  $allDatas->name  }}" name="name" placeholder="Name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                      <label for="name">Email: </label>
                                      <input type="text" class="form-control" value="{{  $allDatas->email  }}" name="email" placeholder="Email" required>
                                    </div>
                                </div>
                                
                   
                                 
                              </div>
								<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
								 {{Form::submit('Update',array('class'=>'btn btn-warning'))}}
								</div>
                                {!! Form::close() !!}
                            </div><!-- /.modal-content -->
                          </div><!-- /.modal-dialog -->
                        </div>
            <!-- User Edit modal End-->


        <!-- ..................................... Delete Confirmation Model ............................................... -->

        <!-- Start Delete Confirmation Model -->
        <div id="my-modal{{$allDatas->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="modal-body p-0">
                        <div class="card border-0 p-sm-3 p-2 justify-content-center">
                            <div class="card-header pb-0 bg-white border-0 ">
                                <div class="row">
                                    <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                                </div>
                                <p class="font-weight-bold mb-2"> Are you sure you wanna delete this ?</p>
                                
                            </div>
                            <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                                <div class="row justify-content-end no-gutters">
                                    <div class="col-auto"><button type="button" class="btn btn-light text-muted" data-dismiss="modal">Cancel</button></div>


                                <div class="col-auto">
                                    {{Form::open(array('route'=>['users.destroy',$allDatas->id],'method'=>'DELETE'))}}
                                    <button type="submit" class="btn btn-danger px-4 confirm" >Delete</button>
                                    {!! Form::close() !!}
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Delete Confirmation Model -->



        <!-- ..................................... Deactivate Confirmation Model ............................................... -->

        <!--  Deactivate Confirmation Model -->
        <div id="changeStatus{{$allDatas->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="modal-body p-0">
                        <div class="card border-0 p-sm-3 p-2 justify-content-center">
                            
                        @if($allDatas->status == 1)

                            <div class="card-header pb-0 bg-white border-0 ">
                                <div class="row">
                                    <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                                </div>
                                <p class="font-weight-bold mb-2"> Do you want to DEACTIVATE this user ?</p>
                                
                            </div>
                            <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                                <div class="row justify-content-end no-gutters">
                                    <div class="col-auto"><button type="button" class="btn btn-secondary text-light mr-2" data-dismiss="modal">Cancel</button></div>


                                <div class="col-auto">
                                    
                                {!! Form::open(array('route' => ['update-user-status', $allDatas->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
                                    <button type="submit" class="btn btn-danger px-4 confirm" >Deactive</button>
                                {!! Form::close() !!}

                                </div>
                                </div>
                            </div>

                            @elseif($allDatas->status == 0)

                            <div class="card-header pb-0 bg-white border-0 ">
                                <div class="row">
                                    <div class="col ml-auto"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>
                                </div>
                                <p class="font-weight-bold mb-2"> Do you want to ACTIVE this user ?</p>
                                
                            </div>
                            <div class="card-body px-sm-4 mb-2 pt-1 pb-0">
                                <div class="row justify-content-end no-gutters">
                                    <div class="col-auto"><button type="button" class="btn btn-secondary text-light mr-2" data-dismiss="modal">Cancel</button></div>

                                <div class="col-auto">                                    
                                {!! Form::open(array('route' => ['update-user-status', $allDatas->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
                                    <button type="submit" class="btn btn-success px-4 confirm" >Active</button>
                                {!! Form::close() !!}

                                </div>
                                </div>
                            </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Delete Confirmation Model -->



                   @endforeach
                  </tbody>
                  

                  <tfoot>
                  <tr>
                  	<th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
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

	$('input[type="checkbox"]').on('change', function(e){
	if(e.target.checked){
	$('#myModal').modal();
	}
	});



    $(".flash_msg").animate({opacity: "0"},3000);
    $(".flash_msg").slideUp(1000);
});
</script>


@endsection