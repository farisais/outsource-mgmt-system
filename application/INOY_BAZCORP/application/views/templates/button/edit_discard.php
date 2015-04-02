<script>
$(document).ready(function(){
    $("#edit-data").click(function(){
        EditData();
    });
            
    $("#discard-data").click(function(){
        confirmation_interruption();
        DiscardData();
    });
    
    $("#edit-data").jqxButton({ template: "success" });
    $("#discard-data").jqxButton({ template: "warning" });
});

</script>
<button id="edit-data">Edit</button>
<button id="discard-data" style="width: 80px;">Discard</button>