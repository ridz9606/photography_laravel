<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Catalogue;
use App\Models\Category;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        $gallery_arr = Gallery::all();
         return view('admin.add_gallery',["gallery_arr"=>$gallery_arr]);
    }

    public function store(Request $request)
    {
        $table = new Gallery;
        $table->category_id = $request->category_id;
        $table->catalogue_id = $request->catalogue_id;
        $table->description = $request->description;
       
        
        
        if ($request->hasFile('image')) {

         $file = $request->file('image');
            $filename = time() . "_img." . $file->getClientOriginalExtension();
            $file->move(public_path('upload/gallery/'), $filename);

             $table->image = $filename;
        }
        $table->status = 'active';
       
        $table->save();

        Alert::success('Catalogue Added', 'New catalogue has been added successfully.');
        return redirect('/gallery_management');
    }

    public function show()
    {
         $data = Gallery::all();
        return view('admin.gallery_management', ['gallery_arr'=>$data]);
    }
    
}


