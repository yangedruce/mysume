<div class="form-group my-3">
    <label for="inputName" class="form-label ff-days-one text-dark small">Full Name</label>
    <input type="text" class="form-control main-input ff-montserrat text-dark small" id="inputName" name="name" value="{{ old('name') }}" required>
</div>
<div class="form-group mb-3">
    <label for="userName" class="form-label ff-days-one text-dark small">Username</label>
    <input type="text" onchange="checkUsername()" class="form-control main-input ff-montserrat text-dark small" id="userName" name="username" value="{{ old('username') }}" required>
    <p class="text-danger d-none mt-1" id="usernameExist"><small>Username has already existed. Please insert another username.</small></p>
</div>
<div class="form-group mb-3">
    <label for="inputEmail" class="form-label ff-days-one text-dark small">Email address</label>
    <input type="email" class="form-control main-input ff-montserrat text-dark small" id="inputEmail" name="email" value="{{ old('email') }}" required>
</div>
<div class="form-group mb-3">
    <label for="inputPassword" class="form-label ff-days-one text-dark small">Password</label>
    <input type="password" class="form-control main-input ff-montserrat text-dark small" id="inputPassword" name="password" required>
</div>
<div class="form-group mb-3">
    <label for="inputPassword" class="form-label ff-days-one text-dark small">Confirm Password</label>
    <input type="password" class="form-control main-input ff-montserrat text-dark small" id="inputConfirmPassword" name="password_confirmation" required>
</div>