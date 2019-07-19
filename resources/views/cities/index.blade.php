@extends('layouts.app')
@section('page_title')
    المدن -> {{$governorate->name}}
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">جميع المدن</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <a href="{{url(route('governorate.city.create',$governorate->id))}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> اضافة مدينة </a>

                </div>
                <br>

                <!-- Start Table -->
                @if (count($cities))
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">

                            <thead>
                            <tr>

                                <th>ID</th>
                                <th>الاسم</th>
                                <th>التعديل</th>
                                <th>الحذف</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <td>{{$city->id}}</td>
                                    <td>{{$city->name}}</td>
                                    <td>
                                        <a href="{{url(route('governorate.city.edit',[$city->governorate_id,$city->id]))}}" class="btn btn-success">
                                            <i class="fa fa-edit"></i>تعديل</a>
                                    </td>
                                    </td>
                                    <td>
                                        <form action="{{(route('governorate.city.destroy', [$city->governorate_id,$city->id]))}}" method="post">
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
