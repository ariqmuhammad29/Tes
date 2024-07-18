<section class="mt-4">
  <h6 class="text-muted mb-3">File Manager</h6>

  <div class="row">
    <div class="col">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="gallery_file_manager_access"
          name="gallery_file_manager_access"
          @if ($role->hasPermissionTo('gallery file manager access') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="gallery_file_manager_access">
          Access File Manager
        </label>
      </div>
    </div>
  </div>
</section>