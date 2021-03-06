@extends('admin.layouts.app')

@section('headSection')

@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title pull-left">Tags Lists</h3>

                    @include('includes.messages')
                    <div class="box-tools pull-right">
                        <a class='col-lg-offset-5 btn btn-success' href="{{ route('tag.create') }}">Add New</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Tag Name</th>
                                    {{--<th>Slug</th>--}}
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>
                                            <a href="{{ route('tag.edit',$tag->id) }}"><span
                                                        class="fa fa-edit"></span></a>

                                            <form id="delete-form-{{ $tag->id }}" method="post"
                                                  action="{{ route('tag.destroy',$tag->id) }}"
                                                  style="display: none">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                            <a href="" onclick="
                                                    if(confirm('Are you sure, You Want to delete this?'))
                                                    {
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $tag->id }}').submit();
                                                    }
                                                    else{
                                                    event.preventDefault();
                                                    }"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>S.No</th>
                                    <th>Tag Name</th>
                                    {{--<th>Slug</th>--}}
                                    <th>Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('footerSection')

@endsection