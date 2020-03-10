(function() {
	var lightbox = {};
		circleTakesTheSquare();
	var jtn = $('#journalist-truthiness').val();
	var ptn = $('#publication-truthiness').val();

	var gaugeSettings = {
				width: 400,
				height: 150,
				minValue: 0,
				maxValue: 100,
				valueBox: false,
				majorTicks: ["Relegated","Bottler","Centre Spot","Break","Champ"],
				minorTicks: 4,
				strokeTicks: true,
				ticksWidth: 20,
				ticksWidthMinor: 10,
				colorPlate: "#fff",
				needleType: "arrow",
				borders: false,
				borderShadowWidth: 0,
				borderRadius: 10,
				needleWidth: 5,
				highlights: [
	        		{from: 75, to: 100, color: "#7fad41"},
	        		{from: 25, to: 75, color: "#2c9f9f"},
	        		{from: 0, to: 25, color: "#d12931"}
	    		],
	    		highlightsWidth: 40,
	    		animation: true,
	    		animationDuration: 1000,
	    		animateOnInit: true,
	    		barProgress: false,
	    		barWidth: 0,
	    		barBeginCircle: false,
	    		tickSide: "right",
	    		ticksWidth: 50,
	    		needleSide: "right",
	    		needleShadow: true,
	    		numberSide: "right",
	    		numbersMargin: 5,
	    		fontNumbers: "Assistant"
			};
			$('#search-input').on('blur', function() {
				console.log("Firing blur");
				$('div.lazyjourno-search-inputs').addClass('search-inputs-closing').removeClass('search-inputs-active');
				setTimeout(() => {
					$('div.lazyjourno-search-inputs').removeClass('search-inputs-closing');
				},200);
			})

	$('i.search-inputs-icon').on('click', function() {
		var searchbox = $(this).closest('form').find('input[type=search]');
		if (!$('div.lazyjourno-search-inputs').hasClass('search-inputs-closing')) {
		var el = $('div.lazyjourno-search-inputs');
		$(el).addClass('search-inputs-active');
			var lg = $(searchbox).val().length;
			$(searchbox).focus();
			searchbox[0].setSelectionRange(lg, lg);
		}
	});

	$('#lightbox-close').on('click', function() {
		$('.lightbox-element').removeClass('active');
		scrollUnlock();
	})

	$('a.dropdown-click').on('click', function() {
		$('div.dropdown-menu').slideToggle('fast');
	})

	$('#horizontal-subscribe-submit, #vertical-subscribe-submit').on('click', function() {
		var prefix = $(this).data('prefix');
		$('.lightbox-element').addClass('active');
		scrollLock();
		var name = $(`#${prefix}-name`).val();
		var email = $(`#${prefix}-email`).val();
		subscribeLightbox(name,email);
		$('.es_shortcode_form').find('input[type=text]').filter(":visible:enabled").first().focus();
	})

	checkGauge();

	function checkGauge() {
		if (jtn) {
			gaugeSettings.renderTo = "journalist-truthiness-gauge";
			gaugeSettings.value = jtn;
			var jgauge = new LinearGauge(gaugeSettings);
			jgauge.draw();
		}
		if (ptn) {
			gaugeSettings.renderTo = "publication-truthiness-gauge";
			gaugeSettings.value = ptn;
			var pgauge = new LinearGauge(gaugeSettings);
			pgauge.draw();
		}
	}

	function circleTakesTheSquare() {
		function calculateSquareHeight() {

		    var holder = $('#desktop-sponsor #sponsor-logo').get(0);
		    var thumbs = document.getElementsByClassName('loop-thumbnail');

		    if (holder) {
			    var sqWidth = holder.offsetWidth;
			    holder.style.height = sqWidth + 'px';
			}

		    for (let i = 0; i < thumbs.length; i++) {
		    	var sqW = thumbs[i].offsetWidth;
		    	thumbs[i].style.height = sqW + 'px';
		    }
		}

		window.addEventListener('load', calculateSquareHeight, false);
		window.addEventListener('resize', calculateSquareHeight, false);
	}

	function scrollLock() {
		if ( $(document).height() > $(window).height() )
			{
			var htmlNode = $("html");
			var bodyNode = $("body");
			var oldWidth = htmlNode.innerWidth();
			lightbox.OriginalLeft = bodyNode.css( "left" );
			lightbox.OriginalTop = bodyNode.css( "top" );
			lightbox.OriginalScrollTop = htmlNode.scrollTop() ? htmlNode.scrollTop() : bodyNode.scrollTop(); // Works for Chrome, Firefox, IE...

			bodyNode.addClass( "lightbox__scroll-lock" );
			bodyNode.css( "top", -lightbox.OriginalScrollTop );

			var newWidth = htmlNode.innerWidth();
			bodyNode.css( "left", ( oldWidth - newWidth ) + "px" );
		}
	}

	function scrollUnlock() {
		var bodyNode = $( "body" );
		bodyNode.removeClass( "lightbox__scroll-lock" );
		bodyNode.css( "left", lightbox.OriginalLeft );
		bodyNode.css( "top", lightbox.OriginalTop );
		$( "html,body" ).scrollTop( lightbox.OriginalScrollTop );
	}

	function subscribeLightbox(name,email) {
		$('#es_txt_name').val(name);
		$('#es_txt_email').val(email);
	}
})()