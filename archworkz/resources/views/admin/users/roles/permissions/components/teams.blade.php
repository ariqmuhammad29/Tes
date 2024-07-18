<section class="mt-4">
  <h6 class="text-muted mb-3">Teams</h6>

  <div class="row">
    <div class="col-md-6">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="teams_read"
          name="teams_read"
          @if ($role->hasPermissionTo('teams read') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="teams_read">
          Read teams
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="teams_create"
          name="teams_create"
          @if ($role->hasPermissionTo('teams create') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="teams_create">
          Create teams
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="teams_update"
          name="teams_update"
          @if ($role->hasPermissionTo('teams update') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="teams_update">
          Edit teams
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="teams_delete"
          name="teams_delete"
          @if ($role->hasPermissionTo('teams delete') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="teams_delete">
          Delete teams
        </label>
      </div>
    </div>
  </div>
</section>