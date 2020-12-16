var imageable = document.getElementById("dropzone");
var addMoreFile = document.getElementById("addMoreFile");

if(imageable)
{
    var dzPreview = document.getElementById("dzPreview").innerHTML;
    var token = imageable.getAttribute('data-token');
    var imageable_id = imageable.getAttribute('data-imageableid');
    var imageable_type = imageable.getAttribute('data-imageabletype');
    Dropzone.autoDiscover = false;
    Dropzone.options.dropzone =
    {
        maxFilesize: 8,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: false,
        timeout: 5000,
        autoQueue: false,
        previewTemplate: dzPreview
    };

    var myDropzone = new window.Dropzone("div#dropzone", { url: "/image", params: {
        imageable_id: imageable_id,
        imageable_type: imageable_type,
        _token: token
    }});

    addMoreFile.addEventListener("click", ()=>{ myDropzone.hiddenFileInput.click(); });

    myDropzone.on("sending", function(file, xhr, formData) {
        var caption = file.previewElement.querySelector("input#caption");
        formData.append("caption", caption.value)
        caption.setAttribute("readonly", "readonly")
        file.previewElement.querySelector(".buttons").setAttribute("style", "display: none;");
        
    });

    myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".upload").onclick = function() { myDropzone.enqueueFile(file); };
        file.previewElement.querySelector(".cancel").onclick = function() { myDropzone.removeFile(file); };
    });

    myDropzone.on("success", function(file) {
        var caption = file.previewElement.querySelector("input#caption");
        caption.setAttribute("style", "display: none;");
        file.previewElement.querySelector("#imageCaption").innerText = caption.value;
        file.previewElement.querySelector(".dz-success-mark").classList.remove('d-none')
    });
}
