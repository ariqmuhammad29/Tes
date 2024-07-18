<section class="mt-4">
  <h6 class="text-muted mb-3">Roles</h6>

  <div class="row">
    <div class="col-md">
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="roles_read"
          name="roles_read"
          @if ($role->name === 'superadmin') checked @endif
          disabled>

        <label class="form-check-label" for="roles_read">
          Read roles
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="roles_create"
          name="roles_create"
          @if ($role->name === 'superadmin') checked @endif
          disabled>

        <label class="form-check-label" for="roles_create">
          Create roles
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="roles_update"
          name="roles_update"
          @if ($role->name === 'superadmin') checked @endif
          disabled>

        <label class="form-check-label" for="roles_update">
          Edit roles
        </label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="checkbox"
          id="roles_delete"
          name="roles_delete"
          @if ($role->name === 'superadmin') checked @endif
          disabled>

        <label class="form-check-label" for="roles_delete">
          Delete roles
        </label>
      </div>
    </div>
  </div>
</section>