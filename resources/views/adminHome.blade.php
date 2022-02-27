@extends('layouts.master')

@section('contentheader')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0"> {{  Auth::user()->name }} Dashboard</h1>
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

$numberOfFiles = mysqli_query($con, "SELECT * FROM `files`");

while ($row = mysqli_fetch_assoc($numberOfFiles))
{
$fileCount[] = $row['id'];
}


$numberOfGroups = mysqli_query($con, "SELECT * FROM `groups`");

while ($row = mysqli_fetch_assoc($numberOfGroups))
{
$groupsCount[] = $row['id'];
}


$numberOfContacts = mysqli_query($con, "SELECT * FROM `file_details`");

while ($row = mysqli_fetch_assoc($numberOfContacts))
{
$contactsCount[] = $row['id'];
}


?>

    <div class="container-fluid">

        <!-- Small boxes (Stat box) -->
        <div class="row">

              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?= count($fileCount) ?></h3>
                    <p>Total Files</p>
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
                    <h3><?= count($groupsCount) ?></h3>
                    <p>Total Groups</p>
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
                    <h3><?= count($contactsCount) ?></h3>
                    <p>Total Contacts</p>
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