<section class="mt-4">
  <h6 class="text-muted mb-3">Services</h6>

  <div class="row">
    <div class="col-md-6">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="services_read"
          name="services_read"
          @if ($role->hasPermissionTo('services read') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="services_read">
          Read services
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="services_create"
          name="services_create"
          @if ($role->hasPermissionTo('services create') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="services_create">
          Create services
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="services_update"
          name="services_update"
          @if ($role->hasPermissionTo('services update') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="services_update">
          Edit services
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="services_delete"
          name="services_delete"
          @if ($role->hasPermissionTo('services delete') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="services_delete">
          Delete services
        </label>
      </div>
    </div>
  </div>
</section>