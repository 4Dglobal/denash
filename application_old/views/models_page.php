<!-- Information Modal HTML -->
<div id="msg_popup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <i class="fa fa-2x fa-check text-success" aria-hidden="true">
              	&nbsp;<span id="operation_info"></span>
              </i>
            </div>
        </div>
    </div>
</div>


<!-- Modal HTML -->
<div id="myallModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="type_submit">Add</span> Employee Meeting</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" id="emp_meeting_submit">
	            <div class="modal-body">
                	<div class="form-group">
                		<label>Meeting</label>
                		<!-- <input id="meeting" type="text" name="meeting" class="form-control" required> -->
                        <select name="meeting[]" id="meeting" class="form-control" multiple style="height: 200px;" required>
                            <?php $sql = $this->db->query("SELECT * FROM users WHERE role='agent'")->result(); 
                                foreach ($sql as $value) {
                                echo "<option value='".$value->emp_id."'>".$value->name."</option>";
                            } ?>
                        </select>
                		<input type="hidden" id="emp_id" value="">
                	</div><br>
                	<div class="form-group">
                		<label>Date</label>
                		<input id="meeting_date" type="date" name="meeting_date" class="form-control" required>
                	</div>
                	<div class="form-group">
                		<label>Meeting With</label>
                        <select name="meeting_with" id="meeting_with" class="form-control" required>
                            <option value="">Select Host</option>
                            <?php $sql = $this->db->query("SELECT * FROM users WHERE role!='agent' AND role!='admin' ")->result(); 
                                foreach ($sql as $value) {
                                echo "<option value='".$value->emp_id."'>".$value->name."</option>";
                            } ?>
                        </select>
                	</div>
                	<div class="form-group">
                		<label>Meeting Type</label>
                		<input id='meeting_type' type="text" name="meeting_type" class="form-control" required>
                	</div>
                    <div class="form-group">
                        <label>Meeting Status</label>
                        <select name="meeting_status" id="meeting_status" class="form-control" required>
                            <option value="">Select Meeting Status</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>                                                                
                    </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	                <button type="submit" class="btn btn-primary">Save changes</button>
	            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div id="preScreenModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="type_submitpro">Add </span>Pre-Screening Marks</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" id="preScreenForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Employee Name:</label>
                        <select class="form-control" id="pre_add_emp_id" name="pre_add_emp_id" required>
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label>Aptitude: </label>
                        <input type="text" name="aptitude" id="aptitude" class="form-control" maxlength="3" required>
                    </div>

                    <div class="form-group">
                        <label>Group Discussion: </label>
                        <input type="text" name="group_diss" id="group_diss" class="form-control" maxlength="3" required>
                    </div>

                    <div class="form-group">
                        <label>Programming Round: </label>
                        <input type="text" name="program" id="program" class="form-control" maxlength="3" required>
                    </div>

                    <div class="form-group">
                        <label>Technical HR: </label>
                        <input type="text" name="technical" id="technical" class="form-control" maxlength="3" required>
                    </div>

                    <div class="form-group">
                        <label>General HR: </label>
                        <input type="text" name="general" id="general" class="form-control" maxlength="3" required>
                    </div>
                    <div>
                        <button class="btn btn-outline-success" type="submit" style="float: right;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal HTML -->
<div id="preScreenEditModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="type_submitpro">Edit Pre-Screening Marks</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" id="preScreenEditForm">       
                <div class="modal-body">
                    <div class="form-group">
                        <label><span id="labelAss"></span></label>
                        <input type="text" class="form-control" id="ass_mark" name="ass_mark" required="">
                        <input type="hidden" value="" id="emp_id_pre">
                        <input type="hidden" value="" id="ass_id_pre">
                    </div>                       
                    <div>
                        <button type="submit" class="btn btn-outline-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>