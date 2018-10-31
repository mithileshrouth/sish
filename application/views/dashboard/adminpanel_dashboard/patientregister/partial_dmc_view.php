<select id="dmcdrp" name="dmcdrp" 
        class="form-control selectpicker"
        data-show-subtext="true" data-actions-box="true" 
        data-live-search="true" >
    <option value="0">Select</option>
        <?php
    if (!empty($rslt)) {
        foreach ($rslt as $value) {
            ?>
    <option value="<?php echo($value->id); ?>"><?php echo($value->name); ?></option>

    <?php }
} ?>   
</select>