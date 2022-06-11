<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminTag;
use App\Http\Requests\AdminTag\StoreAdminTagRequest;
use App\Http\Requests\AdminTag\UpdateAdminTagRequest;
use Illuminate\Support\Facades\Auth;
class AdminTagController extends Controller
{
    public function index(){
        // $tags = AdminTag::all();
        $admin_id = Auth::user()->id;
        $tags = AdminTag::where('super_admin_id','=',$admin_id)->get();
        return view('admin.create_tag', compact('tags'));
    }
    public function store(StoreAdminTagRequest $request)
    {
        AdminTag::create($request->validated());
        //alert message
        alert()->success('تگ با موفقیت ایجاد شد');
        return back();
    }
    public function destroy($id)
    {
        AdminTag::findOrfail($id)->delete();
         //alert message
         alert()->success('تگ با موفقیت حذف شد');
        return back();
    }

}
