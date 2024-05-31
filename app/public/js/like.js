// public/js/like.js

$(document).on('click', '.like-button', function() {
    var postId = $(this).data('post-id');
    var button = $(this);

    $.ajax({
        url: '/ajaxlike',
        type: 'POST',
        data: {
            post_id: postId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            button.find('.like-count').text(response.postLikesCount);
            button.toggleClass('liked');
        }
    });
});
