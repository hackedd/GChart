<?php
	error_reporting(E_ALL);

	function __autoload($class)
	{
		require_once("class." . $class . ".php");
	}
	
	$red = new GChartColor(0xFF, 0x00, 0x00);
	$blue = new GChartColor(0x00, 0x00, 0xFF);
	$green = new GChartColor(0x00, 0xFF, 0x00);
	$green2 = new GChartColor(0x00, 0xCC, 0x00);
	$tred = new GChartColor(0xFF, 0x00, 0x00, 0x99);
	$trans = new GChartColor(0x00, 0x00, 0x00, 0x00);
	$white = new GChartColor(0xFF, 0xFF, 0xFF);
	$yellow = new GChartColor(0xFF, 0xFF, 0x00);
	
	$c = new LineChart(600, 500);
	
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
	
	$c->SetTitle("This Is A Test");
	$c->SetTitleColor($red);
	$c->SetTitleSize(20);
	
	$c->SetLegend(array("Sinus plus Delta", "Sinus minus Delta"));
	$c->SetLegendPosition(GChart::LEGEND_POS_BOTTOM);
	
	$ax = new GChartAxis(GChartAxis::TYPE_Y);
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


	$bc = new BarChart(1000, 300);
	$bc->SetType(GChart::TYPE_BARCHART_V_GROUPED);
	$bc->AddDataset($a);
	$bc->AddDataset($b);

	$bc->AddChartColor($red);
	$bc->AddChartColor($blue);
	
	printf("<h1>BarChart</h2>\n<p>\n%s\n</p>\n\n", $bc->Render());
	
	$rc = new RadarChart(400, 400);
	$rc->AddDataset(range(0, 360, 45));
	$rc->AddDataset(range(360, 0, 45));
	$rc->AddChartColor($red);
	$rc->AddChartColor($blue);
	
	$ax = new GChartAxis(GChartAxis::TYPE_Y);
	$ax->SetRangeStart(0);
	$ax->SetRangeEnd(100);
	$ax->SetRangeStep(20);
	$rc->AddAxis($ax);
	
	$ax = new GChartAxis(GChartAxis::TYPE_X);
	$ax->SetLabels(array("N", "NE", "E", "SE", "S", "SW", "W", "NW"));
	$rc->AddAxis($ax);
	
	printf("<h1>RadarChart</h2>\n<p>\n%s\n</p>\n\n", $rc->Render());
	
	$sp = new ScatterPlot(400, 400);
	
	$x = array();
	$y = array();
	$s = array();
	for ($i = 0; $i < 30; $i += 1)
	{
		$x[] = rand(0, 100);
		$y[] = rand(0, 100);
		$s[] = rand(50, 100);
	}
	
	$sp->AddDataset($x);
	$sp->AddDataset($y);
	$sp->AddDataset($s);
	
	$ax = new GChartAxis(GChartAxis::TYPE_Y);
	$ax->SetRangeStart(0);
	$ax->SetRangeEnd(100);
	$ax->SetRangeStep(10);
	$sp->AddAxis($ax);
	
	$ax = clone $ax;
	$ax->SetType(GChartAxis::TYPE_X);
	$sp->AddAxis($ax);
	
	printf("<h1>ScatterPlot</h2>\n<p>\n%s\n</p>\n\n", $sp->Render());
	
	$vd = new VennDiagram(300, 300);
	
	$a = array();
	for ($i = 0; $i < 7; $i += 1)
		$a[] = rand(0, 100);
	rsort($a);
	
	$vd->AddDataset($a);
	$vd->SetLegend(array("A", "B", "C"));
	printf("<h1>VennDiagram</h2>\n<p>\n%s\n</p>\n\n", $vd->Render());
	
	$pc = new PieChart(600, 300);
	$pc->SetType(GChart::TYPE_PIECHART_3D);
	
	$a = array();
	for ($i = 1; $i <= 12; $i += 1)
		$a[] = rand(0, 100);
	$pc->AddDataset($a);
	
	$pc->SetLegend(array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"));
	//$pc->SetPieRotation(rand(0, 360));
	printf("<h1>PieChart</h2>\n<p>\n%s\n</p>\n\n", $pc->Render());
	
	$gm = new GoogleMeter(450, 250);
	$gm->SetValue($v = rand(0, 100));
	$gm->SetLegend(array("Foo (" . $v . ")"));
	printf("<h1>GoogleMeter</h2>\n<p>\n%s\n</p>\n\n", $gm->Render());
	
	$qr = new QRCode(150, 150);
	$qr->SetValue("Hello world");
	printf("<h1>QRCode</h2>\n<p>\n%s\n</p>\n\n", $qr->Render());
	
	$m = new Map();
	$m->SetArea("africa");
	
	$m->AddChartColor($white);
	$m->AddChartColor($red);
	$m->AddChartColor($yellow);
	$m->AddChartColor($green);
	
	$m->SetCountries(array("DZ", "EG", "MG", "AO", "BW", "NG", "CF", "KE", "CG", "CV", "SN", "DJ", "TZ", "GH", "MZ", "ZM"));
	$m->AddDataset(array(0, 100, 50, 32, 60, 40, 43, 12, 14, 54, 98, 17, 70, 76, 18, 29));
	
	$m->AddFill(new GChartFill(GChartFill::AREA_BACKGROUND, GChartFill::TYPE_SOLID, new GChartColor("EAF7FE")));
	
	printf("<h1>Map</h2>\n<p>\n%s\n</p>\n\n", $m->Render());
?>
