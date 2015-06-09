<table class="table-form" style="margin: 20px; width: 90%;">
    <tr>
        <td colspan="4">
            <div class="row-color">
                <button id="add-education">+</button>
                <button id="remove-education">-</button>
                <span>Add Education</span>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="education-grid"></div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div class="row-color"> 
                <button id="add-course">+</button>
                <button id="remove-course">-</button>
                <span>Add Course</span>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="course-grid"></div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div class="row-color">
                <button id="add-language">+</button>
                <button id="remove-language">-</button>
                <span>Add Language</span>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="language-grid"></div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div class="row-color">
                <button id="add-social">+</button>
                <button id="remove-social">-</button>
                <span>Add Social Activity</span>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <div id="social-grid"></div>
        </td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td class="label" style="width: 30px;">
            Hobbies
        </td>
        <td colspan="3">
            <textarea class="field" style="width: 99%; height: 80px;" id="hobbies"><?php echo (isset($is_edit) ? $data_edit[0]['hobbies'] : '') ?></textarea>
        </td>
    </tr>
</table>