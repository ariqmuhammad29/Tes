<section class="mt-4">
  <h6 class="text-muted mb-3">Portofolio Posts</h6>

  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="portofolio_posts_read" name="portofolio_posts_read" @if ($role->hasPermissionTo('portofolio posts read') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="portofolio_posts_read">
      Read portofolio posts
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="portofolio posts_create" name="portofolio posts_create" @if ($role->hasPermissionTo('portofolio posts create') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="portofolio posts_create">
      Create portofolio posts
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="portofolio posts_update" name="portofolio posts_update" @if ($role->hasPermissionTo('portofolio posts update') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="portofolio posts_update">
      Edit portofolio posts
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="portofolio posts_delete" name="portofolio posts_delete" @if ($role->hasPermissionTo('portofolio posts delete') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="portofolio posts_delete">
      Delete portofolio posts
    </label>
  </div>
</section>