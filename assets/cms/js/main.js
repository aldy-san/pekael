(function () {
	"use strict";

	const select = (el, all = false) => {
		el = el.trim();
		if (all) {
			return [...document.querySelectorAll(el)];
		} else {
			return document.querySelector(el);
		}
	};
	const on = (type, el, listener, all = false) => {
		if (all) {
			select(el, all).forEach((e) => e.addEventListener(type, listener));
		} else {
			select(el, all).addEventListener(type, listener);
		}
	};
	if (select(".toggle-sidebar-btn")) {
		on("click", ".toggle-sidebar-btn", function (e) {
			select("body").classList.toggle("toggle-sidebar");
		});
	}

	const datatables = select(".datatable", true);
	datatables.forEach((datatable) => {
		new simpleDatatables.DataTable(datatable, {
			perPageSelect: false,
			classes: {
				selector: "form-select",
				input: "form-control",
			},
			labels: {
				perPage: "",
			},
		});
	});

	var needsValidation = document.querySelectorAll(".needs-validation");

	Array.prototype.slice.call(needsValidation).forEach(function (form) {
		form.addEventListener(
			"submit",
			function (event) {
				if (!form.checkValidity()) {
					event.preventDefault();
					event.stopPropagation();
				}

				form.classList.add("was-validated");
			},
			false
		);
	});
})();
