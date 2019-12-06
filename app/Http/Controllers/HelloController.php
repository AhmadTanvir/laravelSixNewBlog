<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HelloController extends Controller
{

	public function index(){
		$post = DB:: table('posts')-> join('categories', 'posts.category_id', 'categories.id')
				->select('posts.*', 'categories.name','categories.slug')
				->paginate(3);
		return view('pages.index', compact('post'));
	}

	public function showpost($id)
    {
        $post = DB::table('posts')
                ->join('categories', 'posts.category_id', 'categories.id')
                ->select('posts.*', 'categories.name')
                ->where('posts.id', $id)
                ->first();
        return view('pages.viewpost', compact('post'));
        // return response()->json($post);
    }

    public function contact(){
    	return view('pages.contact');
    }
    public function about(){
    	return view('pages.about');
    }
}
