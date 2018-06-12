@extends('admin.layouts.app');

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{--<ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Editors</li>
            </ol>--}}
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Add Category</h3>
                        </div>

                        @include('includes.messages')
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('category.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="offset-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Category Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Category Name" value="{{ old('name') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm_passowrd">Status</label>

                                        <div class="checkbox">
                                            <label><input type="checkbox" name="status" @if (old('status') == 1)
                                                          checked
                                                          @endif value="1">Status</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href='{{ route('category.index') }}' class="btn btn-warning">Back</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>

            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
@endsection