@extends('layouts.app')
@section('page_title')
    تعديل المنشور
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{(route('post.update', [$model->id]))}}"  method="post"]>
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title">العنوان</label>
                        <input class="form-control" type="text" name="title"  value="{{$model->title}}">

                        <label for="content"> المحتوى</label>
                        <input class="form-control" type="text" name="content"  value="{{$model->content}}" >

                        <label for="image">الصورة</label>
                        <input class="form-control" type="file" name="image"  value="{{$model->image}}">

                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">حفظ</button>
                    </div>
                    @include('flash::message')

                </form>



            @include('partial.validation-errors')

            <!-- /.card-body -->

            </div>
            <!-- End card -->
        </div>
    </section>
    <!-- End Section -->
@endsection
