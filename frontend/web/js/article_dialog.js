
    //$('.pageDetail').load( "feeds.html" );
    /*
    function revertToOriginalURL() {
        window.history.go(-1);
    }

    $('.modal').on('hidden.bs.modal', function() {
        revertToOriginalURL();
    });
    */

    $('.pageDetail').on('click', function() {
        var id = $(this).data('id');
        var slug = $(this).data('slug');
        $('#landdingPage').find('.modal-content').empty();
        $.ajax({
            url: 'chi-tiet/' + id,
            type: 'get',
            success: function(data) {
                $('#landdingPage').find('.modal-content').html(data);
            }
        }).done(function(data) {

            //  window.location.hash = 'chi-tiet/' +  id;
         /*   window.history.pushState({
                urlPath: slug
            }, "", slug);
            */
            $('#landdingPage').modal('show');

        });

    });
