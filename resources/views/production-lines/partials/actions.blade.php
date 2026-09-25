{{-- resources/views/production-lines/partials/actions.blade.php --}}
<div class="btn-group">
    <a href="{{ route('production-lines.edit', $line) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('production-lines.destroy', $line) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this production line?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
