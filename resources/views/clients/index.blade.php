@extends('layouts.app')
@section('page_title')
    العملاء
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جميع العملاء</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-4" style="float: right">
                    <form action="{{url(route('client.index'))}}" method="get" class="text-right">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control" value="{{request()->search}}">
                            <button class="btn btn-primary input-group-prepend">بحث</button>
                        </div>

                    </form>

                </div>
                <br>
                <br>
                <!-- Start Table -->
                @if (count($clients))
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">

                            <thead>
                            <tr>

                                <th>ID</th>
                                <th>الاسم</th>
                                <th>البريد الالكترونى</th>
                                <th>رقم الهاتف</th>
                                <th>تارخ الميلاد</th>
                                <th>المدينة</th>
                                <th>نوع فصيلة الدم</th>
                                <th>آخر معاد للتبرع</th>
                                <th>الحذف</th>
                                <th>الحالة</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client->id}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>{{$client->birth_date}}</td>
                                    <td>{{optional($client->city)->name}}</td>
                                    <td>{{optional($client->bloodtype)->name}}</td>
                                    <td>{{$client->donation_last_date}}</td>

                                    <td>
                                        <form action="{{(route('client.destroy', [$client->id]))}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash-o"></i>حذف</button>
                                        </form>

                                    </td>
                                    <!--
                                    <td>
                                        <a href="{{url(route('client.change-status', $client->id))}}" class="btn btn-primary">
                                            {{$client->is_active ?'Active' :'InActive'}}</a>
                                    </td>-->
                                    <td>
                                        <form action="{{url(route('client.change-status', $client->id))}}" method="post">
                                          @csrf
                                            <select style="min-width: 100px;" name="activated" class="form-control" onchange="submit()" >
                                                <option value="1"{{$client->is_active =='مفعل'?'selected':''}}>مفعل</option>
                                                <option value="0"{{$client->is_active =='غير مفعل'?'selected':''}}>غير مفعل</option>
                                            </select>
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
