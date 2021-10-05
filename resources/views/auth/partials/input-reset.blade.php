<input type="hidden" name="token" value="{{ request()->route('token') }}" >
<input type="hidden" name="email" value="{{ request()->get('email') }}" required>
<p class="mt-5 ff-montserrat text-white small">Please enter a new password to reset your current password.</p>
<div class="form-group my-3">
    <label for="inputPassword" class="form-label ff-days-one small text-blue-light">Password</label>
    <input type="password" class="form-control main-input ff-montserrat text-dark small" id="inputPassword" name="password" required>
</div>
<div class="form-group mb-3">
    <label for="inputConfirmPassword" class="form-label ff-days-one small text-blue-light">Confirm Password</label>
    <input type="password" class="form-control main-input ff-montserrat text-dark small" id="inputConfirmPassword" name="password_confirmation" required>
</div>