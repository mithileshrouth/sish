<tr id="rowfacilityRow_0_<?php echo $rowno; ?>">
	<td>
		<select name="facilityTitle[]" id="facilityTitle_0_<?php echo $rowno; ?>" class="form-control forminputs facilityTitle" data-show-subtext="true" data-live-search="true">
			<option value="0">Select</option>
			<?php
				foreach ($facilityList as $key => $value) { ?>
					<option value="<?php echo $value->id ?>"><?php echo $value->title; ?></option>
			<?php	}
			?>
		</select>
	</td>
	
	<td style="vertical-align: middle;">
		<a href="javascript:;" class="facilitydelRow" id="facilitydelRow_0_<?php echo $rowno; ?>" title="Delete">
			<span class="glyphicon glyphicon-trash"></span>
		</a>
	</td>
</tr>
