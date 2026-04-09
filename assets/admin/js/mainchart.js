

	$(document).ready(function () {
		var ctoptions = {// My store pi chart
			chart: {
				height: 380,
				renderTo: 'allmodule',
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false
			},
			title: {
				text: 'All Module',
				style: {
					fontWeight: 'normal',
					fontSize: '13px'
				}
			},
			tooltip: {
				pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
			},
			legend: {
				itemStyle: {
					color: '#777',
					fontWeight: 'normal',
					fontSize: '9px'
				}
			},
			credits: {
				enabled: false
			},
			plotOptions: {
				pie: {
					size: 200,
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true,
					point: {
						events: {
							click: function () {
								console.log('events');
								//window.location.href = "../my-store/";
							}
						}
					}
				}

			},
			series: [{
				type: 'pie',
				data: []
			}]
		}

		$.getJSON("../my-store/mypost.php", function (json) {
			console.log(json);
			ctoptions.series[0].data = json;
			chart = new Highcharts.Chart(ctoptions);
		});//My store Complete


	});