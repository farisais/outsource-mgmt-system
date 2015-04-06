<script>
$(document).ready(function(){
    $("#edit-data").click(function(){
        EditData();
    });
            
    $("#discard-data").click(function(){
        confirmation_interruption();
        DiscardData();
    });
    
    $("#validate-data").click(function(){
        confirmation_interruption();
        ValidateData();
    });
    
    $("#edit-data").jqxButton({ template: "success" });
    $("#discard-data").jqxButton({ template: "warning" });
    $("#validate-data").jqxButton({ template: "primary" });
});

</script>
<button id="edit-data">Edit</button>
<button id="discard-data" style="width: 80px;">Discard</button>
<button id="validate-data" style="width: 80px;">Validate</button>