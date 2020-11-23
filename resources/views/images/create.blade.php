<div
    class="dropzone border border-info rounded"
    id="dropzone"
    data-token="{{csrf_token()}}"
    data-imageableid="{{$imageableId}}"
    data-imageabletype="{{$imageableType}}">
</div>

<div class="dz-preview dz-file-preview d-none" id="dzPreview" >
    <div class="dz-details d-flex">
        <img data-dz-thumbnail />
        <div class='mt-auto ml-3'>
            <div class="dz-filename"><span data-dz-name></span><small><span class="dz-size ml-2" data-dz-size></span></small></div>
            <input type="text" placeholder='Image Caption' name='caption' id='caption' class='w-100'>
            <div class="mb-1 mt-2 buttons">
                <div class="btn btn-primary upload">Upload</div>
                <div class="btn btn-danger cancel">Cancel</div>
            </div>
            
        </div>
    </div>
    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
    <div class="dz-success-mark"><span>✔</span></div>
    <div class="dz-error-mark"><span>✘</span></div>
    <div class="dz-error-message"><span data-dz-errormessage></span></div>
</div>