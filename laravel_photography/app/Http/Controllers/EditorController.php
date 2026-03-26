<?php

namespace App\Http\Controllers;

use App\Models\Editor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class EditorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add_editor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Editor;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->password = Hash::make($request->password);
        $data->save();

        Alert::success('Editor Added Successfully', 'Success');
        return redirect('editor_management');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data = Editor::all();
        return view('admin.editor_management', ['editor_arr' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Editor::find($id);
        return view('admin.edit_editor', ['fetch' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Editor::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        if($request->password) {
            $data->password = Hash::make($request->password);
        }
        $data->save();

        Alert::success('Editor Updated Successfully', 'Success');
        return redirect('editor_management');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Editor::find($id);
        $data->delete();

        Alert::success('Editor Deleted Successfully', 'Success');
        return redirect('editor_management');
    }
}