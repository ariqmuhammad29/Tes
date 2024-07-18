<section class="mt-4">
  <h6 class="text-muted mb-3">Blog Posts</h6>

  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="blog_posts_read"
      name="blog_posts_read"
      @if ($role->hasPermissionTo('blog posts read') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="blog_posts_read">
      Read blog posts
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="blog posts_create"
      name="blog posts_create"
      @if ($role->hasPermissionTo('blog posts create') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="blog posts_create">
      Create blog posts
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="blog posts_update"
      name="blog posts_update"
      @if ($role->hasPermissionTo('blog posts update') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="blog posts_update">
      Edit blog posts
    </label>
  </div>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="blog posts_delete"
      name="blog posts_delete"
      @if ($role->hasPermissionTo('blog posts delete') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="blog posts_delete">
      Delete blog posts
    </label>
  </div>
</section>