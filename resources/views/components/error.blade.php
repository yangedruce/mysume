@if(session('error'))            
    <div class="fw-bold alert alert-danger ff-montserrat mt-3 small">{{ session('error') }}</div>
@endif