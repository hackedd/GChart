<?php
	error_reporting(E_ALL);

	function __autoload($class)
	{
		require_once("class." . $class . ".php");
	}
	
	$red = new GChartColor(0xFF, 0x00, 0x00);
	$blue = new GChartColor(0x00, 0x00, 0xFF);
	$green = new GChartColor(0x00, 0x99, 0x00);
	$green2 = new GChartColor(0x00, 0xCC, 0x00);
	$tred = new GChartColor(0xFF, 0x00, 0x00, 0x99);
	$trans = new GChartColor(0x00, 0x00, 0x00, 0x00);
	$white = new GChartColor(0xFF, 0xFF, 0xFF);
	
	$c = new GLineChart(600, 500);
	
	$a = array();
	$b = array();
	for ($i = 0; $i <= 630; $i += 10)
	{
		$a[] = sin($i / 100) + 0.5;
		$b[] = sin($i / 100) - 0.5;
	}
	
	$c->AddDataset($a);
	$c->AddDataset($b);
	
	$c->SetEncoding(GChartEncoder::ENCODING_TEXT);
	$c->SetMargin(0.10);
	$c->SetScale(GChartEncoder::SCALE_ALL);
	
	// Text Encoding with Scaling
	//$c->SetScale(GChartEncoder::SCALE_NONE);
	//$c->SetTextScaling(array(-1.5, 1.5, -1.5, 1.5));
	
	$c->AddChartColor($red);
	$c->AddChartColor($blue);
	
	$c->AddFillArea(new GChartFillArea(GChartFillArea::MODE_BETWEEN, $tred, 0, 1));
	$c->AddFillArea(new GChartFillArea(GChartFillArea::MODE_FROM_ZERO, new GChartColor("0000ff30"), 1, 0));

	//$fill = new GChartFill(GChartFill::AREA_BACKGROUND, GChartFill::TYPE_STRIPES, array($green, 0.10, $green2, 0.10));
	//$fill->SetAngle(45);
	//$c->AddFill($fill);
	
	$c->SetTitle("This\nIs A\nTest");
	$c->SetTitleColor($red);
	$c->SetTitleSize(20);
	
	$c->SetLegend(array("Sinus plus Delta", "Sinus minus Delta"));
	$c->SetLegendPosition(GChart::LEGEND_POS_BOTTOM);
	
	$ax = new GChartAxis("y");
	$ax->SetTickLength(-$c->GetWidth());
	$ax->SetRangeStart(-1.5);
	$ax->SetRangeEnd(1.5);
	$ax->ExpandRange($c->GetMargin());
	$ax->SetRangeStep(0.3);
	$c->AddAxis($ax);
	
	//$c->SetGrid(new GChartGrid(10, 100 / 18, 4, 4));
	
	//$c->AddMarker(new GChartMarker(GChartMarker::TYPE_X, $blue, 0, GChartMarker::Every(1, 25, 43), 5));
	$c->AddMarker(new GChartMarker(GChartMarker::TYPE_CIRCLE, $red, 1, 630 / 20, 20));
	
	$c->AddMarker(new GChartMarker(GChartMarker::TYPE_AT . GChartMarker::TYPE_DIAMOND, $green, 0, GChartMarker::At(0.5, 0.5), 20));
	
	//$c->AddMarker(new GChartMarker(GChartMarker::TYPE_RANGE_V, $blue, 0, 0, 0.15));
	
	$ls = array();
	$ls[] = new GChartLineStyle(5, 5, 5);
	$ls[] = new GChartLineStyle(1, 10, 10);
	$c->SetLineStyles($ls);
	
	printf("<h1>LineChart</h1>\n<p>\n%s\n</p>\n\n", $c->Render());


	$bc = new GBarChart(1000, 300);
	$bc->SetType(GChart::TYPE_BARCHART_V_GROUPED);
	$bc->AddDataset($a);
	$bc->AddDataset($b);

	$bc->AddChartColor($red);
	$bc->AddChartColor($blue);
	
	printf("<h1>BarChart</h2>\n<p>\n%s\n</p>\n\n", $bc->Render());
?>
