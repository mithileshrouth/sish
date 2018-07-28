

<select id="sel_tu" name="sel_tu[]" class="form-control selectpicker" class="form-control selectpicker"
                       data-show-subtext="true" data-actions-box="true" data-live-search="true" multiple="multiple" >
	
		<?php
				foreach ($tuList as $key => $value) { ?>

				<option value="<?php echo $value->tuid; ?>"><?php echo $value->tuname; ?></option>

					<?php	}
					?>

</select>