<!-- BEGIN: main -->
<form class="form-horizontal" id="frm-submit">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.app_id}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <select name="app_id" class="form-control">
                        <!-- BEGIN: apps -->
                        <option value="{APPS.id}"{APPS.selected}>{APPS.site_name}</option>
                        <!-- END: apps -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 text-right"><strong>{LANG.segments}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <!-- BEGIN: segments -->
                    <label class="show"><input type="radio" name="segments" value="{SEGMENTS.index}" {SEGMENTS.checked} />{SEGMENTS.title}</label>
                    <!-- END: segments -->
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.title}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input type="text" class="form-control" name="title" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.content}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <textarea class="form-control" name="content" rows="6"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.image}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input type="url" class="form-control" name="image" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 col-md-4 control-label"><strong>{LANG.url}</strong></label>
                <div class="col-sm-19 col-md-20">
                    <input type="url" class="form-control" name="url" />
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <input type="hidden" name="submit" value="1" /> <input class="btn btn-primary" type="submit" value="{LANG.send}" />
    </div>
</form>
<!-- END: main -->