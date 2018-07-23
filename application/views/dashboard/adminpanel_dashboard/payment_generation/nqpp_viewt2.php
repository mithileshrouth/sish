

<select id="sel_nqppt2" name="sel_nqppt2" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
		<option value="0">Select</option>
		<?php
				foreach ($nqppList as $key => $value) { ?>

				<option value="<?php echo $value->id; ?>"><?php echo $value->name."  [".$value->mobile_no."]";; ?></option>

					<?php	}
					?>

</select>