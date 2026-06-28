<div class="table-action d-flex align-items-center justify-content-center">
    <a href="{{ route('vehicle.show', $id) }}" class="btn btn-sm btn-info mr-1" title="View" data-toggle="tooltip">
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('vehicle.edit', $id) }}" class="btn btn-sm btn-primary" title="Edit" data-toggle="tooltip">
        <i class="fa fa-edit"></i>
    </a>
</div>
