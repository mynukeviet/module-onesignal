/**
 * @Project NUKEVIET 4.x
 * @Author TDFOSS.,LTD (contact@tdfoss.vn)
 * @Copyright (C) 2019 TDFOSS.,LTD. All rights reserved
 * @Createdate Fri, 19 Jul 2019 15:09:52 GMT
 */

$(document).ready(function() {
    $('#frm-submit').submit(function(e) {
        e.preventDefault();
        $('#ajax_loader').css('display', 'block');
        $('#btn-send').prop('disabled', true);
        $.ajax({
            type : 'POST',
            url : nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=content&nocache=' + new Date().getTime(),
            data : $('#frm-submit').serialize(),
            success : function(json) {
                if (json.error) {
                    alert(json.msg);
                } else {
                    window.location.href = json.redirect;
                }
            }
        });
    });
});