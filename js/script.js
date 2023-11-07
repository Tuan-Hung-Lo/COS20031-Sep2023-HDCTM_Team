// ============= START MENU
$(document).ready(function () {
    $('.autoWidth').lightSlider({
        autoWidth: true,
        loop: true,
        onSliderLoad: function () {
            $('.autoWidth').removeClass('cS-hidden');
        }
    });
});
// ============= END MENU

// JOP OPPORTUNITIES FILTER COLLAPSE AND EXPAND
function toggle() {
	$(this).parent().next().slideToggle(); 
	if ($(this).html() == "Filter") {
		$(this).html("FFilter");
	} else {
		$(this).html("Filter");
	}
}