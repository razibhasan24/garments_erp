{{-- resources/views/leave-applications/partials/actions.blade.php --}}
<div class="btn-group">
    @can('approve', $leave)
        @if ($leave->status === 'Pending')
            <form action="{{ route('leave-applications.update-status', $leave) }}" method="POST" class="d-inline">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="Approved">
                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this leave?')"><i class="fas fa-check"></i></button>
            </form>
            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $leave->id }}">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal fade" id="rejectModal{{ $leave->id }}">
                <div class="modal-dialog">
                    <form action="{{ route('leave-applications.update-status', $leave) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="Rejected">
                        <div class="modal-content">
                            <div class="modal-header"><h5 class="modal-title">Reject Leave</h5></div>
                            <div class="modal-body">
                                <textarea name="rejection_reason" class="form-control" placeholder="Reason for rejection" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Confirm Reject</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endcan
</div>
