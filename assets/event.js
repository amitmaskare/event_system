function appendCurrentCell(rowId) {
	var checkLength = $("#quotaTable tr").length;
	var lastRow = checkLength + 1;

	$("#deleteLast").prop("disabled", false);
	var html = "";
	html += `<tr id="row${lastRow}">
					<td><select name="quota_role[]" class="form-control" required>
												  <option value="">Select</option>
                                                <option value="employee">Employee</option>
                                                <option value="manager">Manager</option>
                                                <option value="director">Director</option>
                                                <option value="external">External</option>
											</select></td>
                    <td> <input type="text" class="form-control" name="max_participants[]" required></td>
                    <td>
                      <a href="javascript:void(0);" class="btn btn-sm btn-info mr-2" onclick="appendCurrentCell(${lastRow});">Add</a>
                      <a href="javascript:void(0);" onclick="deleteCurrentCell(${lastRow});" class="btn btn-sm btn-danger"> Remove</a>
                    </td>
                  </tr>`;
	$("#quotaTable").append(html);
}

function deleteCurrentCell(rowId) {
	var checkLength = $("#quotaTable tr").length;
	if (checkLength > 1) {
		$("#deleteLast").prop("disabled", false);
		$("#row" + rowId).remove();
	} else {
		$("#deleteLast").prop("disabled", true);
	}
}

function appendForm(rowId) {
	var checkLength = $("#formTable tr").length;
	var lastRow = checkLength + 1;

	$("#deleteLastform").prop("disabled", false);
	var html = "";
	html += `<tr id="formrow${lastRow}">
					<td><input type="text" class="form-control" name="label[]" required></td>
										<td><input type="text" class="form-control" name="field_name[]" required></td>
										<td>
											<select name="field_type[]" class="form-control" required onchange="showOption(this.value,${lastRow})">
												<option value="">Select</option>
												<option value="text">Text</option>
												<option value="email">Email</option>
												<option value="number">Number</option>
												<option value="dropdown">Dropdown</option>
											</select>
										</td>
										<td id="optionField${lastRow}">
										</td>
										<td>
											<select name="required[]" class="form-control">
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
										</td>
                    <td>
                      <a href="javascript:void(0);" class="btn btn-sm btn-info mr-2" onclick="appendForm(${lastRow});">Add</a>
                      <a href="javascript:void(0);" onclick="deleteForm(${lastRow});" class="btn btn-sm btn-danger"> Remove</a>
                    </td>
                  </tr>`;
	$("#formTable").append(html);
}

function deleteForm(rowId) {
	var checkLength = $("#formTable tr").length;
	if (checkLength > 1) {
		$("#deleteLastform").prop("disabled", false);
		$("#formrow" + rowId).remove();
	} else {
		$("#deleteLastform").prop("disabled", true);
	}
}

function appendBand(rowId) {
	var checkLength = $("#bandTable tr").length;
	var lastRow = checkLength + 1;

	$("#deleteLastband").prop("disabled", false);
	var html = "";
	html += `<tr id="bandrow${lastRow}">
					 <td><input type="text" class="form-control" name="band_order[]" required>
                                        </td>
                                        <td>
                                        <select name="band_role[]" class="form-control" required>
                                                <option value="">Select</option>  
                                                <option value="manager">Manager</option>
                                                <option value="director">Director</option>         
                                            </select>
                                            </td>
                    <td>
                      <a href="javascript:void(0);" class="btn btn-sm btn-info mr-2" onclick="appendBand(${lastRow});">Add</a>
                      <a href="javascript:void(0);" onclick="deleteBand(${lastRow});" class="btn btn-sm btn-danger"> Remove</a>
                    </td>
                  </tr>`;
	$("#bandTable").append(html);
}

function deleteBand(rowId) {
	var checkLength = $("#bandTable tr").length;
	if (checkLength > 1) {
		$("#deleteLastband").prop("disabled", false);
		$("#bandrow" + rowId).remove();
	} else {
		$("#deleteLastband").prop("disabled", true);
	}
}

function showOption(val, i) {
	if (val == "dropdown") {
		var optionField = `<input type="text" class="form-control" name="field_options[]" required>`;
		$("#optionField" + i).html(optionField);
	} else {
		$("#optionField" + i).html("");
	}
}
