<section class="mt-4">
  <h6 class="text-muted mb-3">Subscribes</h6>

  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="subscribes_read"
      name="subscribes_read"
      @if ($role->hasPermissionTo('subscribes read') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="subscribes_read">
      Read subscribes
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="subscribes_create"
      name="subscribes_create"
      @if ($role->hasPermissionTo('subscribes create') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="subscribes_create">
      Create subscribes
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="subscribes_update"
      name="subscribes_update"
      @if ($role->hasPermissionTo('subscribes update') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="subscribes_update">
      Edit subscribes
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="subscribes_delete"
      name="subscribes_delete"
      @if ($role->hasPermissionTo('subscribes delete') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="subscribes_delete">
      Delete subscribes
    </label>
  </div>
</section>