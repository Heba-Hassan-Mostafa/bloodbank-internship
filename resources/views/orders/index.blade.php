@extends('layouts.app')
@section('page_title')
    التبرعات
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جميع التبرعات</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-4" style="float: right">
                    <form action="{{url(route('order.index'))}}" method="get" class="text-right">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control" value="{{request()->search}}">
                            <button class="btn btn-primary input-group-prepend">بحث</button>
                        </div>

                    </form>

                </div>
                <br>
                <br>
                <!-- Start Table -->
                @if (count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">

                            <thead>
                            <tr>

                                <th>ID</th>
                                <th>اسم العميل</th>
                                <th> اسم المريض</th>
                                <th>سن المريض </th>
                                <th>نوع الفصيلة</th>
                                <th>عدد الاكياس</th>
                                <th>اسم المستشفى </th>
                                <th>عنوان المستشفى</th>
                                <th>المدينة</th>
                                <th>رقم الهاتف</th>
                                <th> الملاحظات</th>
                                <th>الحذف</th>
                                <th>العرض</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td>{{$record->id}}</td>
                                    <td>{{optional($record->client)->name}}</td>
                                    <td>{{$record->patient_name}}</td>
                                    <td>{{$record->patient_age}}</td>
                                    <td>{{optional($record->bloodtype)->name}}</td>
                                    <td>{{$record->bags_number}}</td>
                                    <td>{{$record->hospital_name}}</td>
                                    <td>{{$record->hospital_address}}</td>
                                    <td>{{optional($record->city)->name}}</td>
                                    <td>{{$record->phone}}</td>
                                    <td>{{$record->notes}}</td>

                                    <td>
                                        <form action="{{(route('order.destroy', [$record->id]))}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash-o"></i>حذف</button>
                                        </form>

                                    </td>
                                    <td>
                                        <a href="{{url(route('order.show', $record->id))}}" class="btn btn-success">عرض</a>
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
