<section class="mt-4">
  <h6 class="text-muted mb-3">Product Categories</h6>

  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="product_categories_read" name="product_categories_read" @if ($role->hasPermissionTo('product categories read') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="product_categories_read">
      Read product categories
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="product categories_create" name="product categories_create" @if ($role->hasPermissionTo('product categories create') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="product categories_create">
      Create product categories
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="product categories_update" name="product categories_update" @if ($role->hasPermissionTo('product categories update') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="product categories_update">
      Edit product categories
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="product categories_delete" name="product categories_delete" @if ($role->hasPermissionTo('product categories delete') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="product categories_delete">
      Delete product categories
    </label>
  </div>
</section>