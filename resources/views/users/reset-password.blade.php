@extends('layouts.app')
@inject('role','App\Role')
@section('page_title')
   تغيير كلمة المرور
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

                <h2>
                    @if(Auth::check())
                        Welcome {{ Auth::user()->name }}
                    @endif
                </h2>
                <br>
                <form action="{{url(route('user.change-password'))}}"  method="post">
                    @csrf
                    <div class="form-group">
                        <label for="old_password">كلمة المرور الحالية</label>
                        <input class="form-control" type="password" name="old_password" >
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة المرور الجديدة</label>
                        <input class="form-control" type="password" name="password" >
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">تاكيد كلمة المرور</label>
                        <input class="form-control" type="password" name="password_confirmation" >
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">حفظ</button>
                    </div>

                </form>
            @include('partial.validation-errors')

            <!-- /.card-body -->

            </div>
            <!-- End card -->
        </div>
    </section>
    <!-- End Section -->
@endsection
