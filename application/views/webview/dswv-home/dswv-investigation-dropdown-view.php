<?php 
if(sizeof($investigationList)>0)
{
?>
	<select  class="form-control effect-8 selectpicker txt_input_shdw sel_investigation " data-show-subtext="true" data-live-search="true" id="sel_investigation" name="states" data-dropup-auto="false" data-live-search-placeholder="search test name here" title="<?php echo $sel_title; ?>">	
<?php 
}
else
{
?>
	<select  class="form-control effect-8 selectpicker txt_input_shdw sel_investigation " data-show-subtext="true" data-live-search="true" id="sel_investigation" name="states" data-dropup-auto="false" title="<?php echo $sel_title; ?>" >	
<?php 
}
?>
	<?php 
		
		{
			foreach ($investigationList as $key => $value) { ?>
	
			<option value="<?php echo $value->code; ?>"><?php echo $value->investigationName; ?></option>

		<?php
			}
		}
	?>

</select>