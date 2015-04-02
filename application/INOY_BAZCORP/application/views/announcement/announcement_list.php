<script>
$(document).ready(function(){
    $("#next").click(function(){
        if(parseInt($("#index").val()) < parseInt($("#count_nav").val()))
        {
            var data_post = {};
            data_post['index'] =  parseInt($("#index").val()) + 1;
            redirect_announcement(data_post);
        }
    });
    $("#prev").click(function(){
        if(parseInt($("#index").val()) > 1)
        {
            var data_post = {};
            data_post['index'] =  parseInt($("#index").val()) - 1;
            redirect_announcement(data_post);
        }
    });
    
    $("#page").change(function(){
            var data_post = {};
            data_post['index'] =  parseInt($(this).val());
            redirect_announcement(data_post);
    });
    
    function redirect_announcement(data_post)
    {
        $(".table-right-bar").block({
                message: '<img style="margin-top: 10px" src="<?php echo base_url() . 'images/ajax-loader.gif' ?>"></img><p>Loading Page</p>',
                css : {border: 'none', width: 'auto','-webkit-border-radius': '5px',
                        '-moz-border-radius': '5px'}
        });    
         $.ajax({
            url: "<?php echo base_url() ?>" + "announcement/redirect",
    		type: "POST",
    		data: data_post,
    		success: function(output){
                $(".table-right-bar").unblock();
                try
                {
                    obj = JSON.parse(output);
                }
                catch(err)
                {
                    alert('Fatal error is happening with message : ' + output + '=====> Please contact your system administrator.');
                }
                
                $("#announcement-list").html(obj.content);
                $("#index").val(obj.index);
                $("#page").val(obj.index);
                $(window).scrollTop(0);
    		},
            error: function( jqXhr ) 
            {

            }
        });
    }
});
</script>
<style>
.announcement-box
{
    background: #EDEDF6;
    border-radius: 2px;
    margin-bottom: 2px;
    min-height: 42px;
    border: solid 1px rgba(0,0,0,0.03);
}
.announcement-obj
{
    margin-left: 10px;
    padding: 5px;
    clear: both;
    height: auto;
    display: inline-block;
}

.announcement-comment
{
    margin-left: 30px;
    width: 50%;
}

#announcement-list
{
    padding-top: 10px;
}

.announcement-header
{
    font-size: 10pt;
    font-weight: bold;
    color: #7C7BAD;
}

.field-data
{
    margin-top: 5px;
    font-size: 8pt;
    margin-left: 30px;
    margin-bottom: 5px;
    
}

.field ul
{
    list-style: inherit;
    list-style-type : circle;
}

.user-tag
{
    color: #7C7BAD;
}

.announcement-wrapper
{

}
.announcement-action
{
    float: left;
}

.announcement-content
{
    float: left;
}

.key-style
{
   
}

#announcement-navigation
{
    width: 51%;
    height: 20px;
    margin-left: 10px;
    border-bottom: 1px solid #cacaca;
    background-color: #ededed;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#fcfcfc), to(#dedede));
    background-image: -webkit-linear-gradient(top, #fcfcfc, #dedede);
    background-image: -moz-linear-gradient(top, #fcfcfc, #dedede);
    background-image: -ms-linear-gradient(top, #fcfcfc, #dedede);
    background-image: -o-linear-gradient(top, #fcfcfc, #dedede);
    background-image: linear-gradient(to bottom, #fcfcfc, #dedede);
    -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.4), 0 0 9px rgba(0, 0, 0, 0.1);
    -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.4), 0 0 9px rgba(0, 0, 0, 0.1);
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.4), 0 0 9px rgba(0, 0, 0, 0.1);
}
</style>
<div id="announcement-wrapper">
    <div id="send-message"></div>
    <div id="announcement-list">
    <?php 
        $this->load->view('announcement/announcement_content'); 
    ?>
    </div>
    <div id="announcement-navigation">
        <select id="page">
            <?php
            for($i=0;$i<$count_nav;$i++)
            {?>
            <option value="<?php echo $i + 1?>"><?php echo $i + 1 ?></option>
            <?php 
            }
            ?>
        </select>
        <button id="next" style="float:right;">></button>
        <button id="prev" style="float:right;"><</button>
        <input type="hidden" id="index" value="1" />
        <input type="hidden" id="count_nav" value="<?php echo $count_nav ?>" />
    </div>
</div>