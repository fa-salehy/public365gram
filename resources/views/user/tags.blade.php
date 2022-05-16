@extends('layouts.panel')
@section('Users')
    active
@endsection
@section('User')
    active
@endsection
@section('title','کاربران')
@section('content')

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5"> تگ ها </h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">خانه</a></li>
                <li class="breadcrumb-item active" aria-current="page">تگ ها</li>
            </ol>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-create">ساخت تگ
                    </button>
                    <!-- Create Modal -->
                    <div class="modal fade" id="modal-create">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">ساخت تگ جدید</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- form start -->
                                    <form method="POST" action="{{route('tags.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">اسم تگ</label>
                                                <input name="name" type="text" class="form-control"
                                                       id="exampleInputEmail1" placeholder="نام تگ"
                                                       oninvalid="this.setCustomValidity('نام تگ را وارد کنید')"
                                                       oninput="this.setCustomValidity('')"
                                                       value="{{old('name')}}"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">پیج اصلی</label>
                                                {{-- <input name="main_page" type="text" class="form-control"
                                                       id="exampleInputEmail1" placeholder="نام پیج اصلی"
                                                       oninvalid="this.setCustomValidity('نام پیج اصلی را وارد کنید')"
                                                       oninput="this.setCustomValidity('')" value="{{old('main_page')}}"
                                                       required> --}}
                                                       <select class="form-control" name="main_page" required>
                                                        @foreach($userPage as $item)
                                                            <option value="{{ $item->main_page }}">{{ $item->main_page }}</option>
                                                        @endforeach
                                                      </select>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label for="exampleInputEmail1">پیج لایک کننده</label>
                                                <input name="second_page" type="text" class="form-control"
                                                       id="exampleInputEmail1" placeholder="پیج لایک کننده"
                                                       oninvalid="this.setCustomValidity('نام پیج لایک کننده را وارد کنید')"
                                                       oninput="this.setCustomValidity('')" value="{{old('second_page')}}"
                                                       required>
                                            </div> --}}
                                            {{-- <div class="form-group">
                                                <label for="exampleInputEmail1">شماره موبایل</label>
                                                <input name="phone" type="number" class="form-control"
                                                       id="exampleInputEmail1" placeholder="شماره موبایل"
                                                       oninvalid="this.setCustomValidity('شماره موبایل را وارد کنید')"
                                                       oninput="this.setCustomValidity('')" value="{{old('phone')}}"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">مدت اعتبار</label>
                                                <input name="expired_at" type="date" class="form-control"
                                                        placeholder="مدت اعتبار"
                                                       oninvalid="this.setCustomValidity('مدت اعتبار را وارد کنید')"
                                                       value="{{old('expired_at')}}"
                                                        min="2022-05-09"
                                                       required>
                                            </div> --}}
                                            {{-- <input type="hidden" name="admin_id" value="{{auth()->user()->id}}">
                                            <input type="hidden" name="super_admin_id" value="{{auth()->user()->admin_id}}"> --}}
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">ایجاد</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                    <table id="table" class="table table-bordered table-striped text-center">
                        <thead>
                        <tr>
                            {{--<th>تصویر کاربر</th>--}}
                            <th>ردیف</th>
                            <th>تگ</th>
                            <th>پیج اصلی</th>
                            <th>پیج لایک کننده</th>
                            <th>وضعیت</th>
                            <th>نمایش</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $tag)
                            {{-- @if (auth()->user()->admin_id == $user->super_admin_id) --}}
                                
                    
                            <tr>
                                {{-- <td>
                                     <img class="rounded-circle" src="{{URL::to('/').$user->profile()}}" alt=""
                                          width="50" height="50">
                                 </td>--}}
                                 <td>{{$tag->id}}</td>
                                <td>
                                    {{$tag->name}}
                                </td>
                                <td>
                                    {{$tag->main_page}}
                                </td>
                                <td>
                                    {{$tag->second_page}}
                                </td>
                                {{-- <td>{{App\Models\User::getUserNameByID($user->admin_id)}}</td> --}}
                                <td>
                                    @if ($tag->status == '0')
                                        بررسی نشده
                                    @endif
                                   
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fas fa-sliders-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        <button type="button" class="btn btn-success dropdown-item" data-toggle="modal"
                                                data-target="#modal-edit{{$tag->id}}"><i class="fas fa-user-edit"></i>ویرایش
                                        </button>
                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                                data-target="#modal-delete{{$tag->id}}"><i style="color:red"
                                                                                            class="fas fa-user-minus"></i>حذف
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="modal-delete{{$tag->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">حذف تگ</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>آیا در حذف تگ `{{$tag->name}}` مطمین هستید؟ </h5>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن
                                            </button>
                                            <form action="{{route('tags.destroy',$tag->id)}}" method="POST">
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
                            <div class="modal fade" id="modal-edit{{$tag->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ویرایش تگ</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- form start -->
                                            <form method="POST" action="{{route('tags.update',$tag->id)}}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">اسم تگ</label>
                                                        <input name="name" type="text" class="form-control"
                                                               id="exampleInputEmail1" placeholder="نام تگ"
                                                               oninvalid="this.setCustomValidity('نام تگ را وارد کنید')"
                                                               oninput="this.setCustomValidity('')"
                                                               value="{{$tag->name}}"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">پیج اصلی</label>
                                                        {{-- <input name="main_page" type="text" class="form-control"
                                                               id="exampleInputEmail1" placeholder="نام پیج اصلی"
                                                               oninvalid="this.setCustomValidity('نام پیج اصلی را وارد کنید')"
                                                               oninput="this.setCustomValidity('')"
                                                               value="{{$tag->main_page}}"
                                                               required> --}}
                                                               <select class="form-control" name="main_page"  value="{{$tag->main_page}}" required >
                                                                @foreach($userPage as $item)
                                                                @if ($item->main_page == $tag->main_page )
                                                                    <option value="{{$tag->main_page}}" selected>{{$tag->main_page}}</option>
                                                                @else
                                                                <option value="{{ $item->main_page }}">{{ $item->main_page }}</option>
                                                                @endif
                                                                @endforeach
                                                              </select>
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="exampleInputEmail1">پیج لایک کننده</label>
                                                        <input name="second_page" type="text" class="form-control"
                                                               id="exampleInputEmail1" placeholder="پیج لایک کننده"
                                                               oninvalid="this.setCustomValidity('نام پیج لایک کننده را وارد کنید')"
                                                               oninput="this.setCustomValidity('')"
                                                               value="{{$tag->second_page}}"
                                                               required>
                                                    </div>
                                                --}}
                                                    {{-- <div class="form-group">
                                                        <label for="exampleInputEmail1">وضعیت</label>
                                                        <input name="expired_at" type="date" class="form-control"
                                                                placeholder="وضعیت"
                                                               oninvalid="this.setCustomValidity('مدت اعتبار را وارد کنید')"
                                                               value="2022-05-09"
                                                                min="2022-05-09"
                                                               required>
                                                    </div> --}}
                                                    {{-- <input type="hidden" name="admin_id" value="{{auth()->user()->id}}"> --}}
                                                    <!-- /.card-body -->

                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">ویرایش</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->

                            {{-- @endif --}}
                        @endforeach

                    </table>

                </div>
            </div>
        </div>
    </div>



@endsection
