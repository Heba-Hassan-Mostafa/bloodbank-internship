@extends('layouts.app')
@section('page_title')
     عرض التبرعات
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
                @if (count($orders))
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">

                            <thead>
                            <tr>
                                <th>نوع الفصيلة</th>
                                <th> اسم المريض</th>
                                <th>اسم المستشفى </th>
                                <th>المدينة</th>
                                <th> التفاصيل</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{optional($order->bloodtype)->name}}</td>
                                    <td>{{$order->patient_name}}</td>
                                    <td>{{$order->hospital_name}}</td>
                                    <td>{{optional($order->city)->name}}</td>
                                    <td> <a href="{{url(route('order.index', $order->id))}}" >
                                           التفاصيل</a></td>


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
