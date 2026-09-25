{{-- resources/views/machines/partials/actions.blade.php --}}
<div class="btn-group">
    <a href="{{ route('machines.edit', $machine) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('machines.destroy', $machine) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this machine?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
