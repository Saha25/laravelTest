$(document).ready(function(){
    $('body').on('click', '.ajaxSubmit', function(e) {
    	ajaxSubmit($('#' + $(this).attr('data-submit')));
    	e.preventDefault();
    	return false;
    });

    $('#hideDone').on('click', function() {
        var now = new Date;
        now.setYear(now.getFullYear() + 4);
        document.cookie = "doneIsHidden=1; expires=" + now;
        $('[data-done="true"]').addClass('hidden');
        $('#showDone').show();
        $(this).hide();
    });

    $('#showDone').on('click', function() {
        document.cookie = 'doneIsHidden=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        $('[data-done="true"]').removeClass('hidden');
        $('#hideDone').show();
        $(this).hide();
    });
});

function ajaxSubmit(form) {
	var url = form.attr('data-url'),
		data = form.serialize();

	$.ajax({
	    url: url,
	    data: data,
	    type: 'POST',
	    context: document.body,
	    success: function(response) {
	    	$('#' + form.attr('data-response')).html(response);
	    }
	});
}