@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Enquiries & Inquiries</h1>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Name</th>
                        <th>Contact Info</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($enq_arr)
                        @foreach($enq_arr as $value)
                        <tr class="{{ $value->status == 'new' ? 'table-warning' : '' }}">
                            <td class="ps-4">{{ $value->enquiry_id }}</td>
                            <td><strong>{{ $value->name }}</strong></td>
                            <td class="text-start small">
                                <i class="fa fa-envelope me-1"></i> {{ $value->email }}<br>
                                <i class="fa fa-phone me-1"></i> {{ $value->phone }}
                            </td>
                            <td>{{ $value->subject }}</td>
                            <td class="text-start small text-muted" title="{{ $value->message }}">{{ Str::limit($value->message, 50) }}</td>
                            <td>
                                <span class="badge bg-{{ $value->status == 'new' ? 'danger' : ($value->status == 'responded' ? 'info' : 'success') }} rounded-pill">
                                    {{ ucfirst($value->status) }}
                                </span>
                            </td>
                            <td class="small">{{ date('d-m-Y H:i', strtotime($value->created_at)) }}</td>
                            <td class="text-end pe-4">
                                @if($value->status == 'new')
                                <a href="{{ url('admin/update_enquiry_status?enquiry_id=' . $value->enquiry_id . '&status=responded') }}" class="btn btn-sm btn-outline-info rounded-pill px-3 me-2">Responded</a>
                                @endif
                                <a href="{{ url('admin/delete_enquiry/' . $value->enquiry_id) }}" 
                                   onclick="return confirm('Are you sure?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">No enquiries found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
