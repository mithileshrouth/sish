

<select id="sel_coordinator" name="sel_coordinator[]" class="form-control selectpicker" class="form-control selectpicker"
                       data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple" >
	
		<?php
				foreach ($cordinatorList as $key => $value) { ?>

				<option value="<?php echo $value->cordid; ?>"><?php echo $value->cordname; ?></option>

					<?php	}
					?>

</select>