<script>
$(document).ready(function(){
    $("#jqxMenu").jqxMenu({ rtl: true, width: '100%', height: '30', mode: 'horizontal', showTopLevelArrows: true});
    $("#jqxMenu").jqxMenu('setItemOpenDirection', 'form-menu', 'right', 'down');
    $("#jqxMenu").css('visibility', 'visible');
});
</script>
<div id='jqxMenu' style='visibility: hidden;'>
    <ul>
        <li id='form-menu'><a href="#">Menu</a>
            <ul>
                <li><a id="print-grid" href="#">Print</a></li>
                <li><a id="export-grid" href="#">Export</a></li>
            </ul>
        </li>
    </ul>
</div>