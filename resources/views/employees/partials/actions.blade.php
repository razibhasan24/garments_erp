{{-- resources/views/employees/partials/actions.blade.php --}}
<div class="btn-group">
    <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this employee?');">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
    </form>
</div>
