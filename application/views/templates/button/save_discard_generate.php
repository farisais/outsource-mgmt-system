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
    
    $("#generate-data").click(function(){
        //confirmation_interruption();
        GenerateData();
    });
    
    $("#save-data").jqxButton({ template: "success" });
    $("#discard-data").jqxButton({ template: "warning" });
    $("#generate-data").jqxButton({ template: "primary" });
});

</script>
<button id="save-data">Save</button>
<button id="discard-data" style="width: 80px;">Discard</button>
<button id="generate-data" style="width: 80px;">Generate</button>