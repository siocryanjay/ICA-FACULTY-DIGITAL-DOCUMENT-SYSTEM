
<!-- Modal -->
<div class="modal fade modal-success modal-save" id="confirmSave" role="dialog" aria-labelledby="confirmSaveLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title text-white">Confirm Save</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">close</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Please confirm your changes.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light pull-left" data-dismiss="modal">Cancel</button>
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            {{ method_field('PUT') }}

            <button type="submit" class="btn btn-success pull-right btn-flat">confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>