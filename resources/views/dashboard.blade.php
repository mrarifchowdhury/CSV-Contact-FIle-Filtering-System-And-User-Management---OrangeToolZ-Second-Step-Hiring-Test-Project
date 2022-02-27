@extends('layouts.master')

@section('contentheader')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">{{ Auth::user()->name }} Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard v1</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

   
@section('content')

<?php
$con = mysqli_connect("localhost","root","","orangetoolz");

$user_id =  Auth::user()->id ;

$numberOfFiles = mysqli_query($con,"SELECT * FROM files INNER JOIN users ON files.user_id = users.id WHERE files.user_id = '$user_id'");
$fileCount = mysqli_num_rows($numberOfFiles);


$numberOfGroups = mysqli_query($con,"SELECT * FROM groups INNER JOIN files ON groups.file_id = files.id 
INNER JOIN users ON users.id = files.user_id WHERE users.id ='$user_id'");
$groupsCount = mysqli_num_rows($numberOfGroups);



$numberOfGroups = mysqli_query($con,"SELECT * FROM file_details INNER JOIN files ON file_details.file_id = files.id INNER JOIN users ON users.id = files.user_id WHERE users.id ='$user_id'");
$contactsCount = mysqli_num_rows($numberOfGroups);

?>


    <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="row">

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php
                      if ($fileCount == '0') {
                        echo "0";
                      }
                      else{
                        echo $fileCount;
                      }
                     ?></h3>
                    <p>Your Uploaded Files</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-filing"></i>
                  </div>
                  <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
              </div>
              <!-- ./col -->


              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php
                      if ($groupsCount == '0') {
                        echo "0";
                      }
                      else{
                        echo $groupsCount;
                      }
                     ?></h3>
                    <p>Generated Groups</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
              </div>
              <!-- ./col -->


              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?php
                      if ($contactsCount == '0') {
                        echo "0";
                      }
                      else{
                        echo $contactsCount;
                      }
                     ?></h3>
                    <p>Filtered Contacts</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
              </div>
              <!-- ./col -->


        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->

@endsection