@extends('layouts.app')
@section('page_title')
    تعديل الاعدادات
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{url(route('setting.store'))}}" method="post">
                    @csrf
                    <div class="form-group ">
                        <label for="app_url">مسار التطبيق</label>
                        <input class="form-control" type="text" name="app_url" value="{{$records->app_url}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">رقم الهاتف</label>
                        <input class="form-control" type="text" name="phone" value="{{$records->phone}}" >
                    </div>
                    <div class="form-group">
                        <label for="email">البريد الالكترونى</label>
                        <input class="form-control" type="text" name="email" value="{{$records->email}}" >
                    </div>
                    <div class="form-group">
                        <label for="facebook_url">الفيس بوك</label>
                        <input class="form-control" type="text" name="facebook_url" value="{{$records->facebook_url}}">
                    </div>
                    <div class="form-group">
                        <label for="youtube_url">اليوتيوب</label>
                        <input class="form-control" type="text" name="youtube_url" value="{{$records->youtube_url}}">
                    </div>
                    <div class="form-group">
                        <label for="twitter_url">تويتر</label>
                        <input class="form-control" type="text" name="twitter_url" value="{{$records->twitter_url}}">
                    </div>
                    <div class="form-group">
                        <label for="whatsup">الواتس اب</label>
                        <input class="form-control" type="text" name="whatsup" value="{{$records->whatsup}}">
                    </div>
                    <div class="form-group">
                        <label for="instgram_url">انستجرام</label>
                        <input class="form-control" type="text" name="instgram_url" value="{{$records->instgram_url}}">
                    </div>
                    <div class="form-group">
                        <label for="about_app">عن التطبيق</label>
                        <input class="form-control" type="text" name="about_app" value="{{$records->about_app}}" >
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
