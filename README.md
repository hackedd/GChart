GChart
======

A PHP Library for the (now deprecated) [Google Image Chart API](https://developers.google.com/chart/image/)

Example
-------

    $pc = new PieChart(600, 300);
    $pc->SetType(GChart::TYPE_PIECHART_3D);

    $data = array();
    for ($i = 1; $i <= 12; $i += 1)
    	$data[] = rand(0, 100);
    $pc->AddDataset($data);

    $pc->SetLegend(array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"));
    $pc->SetPieRotation(rand(0, 360));
    echo $pc->Render();