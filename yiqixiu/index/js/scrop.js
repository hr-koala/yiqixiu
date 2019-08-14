$(function() {
	if ($(document).scrollTop() > 0 && $(document).scrollTop() < 43) {
		$('.header-fixed').addClass('header-opacity');
		//debugger;
		$('.header-shadow').hide()
	} else if ($(document).scrollTop() > 0) {
			//	debugger;
		$('.header-fixed').removeClass('header-opacity');
		$('.header-shadow').show();
		$('.shortcut .gotop').slideDown()
	} else {
			
			
			//debugger;
		$('.header-fixed').addClass('header-opacity');
		$('.header-shadow').hide()
	}
	 
	 // slider70(); //hcc  2015-7-29
	$('#family li img').lazyload({
		event: 'turnPage',
		effect: 'fadeIn'
	});
	$('.partners-page').jPages({
		containerID: 'family',
		animation: 'fadeInUp',
		callback: function(a, b) {
			b.showing.find('img').trigger('turnPage');
			b.oncoming.find('img').trigger('turnPage')
		}
	});
	 
	initShortcut();
	//initSms();
	setTimeout(function() {
		$('#shadow').hide()
	}, 100)
});
var duration = 600;
$(window).scroll(function() {
	if ($(document).scrollTop() > 0 && $(document).scrollTop() < 43) {
		$('.header-fixed').addClass('header-opacity');
		$('.header-shadow').hide();
		$('.shortcut .gotop').slideUp()
	} else if ($(document).scrollTop() > 0) {
		$('.header-fixed').removeClass('header-opacity');
		$('.header-shadow').show();
		$('.shortcut .gotop').slideDown()
	} else {
		$('.header-fixed').addClass('header-opacity');
		$('.header-shadow').hide();
		$('.shortcut .gotop').slideUp()
	}
  /*	if ($(document).scrollTop() - $(".item1").position().top >= -300) {
		$(".item1 .a1").animate({
			opacity: 1
		}, 500, function() {
			$(".item1 .a2").animate({
				top: "100px",
				opacity: 1
			}, 250);
			$(".item1 .a3").animate({
				top: "-50px",
				opacity: 1
			}, 500);
			$(".item1 .a4").animate({
				top: "239px",
				opacity: 1
			}, 750);
			$(".item1 .a5").animate({
				top: "79px",
				opacity: 1
			}, 1000, function() {
				$(".item1 .a4").hide();
				$(".item1 .a6").animate({
					top: "219px",
					opacity: 1
				}, 200, function() {
					$(".item1 .a7").animate({
						top: "222px",
						opacity: 1
					}, 200, function() {
						$(".item1 .a8").animate({
							top: "153px",
							opacity: 1
						}, 200)
					})
				})
			})
		})
	}
	if ($(document).scrollTop() - $(".item2").position().top >= -300) {
		$(".item2 .a1").animate({
			top: "80px",
			opacity: 1
		}, duration, function() {
			$(".item2 .a3").animate({
				top: "230px",
				opacity: 1
			}, 100);
			$(".item2 .a4").animate({
				top: "-80px",
				opacity: 1
			}, 200);
			$(".item2 .a5").animate({
				top: "245px",
				opacity: 1
			}, 300);
			$(".item2 .a6").animate({
				top: "228px",
				opacity: 1
			}, 400);
			$(".item2 .a7").animate({
				top: "176px",
				opacity: 1
			}, 500);
			$(".item2 .a8").animate({
				top: "297px",
				opacity: 1
			}, 600);
			$(".item2 .a9").animate({
				top: "247px",
				opacity: 1
			}, 700);
			$(".item2 .a10").animate({
				top: "126px",
				opacity: 1
			}, 800)
		});
		$(".item2 .a2").animate({
			top: "140px",
			opacity: 1
		}, duration)
	}
	if ($(document).scrollTop() - $(".item3").position().top >= -300) {
		$(".item3 .a1").animate({
			top: "75px",
			opacity: 1
		}, duration, function() {
			$(".item3 .a2").animate({
				top: "75px",
				opacity: 1
			}, duration, function() {
				$(".item3 .a3").animate({
					top: "73px",
					opacity: 1
				}, duration)
			})
		})
	}
	if ($(document).scrollTop() - $(".item4").position().top >= -300) {
		$(".item4 .a1").animate({
			top: "257px",
			opacity: 1
		}, duration, function() {
			$(".item4 .a2").animate({
				top: "368px",
				opacity: 1
			}, duration, function() {
				$(".item4 .a3").animate({
					left: "293px",
					top: "124px",
					opacity: 1
				}, 250);
				$(".item4 .a4").animate({
					left: "139px",
					top: "295px",
					opacity: 1
				}, 500);
				$(".item4 .a5").animate({
					left: "233px",
					top: "186px",
					opacity: 1
				}, 750);
				$(".item4 .a6").animate({
					left: "164px",
					top: "107px",
					opacity: 1
				}, 1000);
				$(".item4 .a7").animate({
					left: "54px",
					top: "206px",
					opacity: 1
				}, 1250);
				$(".item4 .a8").animate({
					left: "456px",
					top: "287px",
					opacity: 1
				}, 1500, function() {
					$(".item4 .a9").animate({
						top: "300px",
						opacity: 1
					}, 100, function() {
						$(".item4 .a9").fadeOut(function() {
							$(".item4 .a9").fadeIn()
						})
					})
				})
			})
		})
	} */
});
function slider70(){
 $('.slide').slider({
		autoRollingTime: 10000,
		bgSpeed: 500,
		motion: {
			'a1-1': {
				left: -384,
				opacity: 0,
				speed: 1000,
				delay: 500
			},
			'a1-2': {
				left: 931,
				opacity: 0,
				speed: 1000,
				delay: 1000
			},
			'a1-3': {
				left: 1116,
				opacity: 0,
				speed: 1000,
				delay: 1200
			},
			'a1-4': {
				left: 731,
				opacity: 0,
				speed: 1000,
				delay: 1400
			},
			'a2-1': {
				top: 679,
				opacity: 0,
				speed: 1000,
				delay: 500
			},
			'a2-2': {
				top: 679,
				opacity: 0,
				speed: 1000,
				delay: 800
			},
			'a2-3': {
				left: -1169,
				opacity: 0,
				speed: 1000,
				delay: 800
			},
			'a2-4': {
				opacity: 0,
				speed: 1000,
				delay: 1200
			},
			'a2-5': {
				opacity: 0,
				speed: 1000,
				delay: 1500
			},
			'a2-6': {
				opacity: 0,
				speed: 1000,
				delay: 1700
			},
			'a2-7': {
				top: 559,
				opacity: 0,
				speed: 1000,
				delay: 1800
			},
			'a2-8': {
				top: 559,
				opacity: 0,
				speed: 1000,
				delay: 2000
			},
			'a2-9': {
				top: 559,
				opacity: 0,
				speed: 1000,
				delay: 2200
			},
			'a2-10': {
				opacity: 0,
				speed: 1000,
				delay: 2400
			},
			'a2-11': {
				opacity: 0,
				speed: 1000,
				delay: 2600
			},
			'a2-12': {
				top: -60,
				opacity: 0,
				speed: 1000,
				delay: 2800
			},
			'a3-1': {
				top: 679,
				opacity: 0,
				speed: 1000,
				delay: 200
			},
			'a3-2': {
				left: -200,
				opacity: 0,
				speed: 1000,
				delay: 1000
			},
			'a3-3': {
				left: 824,
				opacity: 0,
				speed: 1000,
				delay: 1000
			},
			'a3-4': {
				left: -94,
				opacity: 0,
				speed: 500,
				delay: 1500
			},
			'a3-5': {
				opacity: 0,
				speed: 500,
				delay: 1600
			},
			'a3-6': {
				opacity: 0,
				speed: 500,
				delay: 1700
			},
			'a3-7': {
				opacity: 0,
				speed: 500,
				delay: 1800
			},
			'a3-8': {
				opacity: 0,
				speed: 500,
				delay: 1900
			},
			'a3-9': {
				opacity: 0,
				speed: 500,
				delay: 2000
			},
			'a3-10': {
				opacity: 0,
				speed: 500,
				delay: 2100
			},
			'a3-11': {
				opacity: 0,
				speed: 500,
				delay: 2200
			},
			'a3-14': {
				opacity: 0,
				speed: 1000,
				delay: 2300
			},
			'a3-15': {
				opacity: 0,
				speed: 1000,
				delay: 2400
			},
			'a3-23': {
				opacity: 0,
				speed: 500,
				delay: 2500
			},
			'a3-22': {
				opacity: 0,
				speed: 500,
				delay: 2600
			},
			'a3-21': {
				opacity: 0,
				speed: 500,
				delay: 2700
			},
			'a3-20': {
				opacity: 0,
				speed: 500,
				delay: 2800
			},
			'a3-19': {
				opacity: 0,
				speed: 500,
				delay: 2900
			},
			'a3-18': {
				opacity: 0,
				speed: 500,
				delay: 3000
			},
			'a3-17': {
				opacity: 0,
				speed: 500,
				delay: 3100
			},
			'a3-16': {
				opacity: 0,
				speed: 500,
				delay: 3200
			},
			'a3-12': {
				opacity: 0,
				speed: 500,
				delay: 3300
			},
			'a3-13': {
				opacity: 0,
				speed: 500,
				delay: 3400
			},
			'a4-1': {
				top: 679,
				opacity: 0,
				speed: 1000,
				delay: 200
			},
			'a4-2': {
				left: -200,
				opacity: 0,
				speed: 1000,
				delay: 1000
			},
			'a4-3': {
				left: 824,
				opacity: 0,
				speed: 1000,
				delay: 1000
			},
			'a4-4': {
				left: -94,
				opacity: 0,
				speed: 500,
				delay: 1500
			},
			'a4-5': {
				left: -60,
				opacity: 0,
				speed: 500,
				delay: 1500
			},
			'a5-1': {
				top: 679,
				opacity: 0,
				speed: 1000,
				delay: 500
			},
			'a5-2': {
				top: 679,
				opacity: 0,
				speed: 1000,
				delay: 800
			},
			'a5-3': {
				left: -1169,
				opacity: 0,
				speed: 1000,
				delay: 800
			},
			'a5-4': {
				opacity: 0,
				speed: 1000,
				delay: 1200
			},
			'a6-1': {
				top: 679,
				opacity: 0,
				speed: 1000,
				delay: 200
			},
			'a6-2': {
				left: -200,
				opacity: 0,
				speed: 1000,
				delay: 1000
			},
			'a6-3': {
				left: 824,
				opacity: 0,
				speed: 1000,
				delay: 1000
			},
			'a6-4': {
				left: -94,
				opacity: 0,
				speed: 500,
				delay: 1500
			},
			end: null
		}
	});
}