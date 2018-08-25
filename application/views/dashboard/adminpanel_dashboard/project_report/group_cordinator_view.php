

<select id="grpcoordinator" name="grpcoordinator[]" class="form-control selectpicker" class="form-control selectpicker"
                       data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple" >
	
		<?php
				foreach ($groupcoordinatorList as $key => $value) { ?>

				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>

					<?php	}
					?>

</select>