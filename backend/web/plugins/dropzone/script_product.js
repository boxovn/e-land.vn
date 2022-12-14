Dropzone.autoDiscover = false;
/*.Dropzone.options.dzone = {
  acceptedFiles: "image/jpeg,image/png,image/gif",
};*/
var base_url = window.location.origin;
$(function () {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners
  var myDropzoneFileUpload = new Dropzone("#product-image-upload", {
    paramName: "file", //paramName: "document[attachment]" Rails expects the file upload to be something like model[field_name]
    maxFilesize: 256, // Set the maximum file size to 256 MB
    maxFiles: 10,
    thumbnailWidth: 120,
    thumbnailHeight: 120,
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.doc,.docx,.pdf,.xls,.xlsx",
    //previewTemplate: document.getElementById("preview-template").innerHTML,
    accept: function (file, done) {
      if (file.name == "justinbieber.jpg") {
        done("Naha, you don't.");
      } else {
        done();
      }
    },
    headers: { "X-CSRFToken": window.CSRF_TOKEN },
    autoProcessQueue: true,
    addRemoveLinks: true, // Don't show remove links on dropzone itself.
  });

  myDropzoneFileUpload.on("thumbnail", function (file, thumb) {
    file.thumbnail = thumb;
    myDropzoneFileUpload.processQueue();
  });

myDropzoneFileUpload.on("sending", function (file, xhr, formData) {
    formData.append("thumbnail", file.thumbnail);
  });
  myDropzoneFileUpload.on("addedfile", function (file, response) {
    switch (file.type) {
      case "application/vnd.ms-excel":
      case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet": {
        $(file.previewElement)
          .find(".dz-image img")
          .attr("src", base_url + "/file_icons/xls.png");
        break;
      }
      case "image/gif":
      case "image/png":
      case "image/jpeg": {
        $(file.previewElement)
          .find(".dz-image img")
          .attr("src", file.url_file_name);
        break;
      }
      case "application/msword":
      case "application/vnd.openxmlformats-officedocument.wordprocessingml.document": {
        $(file.previewElement)
          .find(".dz-image img")
          .attr("src", base_url + "/file_icons/doc.png");
        break;
      }
      case "application/pdf": {
        $(file.previewElement)
          .find(".dz-image img")
          .attr("src", base_url + "/file_icons/pdf.png");
        break;
      }
      default:
        $(file.previewElement)
          .find(".dz-image img")
          .attr("src", base_url + "/file_icons/file.png");
        break;
    }
  });

  myDropzoneFileUpload.on("removedfile", function (file) {
    
    if (file.previewElement.id > 0) {
      id = file.previewElement.id;
      $.ajax({
        url: _jsBaseUrl + "/index.php?r=product/remove-file",
        type: "post",
        data: {
          id: id,
        },
        dataType: "json",
        async: true,
        success: function (data) {
          console.log(data);
        },
      });
    } else {
      console.log("file is not exit");
    }
  });
  myDropzoneFileUpload.on("success", function (file, response) {
    var objData = JSON.parse(response);
    var currentID = document.getElementById("UploadProductImageID").value;
    currentID = currentID != "" ? currentID + ";" : currentID;
    document.getElementById("UploadProductImageID").value =
      currentID + objData.id;
    $(file.previewElement).attr("id", objData.id);
    var a = document.createElement("a");
    a.setAttribute("href", objData.url_file_name);
    a.setAttribute("download", objData.name);
    a.setAttribute("title", "T???i xu???ng");
    a.className = "download";
    a.innerHTML =
      '<p><i class="fa fa-cloud-download" aria-hidden="true"></i>T???i xu???ng</p>';
    file.previewTemplate.appendChild(a);
  });

  if (window.dropzoneImage !== undefined && window.dropzoneImage.length > 0) {
    for (var i = 0; i < window.dropzoneImage.length; i++) {
      var file = dropzoneImage[i];
      myDropzoneFileUpload.options.addedfile.call(myDropzoneFileUpload, file);
      var ext = file.file_name.split(".").pop().toLowerCase();
      var filename = "";

      switch (ext) {
        case "xlsx":
        case "xls": {
          filename = base_url + "/file_icons/xls.png";
          break;
        }
        case "png":
        case "jpg":
        case "gif":
        case "jpeg": {
          filename = base_url + "/products/images/thumb_" + file.file_name;
          break;
        }
        case "doc":
        case "docx": {
          filename = base_url + "/file_icons/doc.png";
          break;
        }
        case "pdf": {
          filename = base_url + "/file_icons/pdf.png"; // default image path
          break;
        }
        case "zip": {
          filename = base_url + "/file_icons/zip.png";
          break;
        }
        default:
          filename = base_url + "/file_icons/file.png";
          break;
      }

      myDropzoneFileUpload.options.thumbnail.call(
        myDropzoneFileUpload,
        file,
        filename
      );

      myDropzoneFileUpload.emit("complete", file);
      $(file.previewElement).attr("id", file.id);
      var a = document.createElement("a");
      a.setAttribute("href", file.url_file_name);
      a.setAttribute("download", file.name);
      a.setAttribute("title", "T???i xu???ng");
      a.className = "download";
      a.innerHTML =
        '<p><i class="fa fa-cloud-download" aria-hidden="true"></i>T???i xu???ng</p>';
      file.previewTemplate.appendChild(a);
    }
  }
});
Dropzone.prototype.defaultOptions.dictDefaultMessage =
  "????ng ???nh b???ng c??ch k??o th??? h??nh v??o khung";
Dropzone.prototype.defaultOptions.dictFallbackMessage =
  "Tr??nh duy???t c???a b???n kh??ng h??? tr??? k??p t???i l??n file";
/*"Your browser does not support drag'n'drop file uploads."; */
Dropzone.prototype.defaultOptions.dictFallbackText =
  "Vui l??ng s??? d???ng bi???u m???u d??? ph??ng b??n d?????i ????? t???i l??n c??c t???p c???a b???n gi???ng nh?? ng??y tr?????c";
/*"Please use the fallback form below to upload your files like in the olden days."; */
Dropzone.prototype.defaultOptions.dictFileTooBig =
  "File qu?? l???n ({{filesize}}MiB). Filesize l???n nh???t: {{maxFilesize}}MiB.";
/*"File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB."; */
Dropzone.prototype.defaultOptions.dictInvalidFileType =
  "B???n kh??ng th??? t???i l??n nh???ng t???p d???ng n??y";
/*"You can't upload files of this type."; */
Dropzone.prototype.defaultOptions.dictResponseError =
  /*"Server responded with {{statusCode}} code."; */
  Dropzone.prototype.defaultOptions.dictCancelUpload = "Hu??? t???i l??n";
/*"Cancel upload"; */
Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation =
  "B???n c?? ch???c mu???n hu??? t???i l??n";
/*"Are you sure you want to cancel this upload?";*/
Dropzone.prototype.defaultOptions.dictRemoveFile = "";
Dropzone.prototype.defaultOptions.dictMaxFilesExceeded =
  "B???n kh??ng th??? t???i l??n b???t c??? t???p n??o n???a";
/*"You can not upload any more files."; */
