@extends('layouts.master')


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


{{-- @foreach($FileDetails as $FileDetails)

<?php $FileDetailsArray[]=$FileDetails->id;?>
@endforeach

<?php $FileDetailsArrayChunk[]=array_chunk($FileDetailsArray,2);
  echo count($FileDetailsArrayChunk);
?> --}}
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
                    <th>Group Name</th>
                    <th>Total </th>
                    <th>Show</th>
                  </tr>
                  </thead>
                  


                  <tbody>
                  <?php $i=0; ?>
                  @foreach ($GroupData as $GroupDatas)
                  
                  <tr>
                    <td>{{ $GroupDatas->group_name }}</td>
                    <td>100</</td>
                    <td>
                    <a href="{{ route('view-group-details', ['id'=>$GroupDatas->id]) }}" class="btn btn-secondary btn-xl" style="padding: 2px 11px;" target="_blank">Show</a>

                    </td>
                  </tr>

                   @endforeach
                  </tbody>
                  

                  <tfoot>
                  <tr>
 					<th>Group Name</th>
                    <th>Total </th>
                    <th>Show</th>
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
