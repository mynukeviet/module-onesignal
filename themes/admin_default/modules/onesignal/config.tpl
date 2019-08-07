<!-- BEGIN: main -->
<form action='' method='post' class='form-horizontal'>
	<div class='panel panel-default'>
		<div class='panel-body'>
			<div class='form-group'>
				<label class='col-sm-4 control-label'>{LANG.config_auth_key}</label>
				<div class='col-sm-20'>
					<input type='text' name='auth_key' value='{DATA.auth_key}' class='form-control' />
				</div>
			</div>
		</div>
	</div>
	<div class='text-center'>
		<input type='submit' class='btn btn-primary' value='{LANG.save}' name='savesetting' />
	</div>
</form>
<!-- END: main -->
