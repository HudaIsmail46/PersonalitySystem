var imageable = document.getElementById("dropzone");
if(imageable)
{
    Dropzone.autoDiscover = false;
    Dropzone.options.dropzone =
    {
        maxFilesize: 12,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 5000,
        removedfile: function(file)
        {
            var name = file.upload.file;
            $.ajax({
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                type: 'POST',
                url: '{{ url("image/delete") }}',
                data: {filename: name},
                success: function (data){
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }});
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function(file, response)
        {
            console.log(response);
        },
        error: function(file, response)
        {
        return false;
        }
    };

    var token = imageable.getAttribute('data-token');
    var imageable_id = imageable.getAttribute('data-imageableid');
    var imageable_type = imageable.getAttribute('data-imageabletype');
    var myDropzone = new window.Dropzone("div#dropzone", { url: "/api/image"});
    myDropzone.on("sending", function(file, xhr, formData) {
        // Will send the filesize along with the file as POST data.
        formData.append("imageable_id", imageable_id);
        formData.append("imageable_type", imageable_type);
        formData.append("_token", token);
    });
}
