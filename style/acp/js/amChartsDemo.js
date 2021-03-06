AmCharts.ready(function() {

	AmCharts.makeChart("barchart",
		{
			"type": "serial",
			"categoryField": "category",
			"colors": [
				"#1F2C36",
				"#418EC0 ",
				"#B0DE09",
				"#0D8ECF",
				"#2A0CD0",
				"#CD0D74",
				"#CC0000",
				"#00CC00",
				"#0000CC",
				"#DDDDDD",
				"#999999",
				"#333333",
				"#990000"
			],
			"startDuration": 1,
			"categoryAxis": {},
			"gridPosition": "start",
			"trendLines": [],
			"graphs": [
				{
					"balloonText": "[[title]] of [[category]]:[[value]]",
					"fillAlphas": 1,
					"id": "AmGraph-1",
					"title": "graph 1",
					"type": "column",
					"valueField": "column-1"
				},
				{
					"balloonText": "[[title]] of [[category]]:[[value]]",
					"fillAlphas": 1,
					"id": "AmGraph-2",
					"title": "graph 2",
					"type": "column",
					"valueField": "column-2"
				}
			],
			"guides": [],
			"valueAxes": [
				{
					"id": "ValueAxis-1",
					"title": "Axis title"
				}
			],
			"allLabels": [],
			"balloon": {},
			"legend": {
				"enabled": true,
				"useGraphSettings": true
			},
			"titles": [
				{
					"id": "Title-1",
					"size": 15,
					"text": "Chart Title"
				}
			],
			"dataProvider": [
				{
					"category": "category 1",
					"column-1": 8,
					"column-2": 5
				},
				{
					"category": "category 2",
					"column-1": 6,
					"column-2": 7
				},
				{
					"category": "category 3",
					"column-1": 2,
					"column-2": 3
				}
			]
		}
	);

	AmCharts.makeChart("barchartHor",
		{
			"type": "serial",
			"categoryField": "category",
			"rotate": true,
			"colors": [
				"#1F2C36",
				"#16a085",
				"#B0DE09",
				"#2980b9",
				"#2A0CD0",
				"#CD0D74",
				"#CC0000",
				"#00CC00",
				"#0000CC",
				"#DDDDDD",
				"#999999",
				"#333333",
				"#990000"
			],
			"startDuration": 1,
			"categoryAxis": {},
			"gridPosition": "start",
			"trendLines": [],
			"graphs": [
				{
					"balloonText": "[[title]] of [[category]]:[[value]]",
					"fillAlphas": 1,
					"id": "AmGraph-1",
					"title": "graph 1",
					"type": "column",
					"valueField": "column-1"
				},
				{
					"balloonText": "[[title]] of [[category]]:[[value]]",
					"fillAlphas": 1,
					"id": "AmGraph-2",
					"title": "graph 2",
					"type": "column",
					"valueField": "column-2"
				}
			],
			"guides": [],
			"valueAxes": [
				{
					"id": "ValueAxis-1",
					"title": ""
				}
			],
			"allLabels": [],
			"balloon": {},
			"legend": {
				"enabled": true,
				"useGraphSettings": true
			},
			"titles": [
				{
					"id": "Title-1",
					"size": 15,
					"text": "Chart Title"
				}
			],
			"dataProvider": [
				{
					"category": "category 1",
					"column-1": 8,
					"column-2": 5
				},
				{
					"category": "category 2",
					"column-1": 6,
					"column-2": 7
				},
				{
					"category": "category 3",
					"column-1": 2,
					"column-2": 3
				}
			]
		}
	);

	AmCharts.makeChart("linechart",
		{
			"type": "serial",
			"categoryField": "category",
			"colors": [
				"#c0392b",
				"#8e44ad",
				"#B0DE09",
				"#0D8ECF",
				"#2A0CD0",
				"#CD0D74",
				"#CC0000",
				"#00CC00",
				"#0000CC",
				"#DDDDDD",
				"#999999",
				"#333333",
				"#990000"
			],
			"startDuration": 1,
			"categoryAxis": {},
			"gridPosition": "start",
			"trendLines": [],
			"graphs": [
				{
					"balloonText": "[[title]] of [[category]]:[[value]]",
					"bullet": "round",
					"id": "AmGraph-1",
					"title": "graph 1",
					"type": "smoothedLine",
					"valueField": "column-1"
				},
				{
					"balloonText": "[[title]] of [[category]]:[[value]]",
					"bullet": "square",
					"id": "AmGraph-2",
					"title": "graph 2",
					"type": "smoothedLine",
					"valueField": "column-2"
				}
			],
			"guides": [],
			"valueAxes": [
				{
					"id": "ValueAxis-1",
					"title": "Axis title"
				}
			],
			"allLabels": [],
			"balloon": {},
			"legend": {
				"enabled": true,
				"useGraphSettings": true
			},
			"titles": [
				{
					"id": "Title-1",
					"size": 15,
					"text": "Chart Title"
				}
			],
			"dataProvider": [
				{
					"category": "category 1",
					"column-1": 8,
					"column-2": 5
				},
				{
					"category": "category 2",
					"column-1": 6,
					"column-2": 7
				},
				{
					"category": "category 3",
					"column-1": 2,
					"column-2": 3
				},
				{
					"category": "category 4",
					"column-1": 1,
					"column-2": 3
				},
				{
					"category": "category 5",
					"column-1": 2,
					"column-2": 1
				},
				{
					"category": "category 6",
					"column-1": 3,
					"column-2": 2
				},
				{
					"category": "category 7",
					"column-1": 6,
					"column-2": 8
				}
			]
		}
	);

	AmCharts.makeChart("areachart",
		{
			"type": "serial",
			"categoryField": "date",
			"pathToImages": "js/charts/amcharts/images/",
			"dataDateFormat": "YYYY",
			"theme": "default",
			"categoryAxis": {},
			"minPeriod": "YYYY",
			"parseDates": true,
			"chartCursor": {
				"enabled": true,
				"animationDuration": 0,
				"categoryBalloonDateFormat": "YYYY"
			},
			"chartScrollbar": {
				"enabled": true
			},
			"trendLines": [],
			"graphs": [
				{
					"fillAlphas": 0.7,
					"id": "AmGraph-1",
					"lineAlpha": 0,
					"title": "graph 1",
					"valueField": "column-1"
				},
				{
					"fillAlphas": 0.7,
					"id": "AmGraph-2",
					"lineAlpha": 0,
					"title": "graph 2",
					"valueField": "column-2"
				}
			],
			"guides": [],
			"valueAxes": [
				{
					"id": "ValueAxis-1",
					"title": "Axis title"
				}
			],
			"allLabels": [],
			"balloon": {},
			"legend": {
				"enabled": true
			},
			"titles": [
				{
					"id": "Title-1",
					"size": 15,
					"text": "Chart Title"
				}
			],
			"dataProvider": [
				{
					"date": "2001",
					"column-1": 8,
					"column-2": 5
				},
				{
					"date": "2002",
					"column-1": 6,
					"column-2": 7
				},
				{
					"date": "2003",
					"column-1": 2,
					"column-2": 3
				},
				{
					"date": "2004",
					"column-1": 4,
					"column-2": 3
				},
				{
					"date": "2005",
					"column-1": 2,
					"column-2": 1
				},
				{
					"date": "2006",
					"column-1": 3,
					"column-2": 2
				},
				{
					"date": "2007",
					"column-1": 4,
					"column-2": 8
				}
			]
		}
	);

	AmCharts.makeChart("piechart",
		{
			"type": "pie",
			"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
			"titleField": "category",
			"valueField": "column-1",
			"allLabels": [],
			"balloon": {},
			"legend": {
				"enabled": true,
				"align": "center",
				"markerType": "circle"
			},
			"titles": [],
			"dataProvider": [
				{
					"category": "category 1",
					"column-1": 8
				},
				{
					"category": "category 2",
					"column-1": 6
				},
				{
					"category": "category 3",
					"column-1": 2
				}
			]
		}
	);


	AmCharts.makeChart("donuthart",
		{
			"type": "pie",
			"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
			"depth3D": 3,
			"innerRadius": "40%",
			"colors": [
				"#0B84FE",
				"#8e44ad",
				"#f1c40f",
				"#FCD202",
				"#F8FF01",
				"#B0DE09",
				"#04D215",
				"#0D8ECF",
				"#0D52D1",
				"#2A0CD0",
				"#8A0CCF",
				"#CD0D74",
				"#754DEB",
				"#DDDDDD",
				"#999999",
				"#333333",
				"#000000",
				"#57032A",
				"#CA9726",
				"#990000",
				"#4B0C25"
			],
			"titleField": "category",
			"valueField": "column-1",
			"allLabels": [],
			"balloon": {},
			"legend": {
				"enabled": true,
				"align": "center",
				"markerType": "circle"
			},
			"titles": [],
			"dataProvider": [
				{
					"category": "category 1",
					"column-1": 8
				},
				{
					"category": "category 2",
					"column-1": 6
				},
				{
					"category": "category 3",
					"column-1": 2
				}
			]
		}
	);

});