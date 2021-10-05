{{-- edit profile information --}}
<form action="{{ route('user-profile-information.update') }}" method="POST" id="formText" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('profile.partials.profile-picture')

    {{-- messages/alerts --}}
    <x-error-profile></x-error-profile>
    <x-success></x-success>

    @include('profile.partials.input-profile')

    <div class="d-flex justify-content-center align-items-center mt-5 flex-column flex-md-row">
        <button type="button" class="btn btn-main btn-width m-2 text-white" data-bs-toggle="modal" data-bs-target="#saveProfileModal"><small>Save Profile</small></button>
        <a href="{{ route('profile.edit') }}">
            <button type="button" class="btn btn-main-blue btn-width m-2 text-blue-dark"><small>Cancel</small></button>
        </a>
    </div>

    @include('profile.partials.save-modal')
</form>