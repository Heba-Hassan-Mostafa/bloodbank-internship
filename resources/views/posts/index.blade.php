@extends('layouts.app')
@section('page_title')
    المقالات
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جميع المقالات</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <!--Search For Posts -->
            <div class="card-body">
                <div>
                    <a href="{{url(route('post.create'))}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> اضافة مقالة </a>
                </div>
                <div class="col-md-4" style="float: right">
                    <form action="{{url(route('post.index'))}}" method="get" class="text-right">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control" value="{{request()->search}}">
                            <button class="btn btn-primary input-group-prepend">بحث</button>
                        </div>

                    </form>

                </div>
                <br>
                <br>

                <!-- Start Table -->
                @if (count($posts))
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">

                            <thead>
                            <tr>

                                <th>ID</th>
                                <th>القسم</th>
                                <th>العنوان</th>
                                <th>المحتوى</th>
                                <th>الصورة</th>
                                <th>التعديل</th>
                                <th>الحذف</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                <!--<td>{{$loop->iteration}}</td>-->
                                    <td>{{$post->id}}</td>
                                    <td>{{optional($post->category)->name}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->content}}</td>
                                    <td>
                                    @if($post->image)
                                        <img src="{{asset('image/backend_image'.$post->image)}}">
                                        @endif
                                   </td>
                                    <td>
                                        <a href="{{url(route('post.edit', $post->id))}}" class="btn btn-success">
                                            <i class="fa fa-edit"></i>تعديل</a>
                                    </td>
                                    <td>
                                        <form action="{{(route('post.destroy', [$post->id]))}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash-o"></i>حذف</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach


                            </tbody>

                        </table>
                    </div>

                @else
                    <div class="alert alert-danger" role="alert">
                      لا توجد بيانات
                    </div>
                @endif

            <!-- End Table -->

                @include('flash::message')

            </div>
            <!-- /.card-body -->

        </div>
        <!-- End card -->

    </section>
    <!-- End Section -->
@endsection
