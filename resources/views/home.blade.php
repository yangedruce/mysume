@extends('layouts.navbar')

@section('title', 'Home')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-xl-6">
            <p class="ff-montserrat fw-bold text-dark mb-3 small">
                <x-icons.hand></x-icons.hand>

                Hi <span class="ff-montserrat fw-bold text-blue-dark">{{ Auth::user()->fullname }}</span>, welcome back!
            </p>

            <div class="d-flex justify-content-between flex-column flex-md-row">
                <h1 class="text-dark fs-4 ff-days-one">My Resume</h1>

                <a href="{{ route('resume.view-new-resume') }}" class="align-self-center">
                    <button type="button" class="btn btn-main btn-width text-white ff-montserrat"><small>Create New</small></button>
                </a>
            </div>

            <x-message></x-message>

            @include('resume.partials.list')
        </div>
    </div>

    @include('resume.partials.delete-modal')
@endsection

@push('js')
<script>
    function triggerDelete(id, title, action) {
        $('#deleteTitle').html(title);
        $('#deleteId').val(id);
        $('#deleteForm').attr('action', action);
    }
</script>
@endpush
