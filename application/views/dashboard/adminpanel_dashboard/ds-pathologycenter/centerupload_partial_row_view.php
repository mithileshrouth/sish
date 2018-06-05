<tr id="rowcenterUploadDoc_0_<?php echo $rowno; ?>">
	<td>
		<select name="centerUploaddocType[]" id="centerUploaddocType_0_<?php echo $rowno; ?>" class="form-control forminputs centerUploaddocType">
			<option value="0">Select</option>
			<?php
				foreach ($documentTypeList as $key => $value) { ?>
					<option value="<?php echo $value->id ?>"><?php echo $value->document_type; ?></option>
			<?php	}
			?>
		</select>
			<input type="hidden" name="centerUploadprvFilename[]" id="centerUploadprvFilename_0_<?php echo $rowno; ?>" class="form-control forminputs centerUploadprvFilename" value="" readonly >

			<input type="hidden" name="centerUploadrandomFileName[]" id="centerUploadrandomFileName_0_<?php echo $rowno; ?>" class="form-control forminputs centerUploadrandomFileName" value="" readonly >

			<input type="hidden" name="centerUploaddocDetailIDs[]" id="centerUploaddocDetailIDs_0_<?php echo $rowno; ?>" class="form-control forminputs centerUploaddocDetailIDs" value="0" readonly >
	</td>
	<td>
		<input type="file" name="centerUploadfileName[]" class="file forminputs centerUploadfileName" id="centerUploadName_0_<?php echo $rowno; ?>">
		<div class="input-group col-xs-12">
		     <!--  <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span> -->
			<input type="text" name="centerUploaduserFileName[]" id="centerUploaduserFileName_0_<?php echo $rowno; ?>" class="form-control input-xs userfilesname" readonly placeholder="Upload Document" >

				<input type="hidden" name="centerUploadisChangedFile[]" id="centerUploadisChangedFile_0_<?php echo $rowno; ?>" value="Y" >
				<span class="input-group-btn">
			    <button class="browse btn btn-primary input-xs" type="button" id="centerUploaduploadBtn_0_<?php echo $rowno; ?>">
			      	<i class="fa fa-folder-open" aria-hidden="true"></i>
				</button>
			    </span>
		</div>
	</td>
	<td>
		<textarea name="centerUploadfileDesc[]" id="centerUploadfileDesc_0_<?php echo $rowno; ?>" class="form-control forminputs centerUploadfileDesc"></textarea>
	</td>
	<td style="vertical-align: middle;">
		<a href="javascript:;" class="centerUploaddelDocType" id="centerUploaddelDocRow_0_<?php echo $rowno; ?>" title="Delete">
			<span class="glyphicon glyphicon-trash"></span>
		</a>
	</td>
</tr>