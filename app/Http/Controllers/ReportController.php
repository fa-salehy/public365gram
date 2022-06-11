<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\UserPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use InstagramScraper\Instagram;
use Phpfastcache\Helper\Psr16Adapter;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cookie;

class ReportController extends Controller
{

    protected $userSession;

    // public static $instagram;
    public function index()
    {
        $tags = Tag::all();
        $userPageArray = [];
        $admin_id = Auth::user()->admin_id;
        $data = DB::table('tag_user_page')
        ->join('tags','tag_user_page.tag_id','=','tags.id')
        ->join('user_pages','tag_user_page.user_page_id','=','user_pages.id')
        ->where('super_admin_id','=',$admin_id)
        ->get(['tags.id','tags.name','tags.start_date','tags.final_date','tags.created_at','user_pages.main_page','user_pages.second_page','tag_user_page.status']);
        $admin_id = Auth::user()->admin_id;
        $userPage = UserPage::where('super_admin_id','=',$admin_id)->get();


        return view('user.reports', compact('tags','userPage','data'));
    }
    public static function check_tag($tag){
        print('omadam check konm');
        $username = 'fatemedev1';
        $password = 'Dev@1254';


        $instagram  = Instagram::withCredentials(
            new \GuzzleHttp\Client(),
            $username,
            $password,
            new Psr16Adapter('Files')
        );

        $instagram->login();
        $instagram->saveSession();
        print('login kardam');
        // $tag_id = Tag::where('name','=',$tag)->get();
        $pages = DB::table('tag_user_page')->where('status', '=', '0')->get();   
        foreach ($pages as $page) {

            $username = UserPage::find($page->user_page_id)->main_page;
            $tags = $instagram->getMedias($username, 1);
            $reflection = new \ReflectionClass($tags[0]);
            $property = $reflection->getProperty('taggedUsers');
            $property->setAccessible(true);
            $tagArray = $property->getValue($tags[0]);
            // $tag = $tagArray[0];
            // var_dump($tag['username']);
            // print_r($tag->name);

            if (sizeof($tagArray)!= 0) {
                print($username.sizeof($tagArray));
                print('\n');
                $checkTag = false;
                foreach ($tagArray as $taguser) {
                    if ($taguser['username'] == strtolower($tag->name)) {
                        // print_r($taguser['username']); 
                        DB::table('tag_user_page')->where('user_page_id', '=', $page->user_page_id)->update(['status'=>'1']); 
                         print('post darad');
                        $checkTag = true;
                        break;
                    }
                } 
                if(!$checkTag){ 
                    DB::table('tag_user_page')->where('user_page_id', '=', $page->user_page_id)->update(['status'=>'2']);
                    print('tag eshtebah');
                 }
                        
            }else{
                DB::table('tag_user_page')->where('user_page_id', '=', $page->user_page_id)->update(['status'=>'2']); 
                 print('tag nadarad');
            }
            
        }
       
    }
    public function login(Request $request){
        $username = 'fatemedev1';
        $password = 'Dev@1254';
        $instagram = Instagram::withCredentials(
            new \GuzzleHttp\Client(),
            $username,
            $password,
            new Psr16Adapter('Files')
        );
        $instagram->login();
        $instagram->saveSession(); 

        // session()->put('instagram',$instagram);
        // $redis = Redis::connection();
        // $redis->set('instagram', json_encode($instagram));

        return redirect(route('report.index'));
    }

    public function check($id){
        $username = 'fatemedev1';
        $password = 'Dev@1254';


        $instagram  = Instagram::withCredentials(
            new \GuzzleHttp\Client(),
            $username,
            $password,
            new Psr16Adapter('Files')
        );
        $instagram->login();
        $instagram->saveSession(); 
        // $instagram = session()->get('instagram');
        $admin_id = Auth::user()->admin_id;
        $tag = Tag::find($id);
         $pages = DB::table('tag_user_page')
        ->join('user_pages','tag_user_page.user_page_id','=','user_pages.id')
        ->where('super_admin_id','=',$admin_id)->where('status', '=', '0')
        ->where('tag_id','=',$tag->id)
        ->get(['user_pages.main_page','tag_user_page.user_page_id','tag_user_page.tag_id']);
        foreach ($pages as $page) {
            $username = $page->main_page;
            $tags = $instagram->getMedias($username, 1);
            if(sizeof($tags)!= 0){
            $reflection = new \ReflectionClass($tags[0]);
            $property = $reflection->getProperty('taggedUsers');
            $property->setAccessible(true);
            $tagArray = $property->getValue($tags[0]);
            if (sizeof($tagArray)!= 0) {
                $checkTag = false;
                foreach ($tagArray as $taguser) {
                    if ($taguser['username'] == strtolower($tag->name)) {
               
                        DB::table('tag_user_page')->where('user_page_id', '=', $page->user_page_id)->update(['status'=>'1']); 
                        $checkTag = true;
                        break;
                    }
                } 
                if(!$checkTag){ 
                    DB::table('tag_user_page')->where('user_page_id', '=', $page->user_page_id)->update(['status'=>'2']);
                 }
                        
            }else{
                DB::table('tag_user_page')->where('user_page_id', '=', $page->user_page_id)->update(['status'=>'2']);
            }
            
            
        }
    }

        return redirect(route('report.index'));
    }


    public function adminIndex(){
        $tags = Tag::all();
        $userPageArray = [];
        $admin_id = Auth::user()->id;
        $data = DB::table('tag_user_page')
        ->join('tags','tag_user_page.tag_id','=','tags.id')
        ->join('user_pages','tag_user_page.user_page_id','=','user_pages.id')
        ->where('super_admin_id','=',$admin_id)
        ->get(['tags.id','tags.name','tags.start_date','tags.final_date','tags.created_at','user_pages.main_page','user_pages.second_page','tag_user_page.status']);
        $admin_id = Auth::user()->id;
        $userPage = UserPage::where('super_admin_id','=',$admin_id)->get();


        return view('user.reports', compact('tags','userPage','data'));
    }
}
