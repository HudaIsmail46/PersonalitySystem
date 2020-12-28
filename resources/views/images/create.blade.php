<div
    class="dropzone border border-info rounded"
    id="dropzone"
    data-token="{{csrf_token()}}"
    data-imageableid="{{$imageableId}}"
    data-imageabletype="{{$imageableType}}">
</div>

@if (count($images) > 0)
    <div class="btn btn-primary mt-2" id="addMoreFile">Add More</div>
@else
    <div class="btn btn-primary mt-2" id="addMoreFile">Select file</div>
@endif

<div class="dz-preview dz-file-preview d-none" id="dzPreview" >
    <div class="dz-details d-flex">
        <img data-dz-thumbnail />
        <div class='mt-auto ml-3'>
            <div class="dz-filename"><span data-dz-name></span><small><span class="dz-size ml-2" data-dz-size></span></small></div>
            <input type="text" placeholder='Image Caption' name='caption' id='caption' class='w-100'>
            <p id="imageCaption"></p>
            <div class="progress">
                <div class="progress-bar" role="progressbar" data-dz-uploadprogress>
                    <span class="progress-text"></span>
                </div>
            </div>            
            <div class="mb-1 mt-2 buttons">
                <div class="btn btn-primary upload">Upload</div>
                <div class="btn btn-danger cancel">Cancel</div>
            </div>
            <div class="dz-success-mark d-none"><i class="fas fa-check text-green"></i></div>
            <div class="dz-error-message text-danger"><span data-dz-errormessage></span></div>
        </div>
    </div>
</div>
