<?php
	class PieChart extends GChart
	{
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_PIECHART);
			parent::SetSize($width, $height);
		}

		public function SetType($value)
		{
			if ($value != GChart::TYPE_PIECHART && $value != GChart::TYPE_PIECHART_3D && $value != GChart::TYPE_PIECHART_CONCENTRIC)
				throw new Exception("Invalid Chart Type for PieChart");
			parent::SetType($value);
		}

		public function GetFillAreaCount()
		{
			throw new Exception("PieChart does not support GetFillAreaCount");
		}

		public function GetFillArea($index)
		{
			throw new Exception("PieChart does not support GetFillArea");
		}

		public function AddFillArea($value)
		{
			throw new Exception("PieChart does not support AddFillArea");
		}

		public function RemoveFillArea($index)
		{
			throw new Exception("PieChart does not support RemoveFillArea");
		}

		public function GetAxisCount()
		{
			throw new Exception("PieChart does not support GetAxisCount");
		}

		public function GetAxis($index)
		{
			throw new Exception("PieChart does not support GetAxis");
		}

		public function AddAxis($value)
		{
			throw new Exception("PieChart does not support AddAxis");
		}

		public function RemoveAxis($index)
		{
			throw new Exception("PieChart does not support RemoveAxis");
		}

		public function GetGrid()
		{
			throw new Exception("PieChart does not support GetGrid");
		}

		public function SetGrid($value)
		{
			throw new Exception("PieChart does not support SetGrid");
		}

		public function GetMarkerCount()
		{
			throw new Exception("PieChart does not support GetMarkerCount");
		}

		public function GetMarker($index)
		{
			throw new Exception("PieChart does not support GetMarker");
		}

		public function AddMarker($value)
		{
			throw new Exception("PieChart does not support AddMarker");
		}

		public function RemoveMarker($index)
		{
			throw new Exception("PieChart does not support RemoveMarker");
		}

		public function GetLineStyles()
		{
			throw new Exception("PieChart does not support GetLineStyles");
		}

		public function SetLineStyles($value)
		{
			throw new Exception("PieChart does not support SetLineStyles");
		}

		public function GetBarWidth()
		{
			throw new Exception("PieChart does not support GetBarWidth");
		}

		public function SetBarWidth($value)
		{
			throw new Exception("PieChart does not support SetBarWidth");
		}

		public function GetBarSpace()
		{
			throw new Exception("PieChart does not support GetBarSpace");
		}

		public function SetBarSpace($value)
		{
			throw new Exception("PieChart does not support SetBarSpace");
		}

		public function GetBarGroupSpace()
		{
			throw new Exception("PieChart does not support GetBarGroupSpace");
		}

		public function SetBarGroupSpace($value)
		{
			throw new Exception("PieChart does not support SetBarGroupSpace");
		}

		public function GetBarZeroLine()
		{
			throw new Exception("PieChart does not support GetBarZeroLine");
		}

		public function SetBarZeroLine($value)
		{
			throw new Exception("PieChart does not support SetBarZeroLine");
		}
	}
?>
