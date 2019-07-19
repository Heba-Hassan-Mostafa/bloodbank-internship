@extends('layouts.app')
@inject('perm','App\Permission')
@section('page_title')
 اضافة رتبة
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
                <form action="{{url(route('role.store'))}}"  method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input class="form-control" type="text" name="name" >
                    </div>
                    <div class="form-group">
                        <label for="display_name">الاسم المعروض </label>
                        <input class="form-control" type="text" name="display_name">
                    </div>
                    <div class="form-group">
                        <label for="description">الوصف</label>
                        <input class="form-control" type="text" name="description" >
                    </div>
                    <div class="form-group">
                        <label for="permission">الصلاحيات</label>
                        <br>
                        <input id="select-all" type="checkbox"><label for='select-all'>اختيار الكل</label>

                       <div class="row">
                           @foreach($perm->all() as $permission)
                               <div class="col-sm-3">

                               <div class="form-check">
            <input class="form-check-input" type="checkbox" name="permission_list[]" value="{{$permission->id}}">
           <label class="form-check-label" for="defaultCheck1">
                     {{$permission->display_name}}
                                   </label>
                               </div>
                               </div>
                               @endforeach

                       </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">اضافة</button>
                    </div>
                    @push('scripts')
                        <script>

                     $("#select-all").click(function(){
                        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

                            });

                        </script>




                    @endpush

                </form>
            @include('partial.validation-errors')

            <!-- /.card-body -->

            </div>
            <!-- End card -->
        </div>
    </section>
    <!-- End Section -->
@endsection
