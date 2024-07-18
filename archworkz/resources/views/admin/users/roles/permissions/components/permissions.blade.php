<section class="mt-4">
  <h6 class="text-muted mb-3">Permissions</h6>

  <div class="row">
    <div class="col-md">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="permissions_read"
          name="permissions_read"
          @if ($role->name === 'superadmin') checked @endif
          disabled>

        <label class="form-check-label" for="permissions_read">
          Read permissions
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="permissions_create"
          name="permissions_create"
          @if ($role->name === 'superadmin') checked @endif
          disabled>

        <label class="form-check-label" for="permissions_create">
          Create permissions
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="permissions_update"
          name="permissions_update"
          @if ($role->name === 'superadmin') checked @endif
          disabled>

        <label class="form-check-label" for="permissions_update">
          Edit permissions
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="permissions_delete"
          name="permissions_delete"
          @if ($role->name === 'superadmin') checked @endif
          disabled>

        <label class="form-check-label" for="permissions_delete">
          Delete permissions
        </label>
      </div>
    </div>
  </div>
</section>