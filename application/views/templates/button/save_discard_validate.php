<script>
$(document).ready(function(){
   $("#save-data").click(function(e){
        e.stopImmediatePropagation();
        SaveData();
    });
            
    $("#discard-data").click(function(){
        confirmation_interruption();
        DiscardData();
    });
    
    $("#validate-data").click(function(){
        //confirmation_interruption();
        ValidateData();
    });
    
    $("#save-data").jqxButton({ template: "success" });
    $("#discard-data").jqxButton({ template: "warning" });
    $("#validate-data").jqxButton({ template: "primary" });
});

</script>
<button id="save-data">Save</button>
<button id="discard-data" style="width: 80px;">Discard</button>
<button id="validate-data" style="width: 80px;">Validate</button>