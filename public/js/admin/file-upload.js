//"use strict";jQuery,Dropzone.autoDiscover=!1,new Dropzone("#media-library-dropzone",{autoProcessQueue:!1,dictDefaultMessage:"Drop files here or click to Select files"});
Dropzone.autoDiscover = false;
$("#media-library-dropzone").dropzone({ 
    url: "/admin/media/upload/product",
    uploadMultiple: true,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(file, response){
        LoadMedia();
        swal({
            icon: "success",
            buttons: false,
        });
        $('.nav-tabs a[href="#media-library"]').tab('show');
    },
    error: function(file, response){
        swal('Upload Failed');
    }
});

$('#openMedia').click(function(){
    console.log('call');
    LoadMedia();
});

function LoadMedia() {
    $.ajax({
        url: '/admin/media/list',
        type: 'get',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){ 
          // Add response in Modal body
          var list = $('#listMedia');
          list.empty();
          $.each(data, function(index, value) {
            list.append(
                '<div class="col-sm-6 col-lg-3 mb-4">' +
                '<div class="custom-control custom-radio custom-control--with-img">' +
                   '<input type="radio" class="custom-control-input" id="media-check-' + value.id + '" name="media_id" value="' + value.id + '" data-id="' + value.id + '" data-url="/' + value.path + '/' + value.name + '" onchange="selectedMedia(this)">' +
                   '<label class="custom-control-label" for="media-check-' + value.id + '">' +
                        '<img src="/' + value.path + '/' + value.name + '" alt="image">' +
                   '</label>' +
                   '</div>' +
                '</div>'
                   );
          });
        }
      });    
}

function selectedMedia(elem) {
    var id = $(elem).data("id");
    var url = $(elem).data("url");
    $('#selectedPic').html('<img src="' + url + '" class="img-thumbnail w-25">');
    $('#mediaId').val(id);
}
