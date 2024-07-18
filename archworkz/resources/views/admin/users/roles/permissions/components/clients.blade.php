<section class="mt-4">
  <h6 class="text-muted mb-3">Clients</h6>

  <div class="row">
    <div class="col-md-6">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="clients_read"
          name="clients_read"
          @if ($role->hasPermissionTo('clients read') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="clients_read">
          Read clients
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="clients_create"
          name="clients_create"
          @if ($role->hasPermissionTo('clients create') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="clients_create">
          Create clients
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="clients_update"
          name="clients_update"
          @if ($role->hasPermissionTo('clients update') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="clients_update">
          Edit clients
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="clients_delete"
          name="clients_delete"
          @if ($role->hasPermissionTo('clients delete') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="clients_delete">
          Delete clients
        </label>
      </div>
    </div>
  </div>
</section>