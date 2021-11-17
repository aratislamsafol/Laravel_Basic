<?php

namespace App\Http\Controllers;

use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function AllCat(){
        $category=Category::latest()->paginate(2);
        $trashcat=Category::onlyTrashed()->latest()->paginate(2);
        return view('admin.category.index',compact('category','trashcat'));
    }
    public function AddCat(Request $request){
        $request->validate([
            'category_name' => 'required|max:255',
        ],
        [
            'category_name.required' => 'Please Input Category Name',
        ]
    );

        Category::insert([
            'category_name'=>$request->category_name,
            'user_id'=>Auth::user()->id,
            'created_at'=>Carbon::now()
        ]
    );

    return Redirect()->back()->with('Success','Category Inserted');
    }

    public function Edit($id){
        $category=Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function Update(Request $request,$id){
        $category_update=Category::find($id)->Update([
            'category_name'=>$request->category_name,
            'user_id'=>Auth::user()->id,
            'updated_at'=>Carbon::now()

        ]);

        return Redirect()->route('all.category')->with('Success','Updated Category');
    }

    public function softdelete($id){
        $category=Category::find($id)->delete();

        return Redirect()->back()->with('Success','Save to Trash List');
    }

    public function RestoreData($id){
        $delete=Category::withTrashed()->find($id)->restore();

        return Redirect()->back()->with('Success','Category Restored');
    }

    public function PDelete($id){
        $p_del=Category::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with('Success','Category Permanently Deleted');
    }
}
