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

                    @include('includes.messages')

                    <!-- general form elements -->
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Add Admin</h3>
                        </div>


                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" @if (count($errors) > 0) class="was-validated"
                              @endif action="{{ route('user.store') }}" id="addUser" method="post" novalidate>
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="offset-3 col-lg-6">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        <label for="name">Full Name</label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
                                               id="name" name="name" placeholder="User Name" value="{{ old('name') }}"
                                               required>
                                        {!! $errors->first('name','<p class="invalid-feedback">:message</p>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text"
                                               class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}"
                                               id="email" name="email" placeholder="email" value="{{ old('email') }}"
                                               email>
                                        {!! $errors->first('email','<p class="invalid-feedback">:message</p>') !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               placeholder="phone" value="{{ old('phone') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="password" value="{{ old('password') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Passowrd</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation" placeholder="confirm passowrd">
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
                                            <a href='{{ route('user.index') }}' class="btn btn-warning">Back</a>
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

@section('footerSection')

@endsection