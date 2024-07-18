<section class="mt-4">
  <h6 class="text-muted mb-3">Pages</h6>

  <div class="row">
    <div class="col-md-6">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="pages_read"
          name="pages_read"
          @if ($role->hasPermissionTo('pages read') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="pages_read">
          Read pages
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="pages_create"
          name="pages_create"
          @if ($role->hasPermissionTo('pages create') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="pages_create">
          Create pages
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="pages_update"
          name="pages_update"
          @if ($role->hasPermissionTo('pages update') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="pages_update">
          Edit pages
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="pages_delete"
          name="pages_delete"
          @if ($role->hasPermissionTo('pages delete') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="pages_delete">
          Delete pages
        </label>
      </div>
    </div>
  </div>
</section>