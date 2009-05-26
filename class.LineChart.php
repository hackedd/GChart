<?php
	class LineChart extends GChart
	{
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_LINECHART);
			parent::SetSize($width, $height);
		}
		
		public function SetType($value)
		{
			if ($value != GChart::TYPE_LINECHART && $value != GChart::TYPE_XY_LINECHART && $value != GChart::TYPE_SPARKLINES)
				throw new Exception("Invalid Chart Type for LineChart");
			parent::SetType($value);
		}
		
		public function GetBarWidth()
		{
			throw new Exception("LineChart does not support GetBarWidth");
		}

		public function SetBarWidth($value)
		{
			throw new Exception("LineChart does not support SetBarWidth");
		}

		public function GetBarSpace()
		{
			throw new Exception("LineChart does not support GetBarSpace");
		}

		public function SetBarSpace($value)
		{
			throw new Exception("LineChart does not support SetBarSpace");
		}

		public function GetBarGroupSpace()
		{
			throw new Exception("LineChart does not support GetBarGroupSpace");
		}

		public function SetBarGroupSpace($value)
		{
			throw new Exception("LineChart does not support SetBarGroupSpace");
		}

		public function GetBarZeroLine()
		{
			throw new Exception("LineChart does not support GetBarZeroLine");
		}

		public function SetBarZeroLine($value)
		{
			throw new Exception("LineChart does not support SetBarZeroLine");
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
