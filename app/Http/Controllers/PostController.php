<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PostController extends Controller
{
    public function writePost(){
        $category=DB::table('categories')->orderBy('id', 'desc')->get();
        return view('post.writepost', compact('category'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:125',
            'details' => 'required|max:400',
            'image' => 'required|mimes:jpeg,jpg,png|max:1000',
        ]);

        $data = array();
        $data['title'] = $request->title;
        $data['category_id'] = $request->category_id;
        $data['details'] = $request->details;
        $image = $request->file('image');
        if ($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path= 'frontend/image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            DB::table('posts')->insert($data);
            $notification=array(
                'message'=>'Successfully Post Inserted',
                'alert-type'=>'success',
            );
            return redirect()->back()->with($notification);
        }else{
            DB::table('posts')->insert($data);
            $notification=array(
                'message'=>'Successfully Post Inserted',
                'alert-type'=>'success',
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $post = DB::table('posts')
                ->join('categories','posts.category_id','categories.id')
                ->select('posts.*', 'categories.name')
                ->orderBy('id', 'desc')
                ->get();
        return view('post.allpost', compact('post'));
                // return response()->json($post);
    }

    public function postshow($id)
    {
        $post = DB::table('posts')
                ->join('categories', 'posts.category_id', 'categories.id')
                ->select('posts.*', 'categories.name')
                ->where('posts.id', $id)
                ->first();
        return view('post.viewpost', compact('post'));
        // return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = DB::table('categories')->get();
        $post = DB::table('posts')->where('id', $id)->first();
        return view('post.editpost', compact('category', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'title' => 'required|max:125',
            'details' => 'required|max:400',
            'image' => 'mimes:jpeg,jpg,png|max:1000',
        ]);

        $data = array();
        $data['title'] = $request->title;
        $data['category_id'] = $request->category_id;
        $data['details'] = $request->details;
        $image = $request->file('image');
        if ($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path= 'frontend/image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            unlink($request->old_photo);
            DB::table('posts')->where('id', $id)->update($data);
            $notification=array(
                'message'=>'Successfully Post Updated',
                'alert-type'=>'success',
            );
            return redirect()->route('all.post')->with($notification);
        }else{
            $data['image'] = $request->old_photo;
            DB::table('posts')->where('id', $id)->update($data);
            $notification=array(
                'message'=>'Successfully Post Updated with old_photo',
                'alert-type'=>'success',
            );
            return redirect()->route('all.post')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        $image =  $post->image;
        // return response()->json($image);
        $delete = DB::table('posts')->where('id', $id)->delete();
        if ($delete) {
            unlink($image);
            $notification = array(
                'message' => 'Post Successfully Deleted !!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Something Went Wrong!!',
                'alert-type' => 'error',
            );
        }
    }
}
