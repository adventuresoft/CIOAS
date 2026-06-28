<div class="table-action d-flex align-items-center justify-content-center">
    <a href="{{ route('basic-settings.hotel-category.show', $id) }}" class="btn btn-sm btn-info mr-1" title="Show" data-toggle="tooltip">
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('basic-settings.hotel-category.edit', $id) }}" class="btn btn-sm btn-primary mr-1" title="Edit" data-toggle="tooltip">
        <i class="fa fa-edit"></i>
    </a>
    <a href="{{ route('basic-settings.hotel-subcategory.index', $id) }}" class="btn btn-sm btn-warning mr-1"
        title="Subcategories" data-toggle="tooltip">
        <i class="fa fa-list"></i>
    </a>
    <form action="{{ route('basic-settings.hotel-category.destroy', $id) }}" method="POST" class="deleteData" style="display:inline-block; margin:0;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Delete" data-toggle="tooltip">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</div>
