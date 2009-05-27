<?php
	class ScatterPlot extends GChart
	{
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_SCATTER);
			parent::SetSize($width, $height);
			parent::SetMargin(0);
		}

		public function SetType($value)
		{
			throw new Exception("ScatterPlot does not support SetType");
		}

		public function AddDataset($dataset)
		{
			if (count($this->datasets) >= 3)
				throw new Exception("ScatterPlot does not support more than three datasets");
			parent::AddDataset($dataset);
		}
		
		public function Render($attributes = false)
		{
			if (count($this->datasets) < 2)
				throw new Exception("You need to specify at least two datasets for a ScatterPlot");
			return parent::Render($attributes);
		}
		
		public function AddMarker($value)
		{
			if ($value->GetType() == TYPE_FINANCIAL)
				throw new Exception("ScatterPlot does not support Financial Markers");
			parent::AddMarker($value);
		}

		public function GetLineStyles()
		{
			throw new Exception("ScatterPlot does not support GetLineStyles");
		}

		public function SetLineStyles($value)
		{
			throw new Exception("ScatterPlot does not support SetLineStyles");
		}

		public function GetFillAreaCount()
		{
			throw new Exception("ScatterPlot does not support GetFillAreaCount");
		}
		
		public function GetFillArea($index)
		{
			throw new Exception("ScatterPlot does not support GetFillArea");
		}
		
		public function AddFillArea($value)
		{
			throw new Exception("ScatterPlot does not support AddFillArea");
		}
		
		public function RemoveFillArea($index)
		{
			throw new Exception("ScatterPlot does not support RemoveFillArea");
		}
		
		public function GetBarWidth()
		{
			throw new Exception("ScatterPlot does not support GetBarWidth");
		}

		public function SetBarWidth($value)
		{
			throw new Exception("ScatterPlot does not support SetBarWidth");
		}

		public function GetBarSpace()
		{
			throw new Exception("ScatterPlot does not support GetBarSpace");
		}

		public function SetBarSpace($value)
		{
			throw new Exception("ScatterPlot does not support SetBarSpace");
		}

		public function GetBarGroupSpace()
		{
			throw new Exception("ScatterPlot does not support GetBarGroupSpace");
		}

		public function SetBarGroupSpace($value)
		{
			throw new Exception("ScatterPlot does not support SetBarGroupSpace");
		}

		public function GetBarZeroLine()
		{
			throw new Exception("ScatterPlot does not support GetBarZeroLine");
		}

		public function SetBarZeroLine($value)
		{
			throw new Exception("ScatterPlot does not support SetBarZeroLine");
		}

		public function GetPieRotation()
		{
			throw new Exception("ScatterPlot does not support GetPieRotation");
		}

		public function SetPieRotation($value, $degrees = false)
		{
			throw new Exception("ScatterPlot does not support SetPieRotation");
		}
	}
?>
