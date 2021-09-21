<form id="deleteForm" method="POST"> {{-- have error to return to dashboard --}}
    @csrf
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-body p-5">
                    <input type="hidden" id="deleteId" name="resume_id">
                    <p class="modal-title fw-bold fs-2 text-dark ff-days-one" id="deleteModalLabel">Are you sure to delete <span id="deleteTitle"></span>?</p>
                    <button type="submit" class="btn btn-main text-white mt-3 w-100"><small>{{ __('Delete') }}</small></button>
                    <button type="button" class="btn btn-main-blue text-blue-dark mt-3 w-100" data-bs-dismiss="modal"><small>{{ __('Cancel') }}</small></button>
                </div>
            </div>
        </div>
    </div>
</form>
