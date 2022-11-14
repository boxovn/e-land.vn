Dropzone.autoDiscover = false;
/*.Dropzone.options.dzone = {
  acceptedFiles: "image/jpeg,image/png,image/gif",
};*/
var base_url = window.location.origin;
$(function () {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners
  var myDropzoneFileUpload = new Dropzone("#dropzone-file-upload", {
    paramName: "file", //paramName: "document[attachment]" Rails expects the file upload to be something like model[field_name]
    maxFilesize: 256, // Set the maximum file size to 256 MB
    maxFiles: 5,
    thumbnailWidth: 120,
    thumbnailHeight: 120,
    acceptedFiles: ".jpeg,.jpg,.png,.doc,.docx,.pdf,.xls,.xlsx",
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
      var id = file.previewElement.id;
      $.ajax({
        url: _jsBaseUrl + "/index.php?r=project/remove-file",
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
    var currentID = document.getElementById("upload_image_id").value;
    currentID = currentID != "" ? currentID + ";" : currentID;
    document.getElementById("upload_image_id").value = currentID + objData.id;

    $(file.previewElement).attr("id", objData.id);
    var a = document.createElement("a");

    a.setAttribute("href", objData.url_file_name);
    a.setAttribute("download", objData.name);
    a.setAttribute("title", "Tải xuống");
    a.className = "download";
    a.innerHTML =
      '<p><i class="fa fa-cloud-download" aria-hidden="true"></i>Tải xuống</p>';
    file.previewTemplate.appendChild(a);
  });

  if (window.dropzoneFiles !== undefined && window.dropzoneFiles.length > 0) {
    for (var i = 0; i < window.dropzoneFiles.length; i++) {
      var file = dropzoneFiles[i];
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
        case "jpeg": {
          filename =
            base_url + "/channels/projects/price_list/thumb_" + file.file_name;
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
      a.setAttribute("title", "Tải xuống");
      a.className = "download";
      a.innerHTML =
        '<p><i class="fa fa-cloud-download" aria-hidden="true"></i>Tải xuống</p>';
      file.previewTemplate.appendChild(a);
    }
  }
});

Dropzone.prototype.defaultOptions.dictDefaultMessage =
  "Đăng ảnh bằng cách kéo thả hình vào khung";
Dropzone.prototype.defaultOptions.dictFallbackMessage =
  "Trình duyệt của bạn không hỗ trợ kép tải lên file";
/*"Your browser does not support drag'n'drop file uploads."; */
Dropzone.prototype.defaultOptions.dictFallbackText =
  "Vui lòng sử dụng biểu mẫu dự phòng bên dưới để tải lên các tệp của bạn giống như ngày trước";
/*"Please use the fallback form below to upload your files like in the olden days."; */
Dropzone.prototype.defaultOptions.dictFileTooBig =
  "File quá lớn ({{filesize}}MiB). Filesize lớn nhất: {{maxFilesize}}MiB.";
/*"File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB."; */
Dropzone.prototype.defaultOptions.dictInvalidFileType =
  "Bạn không thể tải lên những tệp dạng này";
/*"You can't upload files of this type."; */
Dropzone.prototype.defaultOptions.dictResponseError =
  /*"Server responded with {{statusCode}} code."; */
  Dropzone.prototype.defaultOptions.dictCancelUpload = "Huỷ tải lên";
/*"Cancel upload"; */
Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation =
  "Bạn có chắc muốn huỷ tải lên";
/*"Are you sure you want to cancel this upload?";*/

Dropzone.prototype.defaultOptions.dictRemoveFile = "";
Dropzone.prototype.defaultOptions.dictMaxFilesExceeded =
  "Bạn không thể tải lên bất cứ tệp nào nữa";
/*"You can not upload any more files."; */
