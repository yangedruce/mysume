<small class="text-dark ff-days-one">Choose Template</small>

@foreach($templates as $no => $template)
    <div class="main-box p-4 mb-3">
        <div class="form-check">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-block">
                    <input class="form-check-input me-3" type="radio" name="template" id="inputTemplate{{$no}}" value="{{ $template->id }}" required
                    @if($resume ?? '')
                        @if($resume->template_id==$template->id)
                            checked
                        @endif
                    @endif
                    >
                    <label class="form-check-label ff-montserrat fw-bold small" for="inputTemplate{{$no}}">
                        {{ $template->name }}
                    </label>
                </div>
                <a href="{{ route('resume.preview-resume', ['template' => $template->name]) }}" target="_blank">
                    <button type="button" class="btn btn-main btn-width text-white ff-montserrat"><small>Preview</small></button>
                </a>
            </div>
        </div>
    </div>
@endforeach