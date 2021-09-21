<div class="main-box mt-4 w-100">
    <div class="d-flex align-items-center justify-content-between p-3 w-100">
        <div class="d-flex w-100 justify-content-between">
            <p class="text-dark ff-days-one mb-0 text-18">
                {{ $resume->title }}

                <span class="text-dark fs-6 ff-montserrat d-block">{{ $resume->template->name }}</span>

                <span class="ff-montserrat d-block mt-4 text-grey-dark text-10">
                    Last updated: {{ date('h:ia d F Y', strtotime($resume->updated_at)) }}
                </span>
            </p>

            <p class="ff-montserrat d-block text-10 text-blue-dark">{{ $resume->status }}</p>
        </div>

        @include('resume.partials.actions')
    </div>
</div>
