@extends('layouts.app')
@inject('role','App\Role')
@section('page_title')
    اضافة مستخدم
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
                <?php
                    $roles=$role->pluck('display_name','id')->toArray();
                ?>
                <form action="{{url(route('user.store'))}}"  method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input class="form-control" type="text" name="name" >
                    </div>
                    <div class="form-group">
                        <label for="email">الايميل</label>
                        <input class="form-control" type="email" name="email" >
                    </div>
                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input class="form-control" type="password" name="password" >
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">تاكيد كلمة المرور</label>
                        <input class="form-control" type="password" name="password_confirmation" >
                    </div>
                    <div class="form-group">
                        <label for="roles_list">رتب المستخدمين</label>
                        <select class="custom-select" name="roles_list" multiple>
                            @foreach($roles as $id => $name)
                            <option value="{{$id}}"  >{{$name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">اضافة</button>
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
