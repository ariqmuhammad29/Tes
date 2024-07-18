<section class="mt-4">
  <h6 class="text-muted mb-3">Product Posts</h6>

  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="product_posts_read" name="product_posts_read" @if ($role->hasPermissionTo('product posts read') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="product_posts_read">
      Read product posts
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="product posts_create" name="product posts_create" @if ($role->hasPermissionTo('product posts create') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="product posts_create">
      Create product posts
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="product posts_update" name="product posts_update" @if ($role->hasPermissionTo('product posts update') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="product posts_update">
      Edit product posts
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="product posts_delete" name="product posts_delete" @if ($role->hasPermissionTo('product posts delete') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="product posts_delete">
      Delete product posts
    </label>
  </div>
</section>