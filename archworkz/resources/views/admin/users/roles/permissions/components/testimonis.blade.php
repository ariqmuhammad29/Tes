<section class="mt-4">
  <h6 class="text-muted mb-3">Testimoni</h6>

  <div class="row">
    <div class="col-md-6">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="testimoni_read"
          name="testimoni_read"
          @if ($role->hasPermissionTo('testimoni read') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="testimoni_read">
          Read testimoni
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="testimoni_create"
          name="testimoni_create"
          @if ($role->hasPermissionTo('testimoni create') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="testimoni_create">
          Create testimoni
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="testimoni_update"
          name="testimoni_update"
          @if ($role->hasPermissionTo('testimoni update') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="testimoni_update">
          Edit testimoni
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="testimoni_delete"
          name="testimoni_delete"
          @if ($role->hasPermissionTo('testimoni delete') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="testimoni_delete">
          Delete testimoni
        </label>
      </div>
    </div>
  </div>
</section>