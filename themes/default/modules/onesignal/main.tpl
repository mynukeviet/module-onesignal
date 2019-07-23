<!-- BEGIN: main -->
<form class="form-inline m-bottom">
    <select name="app_id" class="form-control" style="width: 250px" id="app_id">
        <!-- BEGIN: apps -->
        <option value="{APPS.id}"{APPS.selected}>{APPS.site_name}</option>
        <!-- END: apps -->
    </select> <a href="{ADDURL}" class="btn btn-primary">{LANG.send_notification}</a>
</form>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>{LANG.successful}</th>
            <th>{LANG.clicked}</th>
            <th>{LANG.completed_at}</th>
        </tr>
    </thead>
    <tbody>
        <!-- BEGIN: notifications -->
        <tr>
            <th><a href="{NOTIFICATIONS.link_view}">{NOTIFICATIONS.id}</a></th>
            <th>{NOTIFICATIONS.successful}</th>
            <th>{NOTIFICATIONS.converted}</th>
            <th>{NOTIFICATIONS.completed_at}</th>
        </tr>
        <!-- END: notifications -->
    </tbody>
    <!-- BEGIN: page -->
    <tfoot>
        <tr>
            <td colspan="5" class="text-center">{PAGE}</td>
        </tr>
    </tfoot>
    <!-- END: page -->
</table>
<script>
    $('#app_id').change(function(){
        $.ajax({
            type : 'POST',
            url : nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&nocache=' + new Date().getTime(),
            data : 'change_app_id=1&new_app_id=' + $('#app_id option:selected').val(),
            success : function(json) {
                if (!json.error) {
                    window.location.href = window.location.href;
                }
            }
        });
    });
</script>
<!-- END: main -->