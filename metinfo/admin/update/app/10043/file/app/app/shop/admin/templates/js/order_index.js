/*!
 * remark (http://getbootstrapadmin.com/remark)
 * Copyright 2015 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */
$(document).ready(function($) {
	checkclick('#scoreLineToDay','income');
	$(document).on('click', '.checkchartist', function(e) {
		checkclick($('.chart-action li.active a').attr('href'),$(this).val());
	})
	/**/
	$(document).on('click', '.chart-action li a', function(e) {
        checkclick($(this).attr('href'),$("input[name='checkchartist']:checked").val());
	})

});
function checkclick(type,name){
	var series,axisy = { },labels,id=type.replace('#','');
	if(name=='order'){
		axisy = {
			onlyInteger: true
		}
	}
	switch (type) {
	  case "#scoreLineToDay":
		series = dayslotjson.income;
		if(name=='order')series = dayslotjson.order;
		labels = ["1", "2", "3", "4", "5", "6", "7","8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"];
		break;
	  case "#scoreLineToWeek":
			series = dayslotjson.weekincome;
			if(name=='order')series = dayslotjson.weekorder;
			labels = [ "周一", "周二", "周三", "周四", "周五", "周六","周日"];
		break;
	  case "#scoreLineToMonth":
			series = dayslotjson.monthincome;
			if(name=='order')series = dayslotjson.monthorder;
			labels = dayslotjson.monthdays;
		break;
	}
	chartist(id,labels,series,axisy);
}
function chartist(id,labels,series,axisy){
	var scoreChart = new Chartist.Line('#'+id, 
		{
			labels:labels,
			series: [
				series
			]
		},
		{
          fullWidth: true,
		  showArea: true,
          chartPadding: {
            right: 25
          },
		  axisY: axisy,
          plugins: [
            Chartist.plugins.tooltip()
          ],
          low: 0,
          height: 300
        }
	);	
	scoreChart.on('created', function(data) {
	  var defs = data.svg.querySelector('defs') || data.svg.elem('defs');
	  var width = data.svg.width();
	  var height = data.svg.height();

	  var filter = defs
		.elem('filter', {
		  x: 0,
		  y: "-10%",
		  id: 'shadow' + id
		}, '', true);

	  filter.elem('feGaussianBlur', { in : "SourceAlpha",
		stdDeviation: "8",
		  result: 'offsetBlur'
	  });
	  filter.elem('feOffset', {
		dx: "0",
		dy: "10"
	  });

	  filter.elem('feBlend', { in : "SourceGraphic",
		mode: "multiply"
	  });

	  return defs;
	}).on('draw', function(data) {
	  if (data.type === 'line') {
		data.element.attr({
		  filter: 'url(#shadow' + id + ')'
		});

	  } else if (data.type === 'point') {

		var parent = new Chartist.Svg(data.element._node.parentNode);
		parent.elem('line', {
		  x1: data.x,
		  y1: data.y,
		  x2: data.x + 0.01,
		  y2: data.y,
		  "class": 'ct-point-content'
		});
	  }
	  if (data.type === 'line' || data.type == 'area') {
		data.element.animate({
		  d: {
			begin: 1000 * data.index,
			dur: 1000,
			from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
			to: data.path.clone().stringify(),
			easing: Chartist.Svg.Easing.easeOutQuint
		  }
		});
	  }

	});	
}

(function(document, window, $) {
  'use strict';
  var Site = window.Site;
  $(document).ready(function($) {
	Site.run();
  });
})(document, window, jQuery);
