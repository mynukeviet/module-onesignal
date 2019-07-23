<!-- BEGIN: main -->
<form id="frm-submit">
    <div class="form-group">
        <label>{LANG.app_id}</label> <select name="app_id" class="form-control">
            <!-- BEGIN: apps -->
            <option value="{APPS.id}" {APPS.selected}>{APPS.site_name}</option>
            <!-- END: apps -->
        </select>
    </div>
    <div class="form-group">
        <label>{LANG.content}</label>
        <textarea class="form-control" name="content" rows="10"></textarea>
    </div>
    <div class="text-center">
        <input type="hidden" name="submit" value="1" /> 
        <input class="btn btn-primary" type="submit" value="{LANG.send}" />
    </div>
</form>
<!-- END: main -->