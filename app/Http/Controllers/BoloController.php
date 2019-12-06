<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class BoloController extends Controller
{
    public function AddCategory(){
    	return view('post.add_category');
    }
    public function StoreCategory(Request $request){

    	$validatedData = $request->validate([
    		'name' => 'required|unique:categories|max:25|min:4',
    		'slug' => 'required|unique:categories|max:25|min:4',
    	]);

    	$data =  array();
    	$data['name'] = $request->name;
    	$data['slug'] = $request->slug;
    	$category = DB::table('categories')->insert($data);
    	// return response()->json($data);
    	if ($category) {
    		$notification=array(
    			'message' => 'Category Successfully Inserted!',
    			'alert-type' => 'success'
    		);
    		return redirect()->route('all.category')->with($notification);
    	}else{
    		$notification=array(
    			'message' => 'Something went wrong!!!',
    			'alert-type' => 'error'
    		);
    		return redirect()->back()->with($notification);
    	}
    }

    public function AllCategory(){

    	$category = DB::table('categories')->get();//to get one data use first() method

    	return view('post.all_category', compact('category'));

    	// return response()->json($category);
    }

    public function ViewCategory($id){

    	$cat = DB::table('categories')->where('id', $id)->first();
    	return view('post.viewcategory')->with('category', $cat);

    	// return response()->json($cat);
    }

    public function DeleteCategory($id){

    	$delete = DB::table('categories')->where('id', $id)->delete();
    	if ($delete) {
    		$notification=array(
    			'message' => 'Category Successfully Deleted!!',
    			'alert-type' => 'success'
    		);
    		return redirect()->back()->with($notification);
    	}
    }

    public function EditCategory($id){
    	$category = DB::table('categories')->where('id', $id)->first();
    	return view('post.editcategory', compact('category'));
    }

    public function UpdateCategory(Request $request,$id){

    	$validatedData = $request->validate([
    		'name' => 'required|max:25|min:4',
    		'slug' => 'required|max:25|min:4',
    	]);

    	$data =  array();
    	$data['name'] = $request->name;
    	$data['slug'] = $request->slug;
    	$category = DB::table('categories')->where('id', $id)->update($data);
    	// return response()->json($data);
    	if ($category) {
    		$notification=array(
    			'message' => 'Category Successfully Updated!',
    			'alert-type' => 'success'
    		);
    		return redirect()->route('all.category')->with($notification);
    	}else{
    		$notification=array(
    			'message' => 'Nothing To Update!!',
    			'alert-type' => 'info'
    		);
    		return redirect()->route('all.category')->with($notification);
    	}

    }
}
