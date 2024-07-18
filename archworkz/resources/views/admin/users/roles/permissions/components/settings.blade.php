<section class="mt-4">
  <h6 class="text-muted mb-3">Settings</h6>

  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      id="settings"
      name="settings"
      @if ($role->hasPermissionTo('settings') or $role->name === 'superadmin') checked @endif>

    <label class="form-check-label" for="settings">
      Change settings
    </label>
  </div>
</section>