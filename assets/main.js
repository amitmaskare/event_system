$(function () {
	const container = $("#formFields");
	if (!container.length) return;
	const fields = container.data("fields") || [];
	fields.forEach((f) => {
		const id = "field_" + f.id;
		const label = $("<label>").text(f.label + (f.required ? " *" : ""));
		let input;
		if (f.type === "dropdown") {
			input = $("<select>").attr("name", id);
			const opts = (f.options || "")
				.split(",")
				.map((s) => s.trim())
				.filter(Boolean);
			input.append($("<option>").val("").text("-- select --"));
			opts.forEach((o) => input.append($("<option>").val(o).text(o)));
		} else if (f.type === "textarea") {
			input = $("<textarea>").attr({ name: id, rows: 3 });
		} else if (f.type === "checkbox") {
			input = $("<input>").attr({ type: "checkbox", name: id, value: "1" });
		} else {
			input = $("<input>").attr({ type: f.type || "text", name: id });
		}
		if (f.required) input.attr("required", true);
		container.append(
			$('<div class="field">').append(label).append("<br/>").append(input)
		);
	});
});
