<div class="form-group">
    <label for="topic" class="sr-only">Topic</label>
    <label for="topic" class="help-block">Topic</label>
    <input type="text" placeholder="Topic" class="form-control" id="topic" name="topic" required>
</div>
<div class="form-group">
    <label for="dept" class="help-block">Department</label>
    <select name="dept" id="dept" class="form-control input-sm" aria-required="true" required="required">
        <optgroup label="Select department">
            <option value="">---</option>
            <?php
            /*Get all the departments from the database*/
            $query = "SELECT * FROM `departments` WHERE 1 ORDER BY `name`";
            $result = $db->querySQLi($query)->fetchAll(2);
            foreach($result as $depts => $dept)
            {
                echo "<option value='".$dept{'name'}."'>".ucfirst($dept{'name'})."</option>\n";
            }
            ?>
        </optgroup>
    </select>
</div>
<div class="form-group">
    <label for="msg" class="sr-only">Message</label>
    <textarea name="msg" id="msg" cols="30" placeholder="Message" rows="10" class="form-control"></textarea>
</div>
<div class="form-group">
    <label for="upload">You can upload:&ensp;
        <i class="fa fa-file-pdf-o">&ensp;</i>pdf&nbsp;
        <i class="fa fa-image">&ensp;</i>images.</label>
    <input type="file" multiple placeholder="Upload" name="upload" id="upload">
</div>
<hr>

<div class="form-group">
    <div class="col-md-6">
        <label for="timelimit" class="help-block">Set time Limit/expiry time: </label>
        <select name="timelimit" class="form-control" id="timelimit1" onchange="showOthers();disableLimit();"
                required="required"
                title="Time limit">
            <optgroup label="Set Time limit">
                <option value=""></option>
                <option value="week">1 week</option>
                <option value="month">1 month</option>
                <option value="year">1 year</option>
                <option value="others">Others</option>
            </optgroup>
        </select>


        <br>
        <div class="form-group">
            <div id="others_container" class="hidden">
                <input type="number" title="Manually set time limit" placeholder="Counts" name="timenum" id="timenum"
                       disabled class="form-control"
                       required min="1"/>
                <br>
                <select name="timelimit" id="timelimit2" class="form-control" required="required" disabled
                        title="Other time limit" aria-required="true">
                    <optgroup label="Period">
                        <option value="">---</option>
                        <option value="day">day(s)</option>
                        <option value="week">week(s)</option>
                        <option value="month">month(s)</option>
                        <option value="year">year(s)</option>
                    </optgroup>
                </select>

            </div>
            <p>Or specify an expiry date (mm/dd/yyyy).<br/> <i class="fa fa-info-circle text-danger"></i> This will
                override any timelimit specified above</p>
            <div class="form-group">
                <input type="date" name="period"
                       pattern="([1]*[0-2]*|([0]*[1-9]))\/([1-2]*[0-9]*|[3][0,1]|([0][1-9])){1,2}\/\d{4}"
                       onchange="disableLimit();"
                       id="timelimit3" class="form-control" placeholder="mm/dd/yyyy"/>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="urgent" class="help-block">Is it urgent?</label>
            <label for="urgent">Yes </label>
            <input type="radio" name="urgent" title="Urgency" value="yes" required>
            <label for="urgent">No </label>
            <input type="radio" name="urgent" title="Urgency" value="no" required>
        </div>
        <hr>
        <div class="form-group">
            <label class="help-block">Type of question</label>
            <label for="type">Assignment </label>
            <input type="radio" name="type" id="type" title="type of question" value="assignment" required/>
            <label for="type">Project </label>
            <input type="radio" name="type" id="type" title="type of question" value="project" required/>
        </div>
    </div>
    <div class="clearfix"></div>


</div>


<script type="text/javascript">
    others_container = document.getElementById("others_container");
    othernum = document.getElementById("timenum");
    timelimit1 = document.getElementById('timelimit1');
    timelimit2 = document.getElementById('timelimit2');
    timelimit3 = document.getElementById('timelimit3');
    // alert(timelimit1.value);
    function disableLimit() {
        if (timelimit3.value)
            timelimit1.setAttribute("disabled", "disabled");
        else {
            timelimit1.removeAttribute("disabled");
            if (timelimit1.value)
                timelimit3.setAttribute("disabled", "disabled");
            else
            {
                others_container.classList.add("hidden");
                timelimit3.removeAttribute("disabled");
            }
        }
    }

    function showOthers() {
        if (timelimit1.value)
            if (timelimit1.value === 'others') {
                others_container.removeAttribute("class");
                othernum.removeAttribute("disabled");
                timelimit2.removeAttribute("disabled");
                timelimit3.setAttribute("disabled", "disabled");
            }
            else {
                others_container.classList.add("hidden");
                othernum.setAttribute("disabled", "disabled");
                timelimit2.setAttribute("disabled", "disabled");
                timelimit3.removeAttribute("disabled");
            }
    }


</script>
