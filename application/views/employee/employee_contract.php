<table class="table-form" style="margin: 20px; width: 90%;">
    <tr>
        <td class="label">
            Contract Number
        </td>
         <td colspan="3">
            <input style="display: inline; width: 70%" type="text" class="field" id="contract-number" value="<?php echo (isset($is_edit) ? $employee_contract[0]['contract_number'] : '') ?>"/><button style="margin-left: 2px;" id="auto-generate">></button>
            <input type="checkbox" style="display:inline" />Save Draft
        </td>
    </tr>
    <tr>
       <td class="label">
            Join Date
        </td>
         <td>
            <div id="join-date"></div>
        </td>
        <td class="label second-column">
            End Date
        </td>
         <td>
            <div id="end-date"></div>
        </td> 
    </tr>
    <tr>
        <td class="label">
            Position
        </td>
         <td>
            <div id="position"></div>
        </td>
        <td class="label second-column">
            Level
        </td>
         <td>
            <div id="position-level"></div>
        </td> 
    </tr>
    
    <tr>
        <td class="label">
            Contract Type
        </td>
         <td colspan="3">
            <div id="contract-type"></div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div class="row-color">
                <button id="add-phase">+</button>
                <button id="remove-phase">-</button>
                <span>Contract Phase</span>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="contract-phase-grid"></div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div class="row-color">
                <button id="add-contract">+</button>
                <button id="remove-contract">-</button>
                <span>Contract Document</span>
                <input type="file" style="display:none;" id="contract-file">
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="contract-document-grid"></div>
        </td>
    </tr>
</table>
<div id="phase-add-window">
    <div>Add Phase</div>
    <div>
        <table class="table-form">
            <tr>
                <td style="width: 80%" colspan="2">
                    <div id="select-phase-type-grid"></div>
                </td>
            </tr>
        </table>
    </div>
</div>