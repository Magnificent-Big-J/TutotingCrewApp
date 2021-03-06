@extends('layouts.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Student Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Student Information</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Student Data</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{route('student.update', $student->id)}}" method="post">
                    <div class="card-body">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Student Full Name</label>
                            <div class="col-sm-10 ">
                                <input type="text" name="name" class="form-control" id="name" value="{{$student->name}}">
                            </div>
                            @error('name')
                            <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Student Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" id="email" value="{{$student->email}}">
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Student Phone Number</label>
                            <div class="col-sm-10">
                                <input name="phone" type="text" class="form-control" id="phone" value="{{$student->phone}}">
                            </div>
                            @error('phone')
                            <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="location" class="col-sm-2 col-form-label">Student Location</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="location" rows="3"> {{$student->location}}</textarea>
                            </div>
                            @error('location')
                            <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
