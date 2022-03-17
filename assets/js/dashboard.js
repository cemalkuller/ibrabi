//set main image session
$(document).on('click', '.btn-set-image-main-session', function () {
    var file_id = $(this).attr('data-file-id');
    var data = {
        "file_id": file_id,
        "sys_lang_id": sys_lang_id
    };
    $('.badge-is-image-main').removeClass('badge-success');
    $('.badge-is-image-main').addClass('badge-secondary');
    $(this).removeClass('badge-secondary');
    $(this).addClass('badge-success');
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "file_controller/set_image_main_session",
        data: data,
        success: function (response) {
        }
    });
});

//set main image
$(document).on('click', '.btn-set-image-main', function () {
    var image_id = $(this).attr('data-image-id');
    var product_id = $(this).attr('data-product-id');
    var data = {
        "image_id": image_id,
        "product_id": product_id,
        "sys_lang_id": sys_lang_id
    };
    $('.badge-is-image-main').removeClass('badge-success');
    $('.badge-is-image-main').addClass('badge-secondary');
    $(this).removeClass('badge-secondary');
    $(this).addClass('badge-success');
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "file_controller/set_image_main",
        data: data,
        success: function (response) {
        }
    });
});

//delete product image session
$(document).on('click', '.btn-delete-product-img-session', function () {
    var file_id = $(this).attr('data-file-id');
    var data = {
        "file_id": file_id,
        "sys_lang_id": sys_lang_id
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "file_controller/delete_image_session",
        data: data,
        success: function () {
            $('#uploaderFile' + file_id).remove();
        }
    });
});

//delete product image
$(document).on('click', '.btn-delete-product-img', function () {
    var file_id = $(this).attr('data-file-id');
    var data = {
        "file_id": file_id,
        "sys_lang_id": sys_lang_id
    };
    data[csfr_token_name] = $.cookie(csfr_cookie_name);
    $.ajax({
        type: "POST",
        url: base_url + "file_controller/delete_image",
        data: data,
        success: function (response) {
            location.reload();
        }
    });
});