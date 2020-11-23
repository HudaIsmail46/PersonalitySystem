var imageable = document.getElementById("dropzone");
if(imageable)
{
    var dzPreview = document.getElementById("dzPreview").innerHTML;
    var token = imageable.getAttribute('data-token');
    var imageable_id = imageable.getAttribute('data-imageableid');
    var imageable_type = imageable.getAttribute('data-imageabletype');
    Dropzone.autoDiscover = false;
    Dropzone.options.dropzone =
    {
        maxFilesize: 12,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: false,
        timeout: 5000,
        autoQueue: false,
        previewTemplate: dzPreview
    };

    var myDropzone = new window.Dropzone("div#dropzone", { url: "/image"});

    myDropzone.on("sending", function(file, xhr, formData) {
        // Will send the filesize along with the file as POST data.
        var caption = file.previewElement.querySelector("input#caption");
        formData.append("imageable_id", imageable_id);
        formData.append("imageable_type", imageable_type);
        formData.append("_token", token);
        formData.append("caption", caption.value)
        caption.setAttribute("readonly", "readonly")
        file.previewElement.querySelector(".buttons").setAttribute("style", "display: none;");
        
    });

    myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".upload").onclick = function() { myDropzone.enqueueFile(file); };
        file.previewElement.querySelector(".cancel").onclick = function() { myDropzone.removeFile(file); };
    });
}
