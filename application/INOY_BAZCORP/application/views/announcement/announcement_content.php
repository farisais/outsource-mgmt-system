<?php
foreach($activity_list as $act)
{
?>
<div class="announcement-obj announcement-box" style="width: 50%;">
    <div class="announcement-content">
        <div>
            <span class="announcement-header"><?php echo $act['activity']?></span>
            <div class="field-data"><span style="font-weight: bold;margin-left: -15px;">Details: </span>
            <?php 
            $data = json_decode($act['field_data'], true);
            echo '<ul style="list-style: inherit;">';

            foreach($data as $key => $value)
            {
                echo '<li><span class="key-style">'. $key . '</span> : ' . (is_array($value) ? 'details' : $value) . '</li>';
            }
            
            ?>
            </div>
            <?php echo '</ul>' ?>
        </div>
        <div>
            Created by <span class="user-tag"><?php echo $act['user_name'] ?></span> at <?php echo date('d-m-Y H:i:s', strtotime($act['date_create'])); ?>
        </div>
    </div>
    <div class="announcement-action"></div>
</div>
<!--<div class="announcement-obj announcement-box announcement-comment">
    <div class="announcement-content">
        <div>
        </div>
    </div>
</div>-->
<?php
}
?>