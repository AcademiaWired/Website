function checkBlur() {
	setTimeout(function () {
		if (document.activeElement != document.getElementById("sample3") &&
			document.activeElement != document.getElementById("sample4") &&
			document.activeElement != document.getElementById("sample5") &&
			document.activeElement != document.getElementById("sample6") &&
			document.activeElement != document.getElementById("scroll-tab-2")) {
				document.getElementById("scroll-tab-1").className = "mdl-tabs__panel tab-panel is-active";
				document.getElementById("scroll-tab-2").className = "mdl-tabs__panel tab-panel";
				
				document.getElementById("tab-1").className = "mdl-tabs__tab layout-tab is-active";
				document.getElementById("tab-2").className = "mdl-tabs__tab layout-tab";
		}
	}, 10);
}