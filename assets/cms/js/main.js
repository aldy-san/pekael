/**
 * Template Name: NiceAdmin
 * Updated: Nov 17 2023 with Bootstrap v5.3.2
 * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
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

	const datatables = select(".datatable", true);
	datatables.forEach((datatable) => {
		new simpleDatatables.DataTable(datatable, {
			perPageSelect: [5, 10, 15, ["All", -1]],
			classes: {
				selector: "form-select",
				input: "form-control",
			},
		});
	});
})();
