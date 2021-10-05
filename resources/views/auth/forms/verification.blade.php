<form action="{{ route('verification.send') }}" method="POST">
    @csrf
    <div class="ff-montserrat text-dark mt-5 mb-3 small">
        {{ __('Hi, ') }}<span class="ff-montserrat text-blue-dark fw-bold">{{ Auth::user()->username }}</span>. Thank you for registering with Mysume.
    </div>
    <div class="ff-montserrat text-dark my-4 small">
        Your account is not verified yet, please check your email at <span class="ff-montserrat text-blue-dark fw-bold">{{ Auth::user()->email }}</span> for a verification link. If you did not receive the email, you may request a new verification link.
    </div>
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-main btn-width mt-4 text-white ff-montserrat"><small>Resend Link<small></button>
    </div>
</form>