<script>
    $(document).ready(function(){
        $("#discard-data").click(function(){
            confirmation_interruption();
            DiscardData();
        });
        $("#discard-data").jqxButton({ template: "warning" });
    });

</script>
<button id="discard-data" style="width: 80px;">Discard</button>