<!-- Modal -->
<div class="modal fade modal-danger" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white">Delete Training File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="sr-only">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to Delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light pull-left" data-dismiss="modal">Cancel</button>
        <form action="{{ route('trainings.training.destroy', $training) }}" method="POST">
            @csrf
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger">confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>