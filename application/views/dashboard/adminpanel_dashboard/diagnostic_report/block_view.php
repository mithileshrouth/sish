

<select id="sel_block" name="sel_block[]" class="form-control selectpicker" class="form-control selectpicker"
                       data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple" >
	
		<?php
				foreach ($blockList as $key => $value) { ?>

				<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>

					<?php	}
					?>

</select>