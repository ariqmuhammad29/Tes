<section class="mt-4">
  <h6 class="text-muted mb-3">Users</h6>

  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="users_read"
      name="users_read"
      @if ($role->hasPermissionTo('users read') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="users_read">
      Read users
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="users_create"
      name="users_create"
      @if ($role->hasPermissionTo('users create') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="users_create">
      Create users
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="users_update"
      name="users_update"
      @if ($role->hasPermissionTo('users update') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="users_update">
      Edit users
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="users_delete"
      name="users_delete"
      @if ($role->hasPermissionTo('users delete') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="users_delete">
      Delete users
    </label>
  </div>
</section>