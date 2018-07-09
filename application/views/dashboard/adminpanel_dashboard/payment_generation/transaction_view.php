

<select id="sel_txn" name="sel_txn" class="form-control selectpicker" data-show-subtext="true" data-live-search="true" >
		<option value="0">Select</option>
		<?php
				foreach ($txnList as $key => $value) { ?>

				<option value="<?php echo $value->id; ?>"><?php echo $value->transaction_id." / Dt : ".date('Y-m-d', strtotime($value->generation_dt));; ?></option>

					<?php	}
					?>

</select>