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
    
    $("#import-data").click(function(){
        ImportData()
    });

    $("#create-data").jqxButton({ template: "success" });
    $("#edit-data").jqxButton({ template: "warning" });
    $("#delete-data").jqxButton({ template: "danger" });
    $("#import-data").jqxButton({ template: "primary" });
    
});
</script>
<button id="create-data">Create</button>
<button id="edit-data">Edit</button>
<button id="delete-data">Delete</button>
<button id="import-data">Import</button>