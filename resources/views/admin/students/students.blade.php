@extends('layouts.datatabe')

@section('content')
      <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Student Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Student Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="float-right mb-4">
                <a href="{{route('student.create')}}" class="btn btn-primary btn-sm">Create New Student</a>
            </div>
            <div class="table-responsive">
                <table id="students" class="table table-bordered table-striped">
                   <thead>
                       <th>Name</th>
                       <th>Phone</th>
                       <th>Email</th>
                       <th width="20%">Location</th>
                       <th>Actions</th>
                   </thead>
                </table>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
@section('scripts')

    <script>
        $(document).ready(function(){

            $('#students').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('student.view') }}",
                },
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false
                    }
                ]
            });

        });
    </script>
@endsection
