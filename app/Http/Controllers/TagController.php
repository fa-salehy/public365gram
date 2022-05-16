<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\UserPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use Illuminate\Support\Facades\DB;
class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $userPageArray = [];
        $admin_id = Auth::user()->admin_id;
        // $userPage = UserPage::where('super_admin_id','=',$admin_id)->get();
        // foreach($tags as $tag){
        //     $userPages = $tag->user_pages()->get();
        //     if(sizeof($userPages)!= 0){
        //         foreach($userPages as $userPage){
        //             if($userPage->super_admin_id ==  $admin_id){
        //                 array_push($userPageArray,$userPage); 
        //             }
        //         }
                 
        //     }
        // }
        // dd($userPageArray);
        $data = DB::table('tag_user_page')
        ->join('tags','tag_user_page.tag_id','=','tags.id')
        ->join('user_pages','tag_user_page.user_page_id','=','user_pages.id')
        ->where('super_admin_id','=',$admin_id)
        ->get(['tags.id','tags.name','user_pages.main_page','user_pages.second_page','tag_user_page.status']);
        // $admin_id = Auth::user()->id;
        // $admins = User::Admins()->latest()->get();
        $admin_id = Auth::user()->admin_id;
        $userPage = UserPage::where('super_admin_id','=',$admin_id)->get();
        // dd($userPage);
        return view('user.tags', compact('tags','userPage','data'));
    }
        /**
     * Store a newly created resource in storage.
     *
     * @param StoreTagRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTagRequest $request)
    {

        $request->validated();
        $tag = Tag::create([
            'name' => $request->name 
        ]); 

        $tag = Tag::where('name', '=', $request->name)->get()->last();
        // dd($tag);
        $tag_id = $tag->id;

        $page = UserPage::where('main_page', '=', $request->main_page)->get()->first();
        $page_id = $page->id;

        $insertDetails = [
            'tag_id' => $tag_id,
            'user_page_id' => $page_id,
            'status' => '0'
        ];
        
        DB::table('tag_user_page')->insert($insertDetails);

        //alert message
        alert()->success('تگ با موفقیت ایجاد شد');
        return back();
    }

    public function update($id,UpdateTagRequest $request)
    {
        $request->validated();
        $tag = Tag::findOrFail($id)->update([
            'name' => $request->name 
        ]); 
        $tag = Tag::where('name', '=', $request->name)->get()->last();
        $tag_id = $tag->id;

        $page = UserPage::where('main_page', '=', $request->main_page)->get()->first();
        $page_id = $page->id;
        
        $insertDetails = [
            'tag_id' => $tag_id,
            'user_page_id' => $page_id,
            'status' => '0'
        ];
        
        DB::table('tag_user_page')->where('tag_id', '=', $tag_id)->update($insertDetails);

        alert()->success('تغییرات با موفقیت اعمال شد');
        return back();
    }

    public function destroy($id)
    {
        Tag::findOrfail($id)->delete();
        DB::table('tag_user_page')->where('tag_id', '=', $id)->delete();
         //alert message
         alert()->success('تگ با موفقیت حذف شد');
        return back();
    }



}
