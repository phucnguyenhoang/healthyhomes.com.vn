$(function() {
	var baseUrl = $('#hidBaseUrl').val();
	$('[data-toggle="popover"]').popover({
		html: true,
		trigger: 'hover',
		delay: { "hide": 500 },
		template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
		title: function() {
          var title = $(this).attr("data-custom-content");
          return $(title).find('.pan-pop-title').html();
        },
		content: function() {
          var content = $(this).attr("data-custom-content");
          return $(content).find('.pan-pop-content').html();
        }
	});

	$('.nav-menu').on('mouseenter', function(e) {
		if(window.innerWidth < 992) return false;

		$(this).find('.sub-menu').first().addClass('show');
	});
	$('.nav-menu').on('mouseleave', function(e) {
		if(window.innerWidth < 992) return false;

		$(this).find('.sub-menu').first().removeClass('show');
	});
	$('#btnMenu').on('click', function(e) {
		e.stopPropagation();
		$('.nav-bar').toggleClass('show');
	});

	$(document).on('click', function(e) {
		if (!$(e.target).closest('.nav-bar, #btnMenu, .nav-touch-cta').length) {
			$('.nav-bar').removeClass('show');
		}
	});
	$('.nav-bar .fas').on('click', function(e) {
		e.stopPropagation();
		e.preventDefault();
		$(this).closest('.nav-menu').find('.sub-menu').first().toggleClass('show');
	});
	$('.nav-bar a').on('click', function(e) {
		$(this).toggleClass('active');
	});

	$('.img-videos').on('click', function(e) {
		var modal = $('#modalVideo'),
			src = $(this).data('target');

		modal.find('iframe').attr('src', src);
		modal.modal('show');
	});
	$('#modalVideo button').on('click', function () {
        $('#modalVideo iframe').removeAttr('src');
    });

    $('.ct-pan-left-nav').on('click', 'a', function(e) {
    	e.preventDefault();
    	if ($(this).hasClass('active')) {
    		return false;
    	}
    	
    	var target = $(this).attr('href'),
    		contentLeft = $('.ct-pan-left-nav'),
    		contentRight = $('.ct-pan-content-right');
		
    	$('.ct-pan-left-nav a.active').removeClass('active');
    	$(this).toggleClass('active');

    	contentRight.find('.collapse').collapse('hide');
    	contentRight.find('.collapse.' + target).collapse('show');

    	contentLeft.find('.collapse').collapse('hide');
    	contentLeft.find('.collapse.' + target).collapse('show');
    });

    $('#panQAContent').on('click', 'button.btn-link', function(e) {
    	var currSquare = $(this).find('span').hasClass('fa-plus-square');
    	console.log(currSquare);
    	if (currSquare) {
    		$('#panQAContent').find('span.fa-minus-square').removeClass('fa-minus-square').addClass('fa-plus-square');
    		$(this).find('span.fa-plus-square').removeClass('fa-plus-square').addClass('fa-minus-square');
    	} else {
    		e.preventDefault();
    		return false;
    	}
    });

    $('#modalStar').on('shown.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id'),
            panStarDetail = $('#modalStar .modal-body');

        showLoading(panStarDetail);
        $.ajax({
            method: 'POST',
            url: baseUrl + 'chung-nhan/nguoi-noi-tieng/' + id,
            dataType: 'HTML',
            success: function(html) {
                removeLoading(panStarDetail);
                panStarDetail.html(html);
            },
            error: function(data) {
                removeLoading(panStarDetail);
                alert('Can not load content detail.');
            }
        });
    });
    
    $('#frmContactUs, #frmRequestDemo').on('submit', function (e) {
		e.preventDefault();
		
		const $form = $(this);
		if ($form.length === 0) return; // Ensure the form exists

		const buttonSubmit = $form.find('button[type="submit"]');
		const formData = new FormData($form[0]);
		const $body = $('body');

		// Verify reCAPTCHA
		const recaptchaResponse = formData.get('g-recaptcha-response');
		if (!recaptchaResponse) {
			showToast('Please confirm you are not a robot.', 'error');
			return;
		}
		
		// Disable the submit button to prevent multiple submissions
		buttonSubmit.prop('disabled', true);

		// show loading state
		showLoading($body);

		fetch($form[0].action, {
			method: 'POST',
			body: formData,
		})
			.then(response => response.json())
			.then(data => {
				if (data.status === 'success') {
					showToast(data.message);
					$form[0].reset(); // Reset the form on success
				} else {
					showToast(data.message || 'An error occurred. Please try again.', 'error');
				}
			})
			.catch(error => {
				showToast('An unexpected error occurred.', 'error');
			})
			.finally(() => {
				// Re-enable the submit button after the request is complete
				buttonSubmit.prop('disabled', false);
				// remove loading state
				removeLoading($body);
			});
	});
});

function showLoading(target) {
    var loading = $('<div class="loading"></div>');

    target.find('.loading').remove();
    target.find('.alert').remove();

    target.append(loading);
}

function removeLoading(target) {
    target.find('.loading').remove();
    target.find('.alert').remove();
}

/**
 * Show a toast notification in the bottom right corner of the page and hide it after a few seconds.
 * @param {string} message - The message to display in the toast notification.
 * @param {string} type - The type of the toast notification (e.g., 'success', 'error').
 */
function showToast(message, type = 'success') {
	const toast = document.createElement('div');
	toast.className = `toast ${type}`;
	toast.innerText = message;

	document.body.appendChild(toast);

	setTimeout(() => {
		toast.classList.add('fade-out');
	}, 3000);

	toast.addEventListener('transitionend', () => {
		toast.remove();
	});
}