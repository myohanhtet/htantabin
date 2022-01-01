<form action="{{ route('pathans.destroy',[$id]) }}" method="POST">
    @method('delete')
    @csrf

    <div class='btn-group'>
        <a href="{{ route('pathans.show', $id) }}" class='btn btn-default btn-group-sm'>
            <i class="fas fa-eye"></i>
        </a>
        <a href="{{ route('pathans.edit', $id) }}" class='btn btn-default btn-group-sm'>
            <i class="fas fa-user-edit"></i>
        </a>
        <button type="submit" class="btn btn-danger btn-group-sm" onclick="return confirm('Are you sure?')">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>

</form>
