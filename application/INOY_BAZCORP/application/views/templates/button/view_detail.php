<script>
$(document).ready(function(){
   $("#view-detail").click(function(e){
        e.stopImmediatePropagation();
        ViewDetail();
    });
    
    $("#view-detail").jqxButton({ template: "success" });
});

</script>
<button id="view-detail" style="width: 100px;">View Detail</button>