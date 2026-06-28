<div class="table-action d-flex align-items-center justify-content-center">
    <form action="{{ route('vehicle.repairing.destroy', $id) }}" method="POST" class="delete-form-confirm" style="display:inline-block; margin:0;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" title="Delete" data-toggle="tooltip">
            <i class="fa fa-trash"></i>
        </button>
    </form>
</div>
