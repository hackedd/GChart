<?php
	class Map extends GChart
	{
		const DEFAULT_AREA = "world";
		static $MAP_AREAS = array("world", "africa", "asia", "europe", "middle_east", "south_america", "usa");

		public function __construct($width = 440, $height = 220)
		{
			parent::SetType(GChart::TYPE_MAP);
			parent::SetSize($width, $height);
		}
		
		public function GetArea()
		{
			return $this->mapArea;
		}
		public function SetArea($value)
		{
			if (!in_array($value, self::$MAP_AREAS))
				throw new Exception("Unsupported Map Area");
			$this->mapArea = $value;
		}
		
		public function GetCountries()
		{
			return $this->mapCountries;
		}
		public function SetCountries($areas)
		{
			$this->mapCountries = $areas;
		}
		
		public function SetCountriesAssoc($areas)
		{
			$this->SetCountries(array_keys($areas));
			$this->datasets[0] = array_values($areas);
		}

		public function SetType($value)
		{
			throw new Exception("Map does not support SetType");
		}

		public function GetFillAreaCount()
		{
			throw new Exception("Map does not support GetFillAreaCount");
		}

		public function GetFillArea($index)
		{
			throw new Exception("Map does not support GetFillArea");
		}

		public function AddFillArea($value)
		{
			throw new Exception("Map does not support AddFillArea");
		}

		public function RemoveFillArea($index)
		{
			throw new Exception("Map does not support RemoveFillArea");
		}

		public function AddFill($value)
		{
			if ($value->GetArea() != GChartFill::AREA_BACKGROUND)
				throw new Exception("Map does not support Chart or Transparancy fills");
			parent::AddFill($value);
		}

		public function GetTitle()
		{
			throw new Exception("Map does not support GetTitle");
		}

		public function SetTitle($value)
		{
			throw new Exception("Map does not support SetTitle");
		}

		public function GetTitleColor()
		{
			throw new Exception("Map does not support GetTitleColor");
		}

		public function SetTitleColor($value)
		{
			throw new Exception("Map does not support SetTitleColor");
		}

		public function GetTitleSize()
		{
			throw new Exception("Map does not support GetTitleSize");
		}

		public function SetTitleSize($value)
		{
			throw new Exception("Map does not support SetTitleSize");
		}

		public function GetLegend()
		{
			throw new Exception("Map does not support GetLegend");
		}

		public function SetLegend($values)
		{
			throw new Exception("Map does not support SetLegend");
		}

		public function GetLegendPosition()
		{
			throw new Exception("Map does not support GetLegendPosition");
		}

		public function SetLegendPosition($value)
		{
			throw new Exception("Map does not support SetLegendPosition");
		}

		public function GetAxisCount()
		{
			throw new Exception("Map does not support GetAxisCount");
		}

		public function GetAxis($index)
		{
			throw new Exception("Map does not support GetAxis");
		}

		public function AddAxis($value)
		{
			throw new Exception("Map does not support AddAxis");
		}

		public function RemoveAxis($index)
		{
			throw new Exception("Map does not support RemoveAxis");
		}

		public function GetGrid()
		{
			throw new Exception("Map does not support GetGrid");
		}

		public function SetGrid($value)
		{
			throw new Exception("Map does not support SetGrid");
		}

		public function GetMarkerCount()
		{
			throw new Exception("Map does not support GetMarkerCount");
		}

		public function GetMarker($index)
		{
			throw new Exception("Map does not support GetMarker");
		}

		public function AddMarker($value)
		{
			throw new Exception("Map does not support AddMarker");
		}

		public function RemoveMarker($index)
		{
			throw new Exception("Map does not support RemoveMarker");
		}

		public function GetLineStyles()
		{
			throw new Exception("Map does not support GetLineStyles");
		}

		public function SetLineStyles($value)
		{
			throw new Exception("Map does not support SetLineStyles");
		}

		public function GetBarWidth()
		{
			throw new Exception("Map does not support GetBarWidth");
		}

		public function SetBarWidth($value)
		{
			throw new Exception("Map does not support SetBarWidth");
		}

		public function GetBarSpace()
		{
			throw new Exception("Map does not support GetBarSpace");
		}

		public function SetBarSpace($value)
		{
			throw new Exception("Map does not support SetBarSpace");
		}

		public function GetBarGroupSpace()
		{
			throw new Exception("Map does not support GetBarGroupSpace");
		}

		public function SetBarGroupSpace($value)
		{
			throw new Exception("Map does not support SetBarGroupSpace");
		}

		public function GetBarZeroLine()
		{
			throw new Exception("Map does not support GetBarZeroLine");
		}

		public function SetBarZeroLine($value)
		{
			throw new Exception("Map does not support SetBarZeroLine");
		}

		public function GetPieRotation()
		{
			throw new Exception("Map does not support GetPieRotation");
		}

		public function SetPieRotation($value, $degrees = false)
		{
			throw new Exception("Map does not support SetPieRotation");
		}
	}
?>
