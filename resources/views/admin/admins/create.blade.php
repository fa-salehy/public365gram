
@extends('layouts.panel')
@section('admins')
    active
@endsection
@section('new_admin')
    active
@endsection
@section('title')
    ساخت مدیر جدید
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">مدیر جدید</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6 jumbotron  ">
                        <form action="{{route('admins.store')}}" method="POST">
                            @csrf
                            <div class="form-group text-right">
                                <label for="exampleInputEmail1">نام</label>
                                <input type="text" class="form-control @error('firstName') is-invalid @enderror" value="{{old('firstName')}}" name="firstName" placeholder="نام مدیر را وارد نمایید" required>
                            </div>
                            <div class="form-group text-right">
                                <label>نام خانوادگی</label>
                                <input name="lastName" class="form-control @error('lastName') is-invalid @enderror" placeholder="نام خانوادگی خود را وارد کنید" type="text" value="{{old('lastName')}}" required>
                            </div>
                            <div class="form-group text-right">
                                <label>گروه حمایتی</label>
                                <input name="page" class="form-control @error('page') is-invalid @enderror" placeholder="نام گروه حمایتی خود را وارد کنید" type="text" value="{{old('page')}}"required>
                            </div>
                            <div class="form-group text-right">
                                <label>شماره موبایل واتس اپ</label>
                                <input name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="شماره واتس اپ خود را وارد کنید" type="number"  value="{{old('phone')}}" required>
                            </div>
                            <div class="form-group text-right">
                                <label for="exampleInputEmail1">ایمیل</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ایمیل" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">رمز عبور</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  id="exampleInputPassword1" placeholder="رمز عبور" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">تکرار رمز عبور</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"  id="exampleInputPassword1" placeholder="تکرار رمز عبور" required>
                            </div>
                            <input type="number" value="{{auth()->user()->id}}" hidden name="admin_id">
                            {{-- <div class="form-group">
                                <label for="exampleFormControlSelect1">انتخاب نقش</label>
                                <select class="form-control" name="role" id="exampleFormControlSelect1">
                                    <option value="0"  selected disabled>انتخاب نقش</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <button type="submit" class="btn btn-primary">ایجاد</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
