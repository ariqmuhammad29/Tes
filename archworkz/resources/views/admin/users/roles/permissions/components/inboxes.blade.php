<section class="mt-4">
  <h6 class="text-muted mb-3">Inboxes</h6>

  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="inboxes_read"
      name="inboxes_read"
      @if ($role->hasPermissionTo('inboxes read') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="inboxes_read">
      Read inboxes
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="inboxes_create"
      name="inboxes_create"
      @if ($role->hasPermissionTo('inboxes create') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="inboxes_create">
      Create inboxes
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="inboxes_update"
      name="inboxes_update"
      @if ($role->hasPermissionTo('inboxes update') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="inboxes_update">
      Edit inboxes
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="inboxes_delete"
      name="inboxes_delete"
      @if ($role->hasPermissionTo('inboxes delete') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="inboxes_delete">
      Delete inboxes
    </label>
  </div>
</section>