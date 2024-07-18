<section class="mt-4">
  <h6 class="text-muted mb-3">Blog Categories</h6>

  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="blog_categories_read"
      name="blog_categories_read"
      @if ($role->hasPermissionTo('blog categories read') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="blog_categories_read">
      Read blog categories
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="blog categories_create"
      name="blog categories_create"
      @if ($role->hasPermissionTo('blog categories create') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="blog categories_create">
      Create blog categories
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="blog categories_update"
      name="blog categories_update"
      @if ($role->hasPermissionTo('blog categories update') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="blog categories_update">
      Edit blog categories
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="blog categories_delete"
      name="blog categories_delete"
      @if ($role->hasPermissionTo('blog categories delete') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="blog categories_delete">
      Delete blog categories
    </label>
  </div>
</section>