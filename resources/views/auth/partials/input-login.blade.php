<div class="form-group mt-3 mb-3">
    <label for="inputEmail" class="form-label ff-days-one small text-blue-light">Email address</label>
    <input type="email" class="form-control main-input ff-montserrat text-dark small" id="inputEmail" name="email" value="{{ old('email') }}" required>
</div>
<div class="form-group mb-3">
    <label for="inputPassword" class="form-label ff-days-one small text-blue-light">Password</label>
    <input type="password" class="form-control main-input ff-montserrat text-dark small" id="inputPassword" name="password" required>
</div>
<div class="d-flex justify-content-between mb-4 flex-column flex-lg-row">
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="checkboxRemember" name="remember">
        <label class="form-check-label fw-bold ff-montserrat text-blue-light small" for="checkboxRemember">Remember me</label>
    </div>
    <a href="{{ route('password.request') }}" class="text-decoration-none fw-bold ff-montserrat text-blue-light small"><span class="me-3">Forgot your password?</span>
        <x-icons.arrow></x-icons.arrow>
    </a>
</div>