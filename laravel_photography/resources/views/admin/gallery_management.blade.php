@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Manage Gallery</h1>
    <a href="add_gallery" class="btn btn-primary">Add Gallery</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Catalogue/Category</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($gallery_arr)
                        @foreach($gallery_arr as $value)
                        <tr>
                            <td>{{ $value->gallery_id }}</td>
                            <td class="fw-bold">{{ $value->image_title }}</td>
                            <td>
                                <img width="100px" src="{{ asset('admin/assets/images/gallery/' . $value->image) }}" class="img-fluid rounded border shadow-sm" alt="{{ $value->image_title }}">
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">CAT #{{ $value->catalogue_id }}</span><br>
                                <span class="badge bg-light text-dark border mt-1">CATE #{{ $value->category_id }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $value->status == 'active' ? 'success' : 'danger' }} rounded-pill">
                                    {{ ucfirst($value->status) }}
                                </span>
                            </td>
                            <td>{{ date('d M Y', strtotime($value->created_at)) }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ url('admin/edit_gallery?id=' . $value->gallery_id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                    <i class="fa fa-edit me-1"></i> Edit
                                </a>
                                <a href="{{ url('admin/delete_gallery/' . $value->gallery_id) }}" 
                                   onclick="return confirm('Are you sure?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash me-1"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No gallery items found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
