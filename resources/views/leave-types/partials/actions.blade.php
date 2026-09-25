{{-- resources/views/leave-types/partials/actions.blade.php --}}
<div class="btn-group">
    <a href="{{ route('leave-types.edit', $leaveType) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('leave-types.destroy', $leaveType) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this leave type?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
