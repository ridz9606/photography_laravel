@extends('admin.layout.structure')
@section('content')
<main class="col-md-10 ms-sm-auto px-4">
  <h1 class="h3 mt-3">Edit Gallery</h1>



<form method="post" action="{{ url('edit_gallery/'. $data->id) }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="id" value="<?php echo $data->id; ?>">

    
    

    

    <div class="mb-3">
        <label>Current Image</label><br>
       <img src="{{ url('upload/gallery/' . $data->image) }}"
                 width="120" class="mb-2 rounded">
    </div>

    <div class="mb-3">
        <label>Change Image (optional)</label>
        <input type="file" name="image" class="form-control">
    </div>

    
    <button type="submit" name="update" class="btn btn-success">
        Update Gallery
    </button>

</form>
</main>

@endsection
