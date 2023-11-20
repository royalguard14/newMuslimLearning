@extends('layouts.master')

@section('heading')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard v2s</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection



@section('body')

<div class="row">
<section class="col-lg-5 connectedSortable">
  <!-- left side -->
</section>
<!-- edit base on design -->
<section class="col-lg-5 connectedSortable">
<!-- right side -->
</section>
</div>
@endsection





@section('extra_head')

@endsection
@section('extra_script')

@endsection