{{-- resources/views/buyers/partials/actions.blade.php --}}
<div class="btn-group">
    <a href="{{ route('buyers.edit', $buyer) }}" class="btn btn-sm btn-warning">
        <i class="fas fa-edit"></i>
    </a>
    <form action="{{ route('buyers.destroy', $buyer) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this buyer?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>
