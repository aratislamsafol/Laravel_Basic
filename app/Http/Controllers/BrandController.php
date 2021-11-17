<?php

namespace App\Http\Controllers;

use App\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function AllBrand(){
        $brands=Brand::latest()->paginate(2);
        return view('admin.brand.index',compact('brands'));
    }

    public function AddBrand(Request $request){
        $request->validate([
            'brand_name' => 'required|min:4',
            'brand_image' =>'required|mimes:png,jpg,jpeg',
        ],[
            'brand_name.required' => 'Please Input Valid Brand Name',
            'brand_name.min' => 'Brand Longer then 4 characters',
            'brand_image.required'=>'Please Input Brand Image',
        ]
    );
    $brand_image=$request->file('brand_image');
    // $name_gen=hexdec(uniqid());
    // $img_ext=strtolower($brand_image->getClientOriginalExtension());
    // $img_genext=$name_gen.'.'.$img_ext;
    // $img_loc='image/brand/';
    // $img_loc_genext=$img_loc.$img_genext;
    // $brand_image->move($img_loc,$img_genext);

    $name_gen=hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
    Image::make($brand_image)->resize(400,400)->save('image/brand/'.$name_gen);

    $img_loc_genext='image/brand/'.$name_gen;

    Brand::insert([
        'brand_name' => $request->brand_name,
        'brand_image'=> $img_loc_genext,
        'created_at' => Carbon::now(),
    ]);

    return Redirect()->back()->with('Success','brand added');
    }

    public function EditBrand($id){
       $brands= Brand::find($id);
       return view('admin.brand.edit',compact('brands'));
    }

    public Function Update(Request $request,$id){

        $request->validate([
            'brand_name' => 'required|min:4',
            'brand_image' =>'required|mimes:png,jpg,jpeg',
        ],[
            'brand_name.required' => 'Please Input Valid Brand Name',
            'brand_name.min' => 'Brand Longer then 4 characters',
            'brand_image.required'=>'Please Input Brand Image',
        ]
    );


    $brand_image=$request->file('brand_image');
    $old_img=$request->old_img;

    if($brand_image){
        $name_gen=hexdec(uniqid());
        $img_ext=strtolower($brand_image->getClientOriginalExtension());
        $img_genext=$name_gen.'.'.$img_ext;
        $img_loc='image/brand/';
        $img_loc_genext=$img_loc.$img_genext;
        $brand_image->move($img_loc,$img_genext);

        unlink($old_img);

        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' =>$img_loc_genext,
            'updated_at' =>Carbon::now(),
        ]);

    }else{
        Brand::find($id)->update([
            'brand_name'=>$request->brand_name,
            'id'=>Auth::user()->id,
            'updated_at'=>Carbon::now()
        ]);
    }

    return Redirect()->route('all.brand')->with('Success','Updated SuccessFully');

    }

    public function Delete($id){
        $img=Brand::find($id);
        $olds_img=$img->brand_image;
        unlink($olds_img);

        Brand::find($id)->delete();
        return Redirect()->back()->with('Success','Deleted Successfully');
    }
}
