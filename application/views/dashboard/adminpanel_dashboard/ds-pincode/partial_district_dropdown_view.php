
<select id="district" name="district" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
    <option value="0">Select</option>
      <?php 
      if($districList)
      {
        foreach($districList as $districtlist)
        { ?>
            <option value="<?php echo $districtlist->id; ?>"><?php echo $districtlist->name; ?></option>
    <?php   }
          }
          ?>
</select>
