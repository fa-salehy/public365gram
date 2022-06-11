@extends('layouts.panel')
@section('Users')
    active
@endsection
@section('User')
    active
@endsection
@section('title','کاربران')
@section('content')

<div class="container mt-5">
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5"> امورمالی </h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">خانه</a></li>
                <li class="breadcrumb-item active" aria-current="page">صورتحساب</li>
            </ol>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                
                <table id="table" class="table table-bordered table-striped text-center">
                    
                    <thead>
                    <tr>
                        <th>توضیحات</th>
                        <th>مبلغ قابل پرداخت</th>
                        <th>مهلت پرداخت</th>
                        <th>وضعیت پرداخت</th>
                    </tr>
                    </thead>
                    <tbody>
                        {{-- @if (auth()->user()->admin_id == $user->super_admin_id) --}}
                            
                
                        <tr>

                             <td>
                                ودیعه پنل 365  گرام	
                             </td>
                            <td>
                                ‎﷼۲٬۰۰۰٬۰۰۰	
                            </td>
                            <td>
                                {{\Morilog\Jalali\CalendarUtils::strftime('Y/m/d', auth()->user()->created_at)}}
                            </td>
                            @if ($shoudPay)
                            <form method="POST" action="{{ route('payment.store') }}">
                                @csrf
                                <td class="text-center">
                                    {{-- <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="fas fa-sliders-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <button type="button" class="dropdown-item" data-toggle="modal"
                                                data-target="#modal-delete{{$tag->id}}"><i style="color:red"
                                                                                            class="fas fa-user-minus"></i> حذف
                                        </button>
                                    </div> --}}
                                    <input type="hidden" name="amount" value="{{ old('amount', 200000) }}" class="form-control" >
                                    <input  type="hidden" name="description" value="{{ old('description', 'ودیعه پنل 365  گرام') }}" class="form-control">
                                    <div class="pt-4">
                                        <input type="submit" class="form-control btn-danger" value="پرداخت" style="background-color: #fd6074;color:white;">
                                    </div>
                                </td>
                            </form>
                            @else
                            <td>پرداخت شد</td>
                            @endif
                           

                        </tr>
                        <!-- Delete Modal -->
                        {{-- <div class="modal fade" id="modal-delete{{$tag->id}}">
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
                            </div>
                        </div> --}}
                    </tbody>
                </table>
            
                <div class="card-body">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                <div>{{ $error }}</div>
                            </div>
                        @endforeach
                    @endif
{{-- 
                    <form method="POST" action="{{ route('payment.store') }}">
                        @csrf
                        
                        <div>
                            <label>مبلغ:</label>
                            <input name="amount" value="{{ old('amount', 2000) }}" class="form-control">
                        </div>
                        <div>
                            <label>توضیحات:</label>
                            <input name="description" value="{{ old('description', '...') }}" class="form-control">
                        </div>
                        <div class="pt-4">
                            <input type="submit" class="form-control btn-info" value="پرداخت">
                        </div>
                    </form> --}}
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
