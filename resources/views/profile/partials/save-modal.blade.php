{{-- save profile modal --}}
<div class="modal fade" id="saveProfileModal" tabindex="-1" aria-labelledby="saveProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-body p-5">
                <p class="modal-title fw-bold fs-2 text-dark ff-days-one" id="saveProfileModalLabel">Are you sure to save your profile?</p>
                <button type="button" onclick="checkSubmit()" class="btn btn-main text-white mt-3 w-100"><small>{{ __('Save Profile') }}</small></button>
                <button type="button" class="btn btn-main-blue text-blue-dark mt-3 w-100" data-bs-dismiss="modal"><small>{{ __('Cancel') }}</small></button>
            </div>
        </div>
    </div>
</div>