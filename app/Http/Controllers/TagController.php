<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use App\Models\UserPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use Illuminate\Support\Facades\DB;
use App\Models\AdminTag;
use InstagramScraper\Instagram;
use Phpfastcache\Helper\Psr16Adapter;

// require __DIR__ . '/../vendor/autoload.php';

class TagController extends Controller
{
    public function index()
    {
      
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
        // $admin_id = Auth::user()->id;
        // $admins = User::Admins()->latest()->get();
        $admin_id = Auth::user()->admin_id;
        $tags = [];
        $admintags = AdminTag::where('super_admin_id','=',$admin_id)->get();
    
        foreach ($admintags as $admintag) {
            $tag = Tag::where('name','=',$admintag->name)->get();
            array_push($tags, $tag);
        }
        // dd($tags);
        $userPage = UserPage::where('super_admin_id','=',$admin_id)->get();

        // dd($userPage);

        // $username = 'fatemeh_dev_salehi';
        // $password = 'Dev@1254';

        // $instagram  = Instagram::withCredentials(
        //     new \GuzzleHttp\Client(),
        //     $username,
        //     $password,
        //     new Psr16Adapter('Files')
        // );

        // $instagram->login();

        // $instagram->saveSession();

        // $username = 'siamak_mahpeima';
        // // $accountId = $instagram->getAccountInfo($username)->getId();

        // // $tags = $instagram->getUserTags($accountId, 20);
        // $tags = $instagram->getMedias($username, 12);
        // $reflection = new \ReflectionClass($tags[8]);
        // $property = $reflection->getProperty('taggedUsers');
        // $property->setAccessible(true);
        // $tagArray = $property->getValue($tags[8]);
        // // $tag = $tagArray[0];
        // // var_dump($tag['username']);
        // if (count($tagArray)!= 0) {
        //     foreach ($tagArray as $tag) {
        //         if ($tag['username'] == 'hami__tag') {
        //             // dd($tag['username']);
        //         }
        //     } 
        // }


        return view('user.tags', compact('tags','userPage','admintags'));
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
            'name' => $request->name,
            'start_date'=> $request->start_date,
            'final_date'=> $request->final_date
        ]); 

        $tag = Tag::where('name', '=', $request->name)->get()->last();
        // dd($tag);
        $tag_id = $tag->id;

        // $page = UserPage::where('main_page', '=', $request->main_page)->get()->first();
        $admin_id = Auth::user()->admin_id;
        $pages = UserPage::where('super_admin_id','=',$admin_id)->get();
        foreach ($pages as $page) {
            $page_id = $page->id;
            $second_page = $page->second_page;
    
            $insertDetails = [
                'tag_id' => $tag_id,
                'user_page_id' => $page_id,
                'status' => '0'
            ];
            DB::table('tag_user_page')->insert($insertDetails);        
        }
        //alert message
        alert()->success('تگ با موفقیت ایجاد شد');
        return back();
    }

    public function update($id,UpdateTagRequest $request)
    {
        $request->validated();
        $tag = Tag::findOrFail($id)->update([
            'name' => $request->name ,
            'start_date'=> $request->start_date,
            'final_date'=> $request->final_date
        ]); 
        
        $tag = Tag::where('name', '=', $request->name)->get()->last();
        $tag_id = $tag->id;

        // $page = UserPage::where('main_page', '=', $request->main_page)->get()->first();
        // $page_id = $page->id;
        
        // $insertDetails = [
        //     'tag_id' => $tag_id,
        //     'user_page_id' => $page_id,
        //     'status' => '0'
        // ];
        
        $pages = UserPage::all();
        foreach ($pages as $page) {
            $page_id = $page->id;
            $second_page = $page->second_page;
    
            $insertDetails = [
                'tag_id' => $tag_id,
                'user_page_id' => $page_id,
                'status' => '0'
            ];
            DB::table('tag_user_page')->where('tag_id', '=', $tag_id)->update($insertDetails); 
        }
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
