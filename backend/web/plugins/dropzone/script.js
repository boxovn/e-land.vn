 	
	
	 $(function() {
		  Dropzone.autoDiscover = false;
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners
		var myDropzone = new Dropzone("#image-upload",{
		paramName: "MultipleUploadForm[files]", 
		thumbnailWidth: 120,
		thumbnailHeight: 120,
		accept: function(file, done) {
			if (file.name == "justinbieber.jpg") {
			  done("Naha, you don't.");
			}
			else { done(); }
		},
		//paramName: "document[attachment]", // Rails expects the file upload to be something like model[field_name]
		autoProcessQueue: true,
		addRemoveLinks: true // Don't show remove links on dropzone itself.
	
  });
		  myDropzone.on("addedfile", function(file) {
						console.log(file);
		  });
		   myDropzone.on("removedfile", function (file) {
		
                $.ajax({
        		    url: deleteImageUrl,
        		    type: 'post',
        		    data: {
        		    	id: file.id
        		    },
        			dataType: 'json',
        			async: true,
        			success: function(data) {
        		    }
        		});
            }); 	
		myDropzone.on("success", function(file, response){
			var objData = JSON.parse(response);
			console.log(objData);
        		var currentID = document.getElementById("UploadImageID").value;
        		currentID = currentID != '' ? currentID + ';' : currentID;
				document.getElementById("UploadImageID").value = currentID + objData.sID;
				//alert('success triggered');
		});
			if(dropzoneImage.length>=1){
					for (var i=0; i<dropzoneImage.length; i++) {
					var file = dropzoneImage[i];
					myDropzone.options.addedfile.call(myDropzone, file);
					myDropzone.options.thumbnail.call(myDropzone, file,  file.url);
					myDropzone.emit('complete', file);
				} 
			}
		  myDropzone.on("complete", function(file) {
			//myDropzone.removeFile(file);
		});
	})
		/*	var dropzone = new Dropzone ("#image-upload", {
		maxFilesize: 256, // Set the maximum file size to 256 MB
		paramName: "document[attachment]", // Rails expects the file upload to be something like model[field_name]
		autoProcessQueue: false,
		addRemoveLinks: true // Don't show remove links on dropzone itself.
	
	
  });
  	*/	
/*
  dropzone.on("removedfile", function(file){
    alert('remove triggered');
  });

  dropzone.on("addedfile", function(file){
		// Create the remove button
var removeButton = Dropzone.createElement("<div class=\"remove\"><i class=\"icon-cross\"></idv>");

// Capture the Dropzone instance as closure.
var _this = this;

// Listen to the click event
removeButton.addEventListener("click", function(e) {
// Make sure the button click doesn't submit the form:
e.preventDefault();
e.stopPropagation();

// Remove the file preview.
_this.removeFile(file);
// If you want to the delete the file on the server as well,
// you can do the AJAX request here.
});

// Add the button to the file preview element.
file.previewElement.appendChild(removeButton);
  });

  dropzone.on("success", function(file){
    alert('success triggered');
  });
  dropzone.on("complete", function(file) {
  dropzone.removeFile(file);
});

*/
Dropzone.prototype.defaultOptions.dictDefaultMessage = "Đăng ảnh bằng cách kéo thả hình vào khung";
Dropzone.prototype.defaultOptions.dictFallbackMessage = "Your browser does not support drag'n'drop file uploads.";
Dropzone.prototype.defaultOptions.dictFallbackText = "Please use the fallback form below to upload your files like in the olden days.";
Dropzone.prototype.defaultOptions.dictFileTooBig = "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.";
Dropzone.prototype.defaultOptions.dictInvalidFileType = "You can't upload files of this type.";
Dropzone.prototype.defaultOptions.dictResponseError = "Server responded with {{statusCode}} code.";
Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancel upload";
Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "Are you sure you want to cancel this upload?";
Dropzone.prototype.defaultOptions.dictRemoveFile = "Xóa file";
Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "You can not upload any more files.";
	  
	