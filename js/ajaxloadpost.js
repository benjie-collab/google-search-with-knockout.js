function ajaxloadpost_loadpost(postid,nonce) {
    jQuery.ajax({
        type: 'POST',
        url: ajaxloadpostajax.ajaxurl,
        data: {
            action: 'ajaxloadpost_ajaxhandler',
            postid: postid,
            nonce: nonce
        },
        success: function(data, textStatus, XMLHttpRequest) {
            var loadpostresult = '#loadpostresult';
            jQuery(loadpostresult).html('');
            jQuery(loadpostresult).append(data);
        },
        error: function(MLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}