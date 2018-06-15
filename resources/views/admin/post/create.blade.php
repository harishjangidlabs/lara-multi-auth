@extends('admin.layouts.app');

@section('headSection')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection

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
                            <h3 class="card-title">Add Post</h3>
                        </div>
                        <div class="offset-1 col-lg-9">
                            @include('includes.messages')
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('post.store') }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="offset-2 col-lg-7">
                                    <div class="form-group">
                                        <label for="name">Post Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                               placeholder="Post Title" value="{{ old('title') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Post Sub title</label>
                                        <input type="text" class="form-control" id="sub_title" name="sub_title"
                                               placeholder="Sub Title" value="{{ old('sub_title') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Select Category</label>
                                        <select class="form-control select2 select2-hidden-accessible" multiple=""
                                                data-placeholder="Select a category" style="width: 100%;" tabindex="-1"
                                                aria-hidden="true" name="categories[]">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">
                                                    {{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Select Tags</label>
                                        <select class="form-control select2 select2-hidden-accessible" multiple=""
                                                data-placeholder="Select a tag" style="width: 100%;" tabindex="-1"
                                                aria-hidden="true" name="tags[]">
                                            @foreach($tags as $tag)
                                                <option value="{{$tag->id}}">
                                                    {{$tag->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="file">Choose file</label>
                                            </div>
                                            {{--<div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>--}}
                                        </div>
                                    </div>

                                </div>

                                <div class="offset-1 col-md-9">

                                    <div class="form-group">
                                        <label for="name">Post Content</label>
                                        <textarea name="body"
                                                  style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                                  id="editor1"></textarea>
                                    </div>


                                </div>

                                <div class="offset-2 col-md-7">

                                    <div class="form-group">
                                        <label for="confirm_passowrd">Status</label>

                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="status" @if (old('status') == 1) checked
                                                       @endif value="1">Status
                                            </label>
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
@section('footerSection')
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{  asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">

        jQuery(document).ready(function () {

            CKEDITOR.replace('editor1');
            $(".select2").select2();
        });


    </script>
@endsection