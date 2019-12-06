<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function Categories(){
    	return view('category.add_category');
    }
    public function AddCategories(){
    	return view('category.add_category');
    }
    public function StoreCategories(Request $request){

    	$data =  array();
    	$data['catname'] = $request->catname;
    	$data['slug'] = $request->slug;
    	$category = DB::table('catagories')->insert($data);
    	if ($category) {
    		$notification=array(
    			'message' => 'Category Successfully Inserted',
    			'alert-type' => 'success'
    		);
    		return redirect()->route('all.catagory')->with($notification);
    	}else{
    		$notification=array(
    			'message' => 'Something went wrong!!',
    			'alert-type' => 'error'
    		);
    		return redirect()->back()->with($notification);
    	}

    }
    public function AllCategories(){

    	$category = DB::table('catagories')->get();
    	return view('category.all_catagory', compact('category'));

    }

    public function ViewCategories($id){

    	$cat  = DB::table('catagories')->where('id', $id)->first();
    	return view('category/catagoryview', compact('cat'));
    	// return response()->json($cat);

    }

    public function EditCategories(Request $request, $id){

    	$catagory = DB::table('catagories')->where('id', $id)->first();
    	return view('category.editcategory', compact('catagory'));

    	// return response()->json($catagory);

    }

    public function UpdateCategories(Request $request,$id){

    	$data = array();
    	$data['catname'] = $request->catname;
    	$data['slug'] = $request->slug;
    	$catagory = DB::table('catagories')->where('id', $id)->update($data);
    	if ($catagory) {
    		$notification=array(
    			'message' => 'Catagory Updated Successfully',
    			'alert-type' => 'success'
    		);
    		return redirect()->route('all.catagory')->with($notification);
    	}else{
    		$notification = array(
    			'message' => 'Nothing To Update!!',
    			'alert-type' => 'info'
    		);
    		return redirect()->route('all.catagory')->with($notification);
    	}

    }

    public function deleteCategories($id){

    	$delete = DB::table('catagories')->where('id', $id)->delete();
    	if ($delete) {
    		$notification=array(
    			'message' => 'Category Deleted Successfully!!',
    			'alert-type' => 'success'	
    		);
    		return redirect()->route('all.catagory')->with($notification);
    	}

    }
}
