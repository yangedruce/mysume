<div class="form-group mt-4">
    <label for="" class="text-dark ff-days-one"><small>Full Name</small></label>
    <input type="text" class="form-control main-input ff-montserrat small" id="inputName" name="name" value="{{ Auth::user()->fullname }}" required>
</div>
<div class="form-group mt-3">
    <label for="" class="text-dark ff-days-one"><small>Username</small></label>
    <input type="text" onchange="checkUsername()" class="form-control main-input ff-montserrat small" id="userName" name="username" value="{{ Auth::user()->username }}" required>
    <p class="text-danger d-none mt-1" id="usernameExist"><small>{{ __('Username has already existed. Please insert another username.')}}</small></p>
</div>
<div class="form-group mt-3">
    <label for="" class="text-dark ff-days-one"><small>Phone No</small></label>
    <input type="text" class="form-control main-input ff-montserrat small" id="phoneNo" name="phoneno" value="{{ Auth::user()->phone_no }}">
</div>
<div class="form-group mt-3">
    <label for="" class="text-dark ff-days-one"><small>Email</small></label>
    <input type="email" class="form-control main-input ff-montserrat small" id="userEmail" name="email" value="{{ Auth::user()->email }}" required>
</div>
<div class="form-group mt-3">
    <label for="" class="text-dark ff-days-one"><small>Location</small></label>
    <input type="text" class="form-control main-input ff-montserrat small" id="userLocation" name="userlocation" value="{{ Auth::user()->location }}">
</div>
<div class="form-group mt-3">
    <label for="" class="text-dark ff-days-one"><small>Website</small></label>
    <input type="text" class="form-control main-input ff-montserrat small" id="userWebsite" name="userwebsite" value="{{ Auth::user()->website }}">
</div>