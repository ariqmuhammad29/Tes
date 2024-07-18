<section class="mt-4">
  <h6 class="text-muted mb-3">Gallery Videos</h6>

  <div class="row">
    <div class="col">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="gallery_videos_read"
          name="gallery_videos_read"
          @if ($role->hasPermissionTo('gallery videos read') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="gallery_videos_read">
          Read gallery videos
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="gallery videos_create"
          name="gallery videos_create"
          @if ($role->hasPermissionTo('gallery videos create') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="gallery videos_create">
          Create gallery videos
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="gallery videos_update"
          name="gallery videos_update"
          @if ($role->hasPermissionTo('gallery videos update') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="gallery videos_update">
          Edit gallery videos
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="gallery videos_delete"
          name="gallery videos_delete"
          @if ($role->hasPermissionTo('gallery videos delete') or $role->name === 'superadmin') checked @endif>

        <label class="form-check-label" for="gallery videos_delete">
          Delete gallery videos
        </label>
      </div>
    </div>
  </div>
</section>