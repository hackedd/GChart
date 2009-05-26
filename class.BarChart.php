<?php
	class BarChart extends GChart
	{
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_BARCHART_V);
			parent::SetSize($width, $height);
			parent::SetMargin(0);
			parent::SetBarWidth(GChart::BAR_WIDTH_AUTO);
		}

		public function SetType($value)
		{
			if ($value != GChart::TYPE_BARCHART_H && 
				$value != GChart::TYPE_BARCHART_V && 
				$value != GChart::TYPE_BARCHART_H_GROUPED && 
				$value != GChart::TYPE_BARCHART_V_GROUPED)
				throw new Exception("Invalid Chart Type for BarChart");
			parent::SetType($value);
		}
		
		public function GetPieRotation()
		{
			throw new Exception("BarChart does not support GetPieRotation");
		}
		
		public function SetPieRotation($value)
		{
			throw new Exception("BarChart does not support SetPieRotation");
		}
	}
?>
