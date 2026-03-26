@extends('editor.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Edited Gallery</h1>
    <a href="#" class="btn btn-primary rounded-pill px-4">Upload Edits</a>
</div>

<div class="row g-4">
    @forelse($gallery_arr ?? [] as $gallery)
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                <img src="{{ url('upload/gallery/'.$gallery->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body p-3">
                    <h6 class="mb-1 text-dark truncate">{{ $gallery->catalogue->catalogue_name ?? 'Client Work' }}</h6>
                    <small class="text-muted d-block mb-3">Status: {{ $gallery->status }}</small>
                    <div class="btn-group w-100">
                        <button class="btn btn-sm btn-outline-danger">Remove</button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5 text-muted">
            <i class="fa fa-magic fa-3x mb-3"></i>
            <p>No edited photos uploaded yet.</p>
        </div>
    @endforelse
</div>
@endsection