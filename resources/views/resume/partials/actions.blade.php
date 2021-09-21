<div class="dropdown">
    <button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <x-icons.more-vertical></x-icons.more-vertical>
    </button>

    <ul class="dropdown-menu bg-transparent py-0" aria-labelledby="dropdownMenuButton" style="border: none;">
        @if($resume->status === 'Published')
            <li class="w-100">
                <a class="dropdown-item dropdown-box"
                   href="{{ route('resume.view-resume', ['username' => Auth::user()->username, 'resume_id' => $resume->id]) }}"
                   target="_blank">
                    <small>View Resume</small>
                </a>
            </li>
        @endif

        <li class="w-100">
            <a class="dropdown-item dropdown-box" href="{{ route('resume.view-edit-resume', $resume->id) }}">
                <small>Edit Resume</small>
            </a>
        </li>

        <li class="w-100">
            <button type="button"
                    class="dropdown-item dropdown-box"
                    onclick="triggerDelete({{ $resume->id }},'{{ $resume->title }}', '{{ route('resume.delete', $resume) }}')"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteModal">
                <small>Delete Resume</small>
            </button>
        </li>
    </ul>
</div>
