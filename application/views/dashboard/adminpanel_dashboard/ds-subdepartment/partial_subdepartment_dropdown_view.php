
<select id="sel_subdepartment" name="sel_subdepartment" class="form-control selectpicker" data-show-subtext="true" data-live-search="true">
    <option value="0">Select</option>
      <?php 
      if($subDepartList)
      {
        foreach($subDepartList as $sub_depart_list)
        { ?>
            <option value="<?php echo $sub_depart_list->id; ?>"><?php echo $sub_depart_list->sub_dep_name; ?></option>
<?php   }
      }
    ?>
</select>
