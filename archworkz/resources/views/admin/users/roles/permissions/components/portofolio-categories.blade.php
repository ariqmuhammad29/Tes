<section class="mt-4">
  <h6 class="text-muted mb-3">Portofolio Categories</h6>

  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="portofolio_categories_read" name="portofolio_categories_read" @if ($role->hasPermissionTo('portofolio categories read') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="portofolio_categories_read">
      Read portofolio categories
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="portofolio categories_create" name="portofolio categories_create" @if ($role->hasPermissionTo('portofolio categories create') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="portofolio categories_create">
      Create portofolio categories
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="portofolio categories_update" name="portofolio categories_update" @if ($role->hasPermissionTo('portofolio categories update') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="portofolio categories_update">
      Edit portofolio categories
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="portofolio categories_delete" name="portofolio categories_delete" @if ($role->hasPermissionTo('portofolio categories delete') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="portofolio categories_delete">
      Delete portofolio categories
    </label>
  </div>
</section>