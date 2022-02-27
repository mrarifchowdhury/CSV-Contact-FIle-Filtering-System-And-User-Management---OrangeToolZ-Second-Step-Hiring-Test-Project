@extends('layouts.master')

@section('contentheader')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Add User</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Add User</li>
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
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add User Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             {!! Form::open(array('route' => ['users.store'],'class'=>'form-horizontal','method'=>'POST')) !!}

                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            
            {!! Form::close() !!}

            </div>
            <!-- /.card -->


          </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

@endsection


@section('scripts')

<script type="text/javascript">
$(document).ready(function(){
    $(".flash_msg").animate({opacity: "0"},3000);
    $(".flash_msg").slideUp(1000);
});
</script>

@endsection