var get_suburbs_by_postcode = function(postcode) {
    var result = "";
    $.ajax({
        type: "POST",
        url: g5_url+"/shop/ajax.suburblist.php",
        data: {postcode: postcode},
        cache: false,
        async: false,
        success: function(data) {
            result = data;
        }
    });
    return result;
}