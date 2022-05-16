<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserPage\StoreUserPageRequest;
use App\Http\Requests\UserPage\UpdateUserPageRequest;
use Illuminate\Http\Request;
use App\Models\UserPage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{
    // public function __construct()
    // {

    //     $this->middleware(function ($request, $next) {
    //         if ((Auth::user()->isAdmin()) {
    //             return $next($request);
    //         } else {
    //             abort(404);
    //         }
    //     });

    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = UserPage::all();
        $admin_id = Auth::user()->id;
        $admins = User::Admins()->latest()->get();
        return view('user.index', compact('users','admin_id','admins'));
    }


        /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserPageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserPageRequest $request)
    {
        // dd($request->validated());
        $user = UserPage::create($request->validated());
        alert()->success('کاربر با موفقیت ایجاد شد');
        return redirect()->route('userpages.index');
    }

     /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserPageRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserPageRequest $request , $id)
    {
        // dd($user);
        $request->validated();
        UserPage::where('id','=',$id)->update([
            'main_page' => $request->main_page,
            'second_page'=>  $request->second_page,
            'expired_at' =>  $request->expired_at

        ]);
        alert()->success('مدیر با موفقیت ویرایش شد');
        return back();
    }

    public function destroy($id)
    {
        UserPage::findOrfail($id)->delete();
        alert()->success('کاربر با موفقیت حذف شد');
        return back();
    }
}
