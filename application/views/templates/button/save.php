<script>
$(document).ready(function(){
   $("#save-data").click(function(e){
        e.stopImmediatePropagation();
        SaveData();
    });
    $("#save-data").jqxButton({ template: "success" });
});

</script>
<button id="save-data" style="width: 60px;">Save</button>