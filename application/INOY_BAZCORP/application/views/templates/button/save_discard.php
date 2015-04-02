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
    
    $("#save-data").jqxButton({ template: "success" });
    $("#discard-data").jqxButton({ template: "warning" });
});

</script>
<button id="save-data">Save</button>
<button id="discard-data" style="width: 80px;">Discard</button>