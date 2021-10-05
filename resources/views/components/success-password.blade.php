{{-- update password --}}
@if(session('status'))         
    <div class="fw-bold alert alert-success ff-montserrat small">{{ __('Your password has been updated.') }}</div>
@endif