<section class="mt-4">
  <h6 class="text-muted mb-3">Portofolios</h6>

  <div class="row">
    <div class="col-md-6">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="portofolio_read"
          name="portofolio_read"
          @if ($role->hasPermissionTo('portofolio read') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="portofolio_read">
          Read portofolio
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="portofolio_create"
          name="portofolio_create"
          @if ($role->hasPermissionTo('portofolio create') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="portofolio_create">
          Create portofolio
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="portofolio_update"
          name="portofolio_update"
          @if ($role->hasPermissionTo('portofolio update') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="portofolio_update">
          Edit portofolio
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="portofolio_delete"
          name="portofolio_delete"
          @if ($role->hasPermissionTo('portofolio delete') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="portofolio_delete">
          Delete portofolio
        </label>
      </div>
    </div>
  </div>
</section>