{{-- resources/views/attendance/partials/actions.blade.php --}}
<div class="btn-group">
    <a href="{{ route('attendance.edit', $attendance) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('attendance.destroy', $attendance) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Delete this attendance record?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
