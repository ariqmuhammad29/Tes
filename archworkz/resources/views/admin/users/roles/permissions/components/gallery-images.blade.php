<section class="mt-4">
  <h6 class="text-muted mb-3">Gallery Images</h6>

  <div class="row">
    <div class="col">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="gallery_images_read"
          name="gallery_images_read"
          @if ($role->hasPermissionTo('gallery images read') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="gallery_images_read">
          Read gallery images
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="gallery images_create"
          name="gallery images_create"
          @if ($role->hasPermissionTo('gallery images create') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="gallery images_create">
          Create gallery images
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="gallery images_update"
          name="gallery images_update"
          @if ($role->hasPermissionTo('gallery images update') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="gallery images_update">
          Edit gallery images
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="gallery images_delete"
          name="gallery images_delete"
          @if ($role->hasPermissionTo('gallery images delete') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="gallery images_delete">
          Delete gallery images
        </label>
      </div>
    </div>
  </div>
</section>