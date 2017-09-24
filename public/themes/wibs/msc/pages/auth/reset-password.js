$(document).ready(function() {

	$('#close__button').on('click', function(event) {
		event.preventDefault()
		clearErrorMessage()
	    resetForm()
	})

	$('#FormChangePassword').on('submit',function(event) {
		event.preventDefault()

		var url = $('#FormChangePassword').attr('action')
		var data = $(this).serialize()


		$.ajax({

			type : "POST",
			dataType : "json",
			url : url,
			data : data,

			beforeSend: function(){
				$('#submit__button').prop("disabled", true)
                showLoading(true)
                clearErrorMessage()
            },

			success: function(data) {
				
				if (data.status == false) {
	                if(data.is_error_form_validation) {

	                    $.each(data.message, function(key, value){
	                        $('input[name="' + key.replace(".", "_") + '"]').focus();
	                        $("#form--error--message--" + key.replace(".", "_")).text(value)
	                        
	                    });

	                } else {
	                    pushNotif(data.status, data.message);
	                }
	            } else {
	                resetForm()
	                pushNotif(data.status, data.message);
	                $('#close__button').click();
	            }
			},
            complete: function(response){
                hideLoading()
                $('#submit__button').prop("disabled", false)
            }
		});
	});

	function clearErrorMessage(){
        $(".form--error--message").text('')
    }

    function resetForm(){
        $("#old_password").val('')
        $("#new_password").val('')
        $("#confirm_password").val('')
    }
});