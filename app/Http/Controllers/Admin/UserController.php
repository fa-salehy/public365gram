<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            if ((Auth::user()->isAdmin() && Auth::user()->can('User')) || Auth::user()->isSuperAdmin()) {
                return $next($request);
            } else {
                abort(404);
            }
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::Users()->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {

        $request->validated();

        User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'name' => $request->firstName . " " . $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ]);
        alert()->success('کاربر با موفقیت ایجاد شد');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $request->validated();

        if ($request->password != null) {
            $user->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'name' => $request->firstName . " " . $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
            ]);
        } else {
            $user->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'name' => $request->firstName . " " . $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        }


        if ($request->hasFile('image')) {
            $image = $user->image;
            $image = upload_file($request->file('image'), '/profiles', $user->id);
            $user->update([
                'profile' => $image
            ]);
        }
        alert()->success('کاربر با موفقیت ویرایش شد');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        alert()->success('کاربر با موفقیت حذف شد');
        return back();
    }
}
