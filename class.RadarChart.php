<?php
	class RadarChart extends GChart
	{
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_RADAR);
			parent::SetSize($width, $height);
			parent::SetMargin(0);
		}

		public function SetType($value)
		{
			if ($value != GChart::TYPE_RADAR && $value != GChart::TYPE_RADAR_SPLINES)
				throw new Exception("Invalid Chart Type for RadarChart");
			parent::SetType($value);
		}
		
		public function AddMarker($value)
		{
			if ($value->GetType() == TYPE_FINANCIAL)
				throw new Exception("RadarChart does not support Financial Markers");
			parent::AddMarker($value);
		}

		public function GetBarWidth()
		{
			throw new Exception("RadarChart does not support GetBarWidth");
		}

		public function SetBarWidth($value)
		{
			throw new Exception("RadarChart does not support SetBarWidth");
		}

		public function GetBarSpace()
		{
			throw new Exception("RadarChart does not support GetBarSpace");
		}

		public function SetBarSpace($value)
		{
			throw new Exception("RadarChart does not support SetBarSpace");
		}

		public function GetBarGroupSpace()
		{
			throw new Exception("RadarChart does not support GetBarGroupSpace");
		}

		public function SetBarGroupSpace($value)
		{
			throw new Exception("RadarChart does not support SetBarGroupSpace");
		}

		public function GetBarZeroLine()
		{
			throw new Exception("RadarChart does not support GetBarZeroLine");
		}

		public function SetBarZeroLine($value)
		{
			throw new Exception("RadarChart does not support SetBarZeroLine");
		}

		public function GetPieRotation()
		{
			throw new Exception("RadarChart does not support GetPieRotation");
		}

		public function SetPieRotation($value, $degrees = false)
		{
			throw new Exception("RadarChart does not support SetPieRotation");
		}
	}
?>