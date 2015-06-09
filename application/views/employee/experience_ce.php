<table class="table-form" style="margin: 20px; width: 90%;">
    <tr>
        <td colspan="4">
            <div class="row-color">
                <button id="add-experience">+</button>
                <button id="remove-experience">-</button>
                <span>Add Experience</span>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="experience-grid"></div>
        </td>
    </tr>
</table>
<div id="form-experience">
    <input type="hidden" id="exp-is-edit" value="false" />
    <input type="hidden" id="exp-row-edit" value="" />
    <div>Add Experience</div>
    <div style="padding: 10px;">
        <table class="table-form">
            <tr>
                <td class="label">
                    Company Name
                </td>
                <td>
                    <input id="company-name" type="text" class="field" />
                </td>
                <td class="label">
                    Company Phone
                </td>
                <td>
                    <input id="company-phone" type="text" class="field" />
                </td>
            </tr>
            <tr>
                <td class="label">
                    Company Address
                </td>
                <td colspan="3">
                    <textarea id="company-address" class="field" style="width: 99%; height: 80px"></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">
                    City
                </td>
                <td>
                    <div id="city"></div>
                </td>
                <td class="label">
                    
                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td class="label">
                    From
                </td>
                <td>
                    <div id="select-month-from"></div>
                    <div id="select-year-from"></div>
                </td>
                <td class="label">
                    To
                </td>
                <td>
                    <div id="select-month-to"></div>
                    <div id="select-year-to"></div>
                </td>
            </tr>
            <tr>
                <td class="label">
                    Posistion Began
                </td>
                <td>
                    <input id="entry-position" type="text" class="field" />
                </td>
                <td class="label">
                    Position End
                </td>
                <td>
                    <input id="last-position" type="text" class="field" />
                </td>
            </tr>
            <tr>
                <td class="label">
                    Type of Business
                </td>
                <td>
                    <input id="type-of-business" type="text" class="field" />
                </td>
                <td class="label">
                    Total Employee
                </td>
                <td>
                    <input id="total-employees" type="text" class="field" />
                </td>
            </tr>
            <tr>
                <td class="label">
                    Name of Supervisor
                </td>
                <td>
                    <input id="supervisor" type="text" class="field" />
                </td>
                <td class="label">
                    Name of Director
                </td>
                <td>
                    <input id="director-name" type="text" class="field" />
                </td>
            </tr>
            <tr>
                <td class="label">
                    Describe Your Responsibility
                </td>
                <td colspan="3">
                    <textarea id="responsibilities" class="field" style="width: 99%; height: 80px"></textarea>
                </td>
            </tr>
            <tr>
                <td class="label">
                    Reason for Leaving
                </td>
                <td>
                    <input id="reason-for-leaving" type="text" class="field" />
                </td>
                <td class="label">
                    Last Salary
                </td>
                <td>
                    <input id="last-salary" type="text" class="field" />
                </td>
            </tr>
            <tr>
                <td class="label">
                    Supervisor Phone
                </td>
                <td colspan="3">
                    <input id="supervisor-phone" type="text" class="field" style="display: inline; width: 40%" />
                    <input id="supervisor-can-be-contacted" type="checkbox" style="display: inline" />Can be contacted
                </td>
            </tr>
            <tr>
                <td class="label">
                    Other Facilities
                </td>
                <td colspan="3">
                    <textarea id="facilities" class="field" style="width: 99%; height: 80px"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button id="save-experience" style="width: 200px;">Add Experience</button>
                </td>
            </tr>
        </table>
    </div>
</div>