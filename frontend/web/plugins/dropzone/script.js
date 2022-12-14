Dropzone.autoDiscover = false;
/*.Dropzone.options.dzone = {
  acceptedFiles: "image/jpeg,image/png,image/gif",
};*/
var base_url = window.location.origin;
$(function () {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners
  var myDropzoneArticleImage = new Dropzone("#image-upload", {
   // paramName: "MultipleUploadForm[files]",
    paramName: "file", //paramName: "document[attachment]" Rails expects the file upload to be something like model[field_name]
    maxFilesize: 256, // Set the maximum file size to 256 MB
    maxFiles: 5,
    thumbnailWidth: 120,
    thumbnailHeight: 120,
    acceptedFiles: ".jpeg,.jpg,.png",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
    //previewTemplate: document.getElementById("preview-template").innerHTML,
    accept: function (file, done) {
      if (file.name == "justinbieber.jpg") {
        done("Naha, you don't.");
      } else {
        done();
      }
    },
    addRemoveLinks: true, // Don't show remove links on dropzone itself.
    //headers: { "X-CSRFToken": window.CSRF_TOKEN },
    autoProcessQueue: true,
    addRemoveLinks: true, // Don't show remove links on dropzone itself.
  });
  myDropzoneArticleImage.on("thumbnail", function (file, thumb) {
    file.thumbnail = thumb;
    myDropzoneArticleImage.processQueue();
  });
  myDropzoneArticleImage.on("sending", function (file, xhr, formData) {
    formData.append("thumbnail", file.thumbnail);
  });
  myDropzoneArticleImage.on("addedfile", function (file, response) {
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
  myDropzoneArticleImage.on("removedfile", function (file) {
    if (file.previewElement.id > 0) {
      var id = file.previewElement.id;
      $.ajax({
        url: _jsBaseUrl + "/user/remove-image",
        type: "post",
        data: {
          id: id,
        },
        dataType: "json",
     //  async: true,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
          var currentId = document.getElementById("article-upload_image_id").value;
          var  currentIdArray=   currentId.split(";");
        var index = currentIdArray.indexOf(data.id.toString());
           if (index !== -1) {
            currentIdArray.splice(index, 1);
          }
        
         document.getElementById("article-upload_image_id").value = currentIdArray.join(';');
        },
      });
    } else {
      console.log("file is not exit");
    }
  });
  myDropzoneArticleImage.on("success", function (file, response) {
    var data = JSON.parse(response);
    var currentID = document.getElementById("article-upload_image_id").value;
    currentID = currentID != "" ? currentID + ";" : currentID;
    document.getElementById("article-upload_image_id").value = currentID + data.id;

    $(file.previewElement).attr("id", data.id);
    var a = document.createElement("a");

    a.setAttribute("href", data.url_file_name);
    a.setAttribute("download", data.name);
    a.setAttribute("title", "T???i xu???ng");
    a.className = "download";
    a.innerHTML =
      '<p><i class="fa fa-cloud-download" aria-hidden="true"></i>T???i xu???ng</p>';
    file.previewTemplate.appendChild(a);
  });

  if (
    window.dropzoneImages !== undefined &&
    window.dropzoneImages.length > 0
  ) {
    for (var i = 0; i < window.dropzoneImages.length; i++) {

      var file = dropzoneImages[i];
      myDropzoneArticleImage.options.addedfile.call(
        myDropzoneArticleImage,
        file
      );
      var ext = file.image.split(".").pop().toLowerCase();
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
            base_url + "/channels/article/210x118/" + file.image;
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

      myDropzoneArticleImage.options.thumbnail.call(
        myDropzoneArticleImage,
        file,
        filename
      );

      myDropzoneArticleImage.emit("complete", file);
      $(file.previewElement).attr("id", file.id);
      var a = document.createElement("a");
      a.setAttribute("href", file.url_file_name);
      a.setAttribute("download", file.file_name);
      a.setAttribute("title", "T???i xu???ng");
      a.className = "download";
      a.innerHTML =
        '<p><i class="fa fa-cloud-download" aria-hidden="true"></i>T???i xu???ng</p>';
      file.previewTemplate.appendChild(a);


      
      var currentID = document.getElementById("article-upload_image_id").value;
      currentID = currentID != "" ? currentID + ";" : currentID;
      document.getElementById("article-upload_image_id").value = currentID + file.id;
      
    }
  }
});

Dropzone.prototype.defaultOptions.dictDefaultMessage =
'<label class="col-sm-12 control-label"> <span class="text">H??nh ???nh nh?? (Ch???n or k??o th???)</span> (upload t???i thi???u 2 h??nh, k??o th??? file ho???c ch???n tr???c ti???p t??? m??y t??nh , Dung l?????ng t??? 600kb - &gt;1Mb k??ch th?????c t???i thi???u ?????i v???i ???nh ngang 1714x968, ???nh ?????ng 968x1714) <strong class="color-red">*</strong> </label>';
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
