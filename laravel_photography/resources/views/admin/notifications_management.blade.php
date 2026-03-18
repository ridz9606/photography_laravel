@extends('admin.layout.structure')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">System Notifications</h1>
    <a href="{{ url('admin/add_notification') }}" class="btn btn-primary">Send New Notification</a>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Message</th>
                        <th>Created At</th>
                        <th class="text-end pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($notif_arr)
                        @foreach($notif_arr as $value)
                        <tr>
                            <td class="ps-4">#{{ $value->notification_id }}</td>
                            <td class="fw-bold" style="max-width: 400px;">{{ $value->message }}</td>
                            <td>{{ date('d-m-Y H:i', strtotime($value->created_at)) }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ url('admin/edit_notification?id=' . $value->notification_id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 me-2">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ url('admin/delete_notification/' . $value->notification_id) }}" 
                                   onclick="return confirm('Are you sure?')" 
                                   class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">No notifications found.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
