
@extends('layouts.panel')
@section('admins')
    active
@endsection
@section('admins_list')
    active
@endsection
@section('title','مدیران')
@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5"> مدیریت </h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">خانه</a></li>
                <li class="breadcrumb-item active" aria-current="page">مدیرها</li>
            </ol>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <a href="{{route('admins.create')}}" class="btn btn-primary mb-3" >ایجاد مدیر جدید</a>
                    <table id="table" class="table table-bordered table-striped text-center ">
                        <thead>
                        <tr>
                            <th>پروفایل کاربری</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            {{-- <th>نقش</th> --}}
                            <th>کد اشتراک</th>
                            <th>تاریخ ثبت نام</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody >
                     

                        @foreach ($admins as $user)
                        @if ($user->admin_id == auth()->user()->id)
                            
                  
                            <tr>
                                <td>
                                    <img class="rounded-circle" src="{{URL::to('/').$user->profile()}}" alt="" width="50" height="50">
                                </td>

                                <td>
                                    {{$user->firstName}} {{$user->lastName}}
                                </td>
                                <td>{{$user->email}}</td>
                                {{-- <td>
                                    @foreach ($user->role as $r)
                                        {{$r->name}}
                                    @endforeach
                                </td> --}}
                                <td>{{$user->otp}}</td>
                                <td >
                                    <button class="btn btn-default" data-toggle="tooltip" data-placement="top" title="{{$user->created_at}}">
                                        {{\Morilog\Jalali\Jalalian::forge($user->created_at)->format('%A, %d %B %Y')}}
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-sliders-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        <button type="button" class="btn btn-success dropdown-item" data-toggle="modal" data-target="#modal-edit{{$user->id}}" ><i  class="fas fa-user-edit"></i> ویرایش </button>
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-delete{{$user->id}}" ><i style="color:red" class="fas fa-user-minus"></i> حذف </button>
                                    </div>
                                </td>

                            </tr>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="modal-delete{{$user->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">حذف مدیر</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>آیا در حذف مدیر  `{{$user->name}}` مطمین هستید؟ </h5>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <form action="{{route('admins.destroy',$user->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">حذف</button>

                                            </form>

                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            <!-- /.modal -->
                            <!-- Change Modal -->
                            <div class="modal fade" id="modal-edit{{$user->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ویرایش مدیر</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- form start -->
                                            <form  method="POST" action="{{route('admins.update',$user->id)}}"  enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <div class="card-body">
                                                    <div class="form-group text-right">
                                                        <label for="exampleInputEmail1">نام</label>
                                                        <input type="text" class="form-control @error('firstName') is-invalid @enderror" value="{{$user->firstName}}" name="firstName" placeholder="نام مدیر را وارد نمایید" required>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <label>نام خانوادگی</label>
                                                        <input name="lastName" class="form-control @error('lastName') is-invalid @enderror" placeholder="نام خانوادگی خود را وارد کنید" type="text" value="{{$user->lastName}}" required>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <label>گروه حمایتی</label>
                                                        <input name="page" class="form-control @error('page') is-invalid @enderror" placeholder="نام گروه حمایتی خود را وارد کنید" type="text" value="{{$user->page}}" required>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <label>شماره موبایل واتس اپ</label>
                                                        <input name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="شماره واتس اپ خود را وارد کنید" type="number"  value="{{$user->phone}}" required>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <label for="exampleInputEmail1">ایمیل</label>
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{$user->email}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ایمیل" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">رمز عبور جدید</label>
                                                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">تکرار رمز عبور</label>
                                                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Password" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputFile">تصویر پروفایل</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" name="img" class="custom-file-input" id="exampleInputFile">
                                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->

                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">ویرایش</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            @endif
                        @endforeach

                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
