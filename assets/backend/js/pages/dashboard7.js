//[Dashboard Javascript]

//Project:	VoiceX Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';
	
	var plot = $.plot('#flotChart', [{
          data: flotSampleData3,
          color: '#38b8f2',
          lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.5 }]}
          }
        },{
          data: flotSampleData4,
          color: '#ec4b71',
          lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.5 }]}
          }
        }], {
    			series: {
    				shadowSize: 1,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 8
          },
    			yaxis: {
            			show: true,
    					min: 0,
    					max: 100,
            			ticks: [[0,''],[20,'20K'],[40,'40K'],[60,'60K'],[80,'80K']],
            			tickColor: 'rgba(255, 255, 255, 0.10)',
						font: {
							color: '#666666'
						  }
    			},
    			xaxis: {
            			show: true,
            			color: 'rgba(255, 255, 255, 0.10)',
            			ticks: [[25,'OCT 21'],[75,'OCT 22'],[100,'OCT 23'],[125,'OCT 24']],
						font: {
							color: '#666666'
						  }
          }
        });
	
		
	
		var options = {
            chart: {
                height: 470,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%'	
                },
            },
            dataLabels: {
                enabled: false
            },
			colors: ["#0fc48f", '#298eff'],
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            series: [{
                name: 'New User',
                data: [76, 85, 101, 98, 87, 105, 91]
            }, {
                name: 'Old User',
                data: [35, 41, 36, 26, 45, 48, 52]
            }],
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Set', 'Sun'],
            },
            fill: {
                opacity: 1

            },
			  legend: {
				position: 'top',
				horizontalAlign: 'left'
			  },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#userflow"),
            options
        );

        chart.render();
	
	
	// Counter
	
		$('.countnm').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).text()
			}, {
				duration: 5000,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
		});
	
		$('#users-1').circleProgress({
			startAngle: -Math.PI / 4 * 2,
			value: 0.85,
			size: 115,
			lineCap: 'round',
			fill: { color: '#7460ee' },
			reverse: false, 
			emptyFill: "#F3F6F9"
		});

		$('#users-2').circleProgress({
			startAngle: -Math.PI / 4 * 2,
			value: 0.75,
			size: 115,
			lineCap: 'round',
			fill: { color: '#36bea6' },
			reverse: false, 
			emptyFill: "#F3F6F9"
		});

		$('#users-3').circleProgress({
			startAngle: -Math.PI / 4 * 2,
			value: 0.5,
			size: 115,
			lineCap: 'round',
			fill: { color: '#2962FF' },
			reverse: false, 
			emptyFill: "#F3F6F9"
		});

		$('#users-4').circleProgress({
			startAngle: -Math.PI / 4 * 2,
			value: 0.3,
			size: 115,
			lineCap: 'round',
			fill: { color: '#f62d51' },
			reverse: false, 
			emptyFill: "#F3F6F9"
		});
	
	// Morris bar chart
    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Jan',
            a: 100,
            b: 90,
            c: 60
        }, {
            y: 'Feb',
            a: 75,
            b: 65,
            c: 40
        }, {
            y: 'Mar',
            a: 50,
            b: 40,
            c: 30
        }, {
            y: 'Apr',
            a: 75,
            b: 65,
            c: 40
        }, {
            y: 'May',
            a: 50,
            b: 40,
            c: 30
        }, {
            y: 'Jun',
            a: 75,
            b: 65,
            c: 40
        }, {
            y: 'Jul',
            a: 100,
            b: 90,
            c: 40
        },  ],
        xkey: 'y',
        ykeys: ['a', 'b', 'c'],
        labels: ['A', 'B', 'C'],
        barColors: ['#f62d51', '#36bea6', '#2962FF'],
        hideHover: 'auto',
        gridLineColor: 'transparent',
        resize: true,
        barSizeRatio: 0.9,
        barRadius: [0, 0, 0, 0],
    });
	
	//DONUT CHART
    var donut = new Morris.Donut({
      element: 'visitor',
      resize: true,
      colors: ["#4fc3f7", "#2962FF", "#f7941d", "#7460ee"],
      data: [
        {label: "Open", value: 40},
        {label: "Clicked", value: 18},
        {label: "Un-Open", value: 23},
        {label: "Bounced", value: 19}
      ],
      hideHover: 'auto'
    });
	
	
		
	$("#baralc").sparkline([32,24,26,24,32,26,40,34,22,24,22,24,34,32,38,28,36,36,40,38,30,34,38], {
		type: 'bar',
		height: '80',
		barWidth: 6,
		barSpacing: 4,
		barColor: '#ffbc34',
	});
	
	
	
	
  
	//dashboard_daterangepicker
	
	if(0!==$("#dashboard_daterangepicker").length) {
		var n=$("#dashboard_daterangepicker"),
		e=moment(),
		t=moment();
		n.daterangepicker( {
			startDate:e, endDate:t, opens:"left", ranges: {
				Today: [moment(), moment()], Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")], "Last 7 Days": [moment().subtract(6, "days"), moment()], "Last 30 Days": [moment().subtract(29, "days"), moment()], "This Month": [moment().startOf("month"), moment().endOf("month")], "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
			}
		}
		, a),
		a(e, t, "")
	}
	function a(e, t, a) {
		var r="",
		o="";
		t-e<100||"Today"==a?(r="Today:", o=e.format("MMM D")): "Yesterday"==a?(r="Yesterday:", o=e.format("MMM D")): o=e.format("MMM D")+" - "+t.format("MMM D"), n.find(".subheader_daterange-date").html(o), n.find(".subheader_daterange-title").html(r)
	}
	
}); // End of use strict



  
             

