<section class="mt-4">
  <h6 class="text-muted mb-3">Sliders</h6>

  <div class="row">
    <div class="col-md">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="sliders_read"
          name="sliders_read"
          @if ($role->hasPermissionTo('sliders read') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="sliders_read">
          Read sliders
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="sliders_create"
          name="sliders_create"
          @if ($role->hasPermissionTo('sliders create') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="sliders_create">
          Create sliders
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="sliders_update"
          name="sliders_update"
          @if ($role->hasPermissionTo('sliders update') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="sliders_update">
          Edit sliders
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="sliders_delete"
          name="sliders_delete"
          @if ($role->hasPermissionTo('sliders delete') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="sliders_delete">
          Delete sliders
        </label>
      </div>
    </div>
  </div>
</section>