<?php

namespace App\Http\Controllers;

use App\MultiImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class MultiImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Index(){
        $multi=MultiImage::latest()->paginate(6);
        return view('admin.multiimage.index',compact('multi'));
    }

    public function AddMulti(Request $request){

        $multiimage=$request->file('multi_image');

        foreach($multiimage as $multi){
            $name_gen=hexdec(uniqid()).'.'.$multi->getClientOriginalExtension();
            Image::make($multi)->resize(400,400)->save('image/multiimage/'.$name_gen);

            $img_loc_genext='image/multiimage/'.$name_gen;

            MultiImage::insert([
                'multiimage'=> $img_loc_genext,
                'created_at' => Carbon::now(),
            ]);
        }

            return Redirect()->back()->with('Success','Image added');
    }

    public function Delete($id){
        $img=MultiImage::find($id);
        $olds_img=$img->multiimage;
        unlink($olds_img);

        $multi_del=MultiImage::find($id)->delete();

        return Redirect()->back()->with('Success','Image Delete');

    }

}
