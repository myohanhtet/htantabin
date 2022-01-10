<form action="{{ route('lucky.destroy',[$id]) }}" method="POST">
    @method('delete')
    @csrf

    <div class='btn-group'>
        <a href="{{ route('lucky.show', $id) }}" class='btn btn-default btn-xs'>
            <i class="fas fa-eye"></i>
        </a>
        <a href="{{ route('lucky.edit', $id) }}" class='btn btn-default btn-xs'>
            <i class="fas fa-user-edit"></i>
        </a>
        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">
            <i class="fas fa-trash-alt"></i>
        </button>
    </div>

</form>
