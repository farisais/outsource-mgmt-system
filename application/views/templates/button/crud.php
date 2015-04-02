<script>
$(document).ready(function(){
    $("#create-data").click(function(){
        CreateData();
    });
        
    $("#edit-data").click(function(){
        EditData();
    });

    $("#delete-data").click(function(){
        DeleteData()
    });

    $("#create-data").jqxButton({ template: "success" });
    $("#edit-data").jqxButton({ template: "warning" });
    $("#delete-data").jqxButton({ template: "danger" });
    
});
</script>
<button id="create-data">Create</button>
<button id="edit-data">Edit</button>
<button id="delete-data">Delete</button>