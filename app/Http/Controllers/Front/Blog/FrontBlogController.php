<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use Illuminate\Http\Request;

class FrontBlogController extends Controller
{
    public function index(Request $request){
        $data = Blogs::where('status','active')->orderBy('id','desc')->paginate(3);
        return view('Front.blogs',compact('data'));
    }

    public function BlogDetails($slug){
        $data = Blogs::where('status','active')->where('slug',$slug)->first();
        $metadata = Blogs::where('status','active')->select('meta_title','meta_description','meta_keywords as meta_keyword')->where('slug',$slug)->first();
        
        if(empty($data)){
            return redirect('/')->with('error','Sorry, No data found.');
        }
        
        $data->related_blogs = Blogs::where('status','active')->where('id','!=',$data->id)->orderBy('id','desc')->limit(3)->get();
        
        return view('Front.blog-detail',compact('data','metadata'));
    }
}
