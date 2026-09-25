{{-- resources/views/floors/partials/actions.blade.php --}}
<div class="btn-group">
    <a href="{{ route('floors.edit', $floor) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('floors.destroy', $floor) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this floor?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
