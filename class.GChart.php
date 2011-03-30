<?php
	/*
		This file is part of GChart - A Google Chart API Library for PHP
		Copyright (C) 2009-2011 Paul Hooijenga
		
		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU Lesser General Public License as
		published by the Free Software Foundation, either version 3 of the
		License, or (at your option) any later version.
		
		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU Lesser General Public License for more details.
		
		You should have received a copy of the GNU Lesser General Public License
		along with this program. If not, see <http://www.gnu.org/licenses/>.
		
		$Id$
	*/

	class GChart extends GetSetter
	{
		const GCHART_API_URL = "http://chart.apis.google.com/chart";

		const TYPE_LINECHART = "lc";
		const TYPE_XY_LINECHART = "lxy";
		const TYPE_SPARKLINES = "ls";
		const TYPE_BARCHART_H = "bhs";
		const TYPE_BARCHART_V = "bvs";
		const TYPE_BARCHART_H_GROUPED = "bhg";
		const TYPE_BARCHART_V_GROUPED = "bvg";
		const TYPE_BARCHART_V_OVERLAPPED = "bvo";
		const TYPE_PIECHART = "p";
		const TYPE_PIECHART_CONCENTRIC = "pc";
		const TYPE_PIECHART_3D = "p3";
		const TYPE_VENN = "v";
		const TYPE_SCATTER = "s";
		const TYPE_RADAR = "r";
		const TYPE_RADAR_SPLINES = "rs";
		const TYPE_MAP = "t";
		const TYPE_GOOGLE_O_METER = "gom";
		const TYPE_QR_CODE = "qr";
		
		const LEGEND_POS_BOTTOM = "b";
		const LEGEND_POS_TOP = "t";
		const LEGEND_POS_BOTTOM_V = "bv";
		const LEGEND_POS_TOP_V = "tv";
		const LEGEND_POS_LEFT = "l";
		const LEGEND_POS_RIGHT = "r";
		
		const BAR_WIDTH_AUTO = "a";
		const BAR_WIDTH_RELATIVE = "r";
		
		const MAX_SIZE = 1000;
		const MAX_AREA = 300000;
		const MAX_MAP_WIDTH = 440;
		const MAX_MAP_HEIGHT = 220;
		
		protected $api = self::GCHART_API_URL;
		
		// http://code.google.com/apis/chart/basics.html#chart_size
		protected $width;
		protected $height;
		
		// http://code.google.com/apis/chart/types.html
		protected $type;
		
		// http://code.google.com/apis/chart/formats.html
		protected $datasets = array();
		protected $encoding = GChartEncoder::ENCODING_TEXT;
		protected $scale = GChartEncoder::SCALE_ALL;
		protected $margin = GChartEncoder::DEFAULT_SCALE_MARGIN;
		protected $textScaling = false;
		
		protected $chartColors = array();
		protected $fillAreas = array();
		protected $fills = array();
		
		protected $title = false;
		protected $titleColor = false;
		protected $titleSize = false;
		protected $legend = false;
		protected $legendPosition = false;
		
		protected $axis = array();
		protected $grid = false;
		protected $markers = array();
		
		protected $lineStyles = false;
		
		protected $barWidth = false;
		protected $barSpace = false;
		protected $barGroupSpace = false;
		protected $barZeroLine = false;
		
		protected $pieRotation = false;
		
		protected $qrMargin = 4;
		protected $qrECLevel = false;
		protected $qrEncoding = false;
		
		protected $mapArea = Map::DEFAULT_AREA;
		protected $mapCountries = false;
		
		public function __construct($type, $width, $height)
		{
			$this->SetType($type);
			$this->SetSize($width, $height);
		}
		
		public function GetType()
		{
			return $this->type;
		}
		public function SetType($value)
		{
			$this->type = $value;
		}
		
		public function GetWidth()
		{
			return $this->width;
		}
		public function GetHeight()
		{
			return $this->height;
		}
		public function SetSize($w, $h)
		{
			if ($this->type != self::TYPE_MAP && ($w > self::MAX_SIZE || $h > self::MAX_SIZE || $w * $h > self::MAX_AREA))
				throw new Exception("Chart Width, Height or Area is out of range");
			if ($this->type == self::TYPE_MAP && ($w > self::MAX_MAP_WIDTH || $h > self::MAX_MAP_HEIGHT))
				throw new Exception("Map Width, Height or Area is out of range");
			
			$this->width = $w;
			$this->height = $h;
		}
		
		public function GetDatasetCount()
		{
			return count($this->datasets);
		}
		public function GetDataset($index)
		{
			if ($index < 0 || $index > count($this->datasets))
				throw new Exception("The dataset index is out of range");
			return $this->datasets[$index];
		}
		public function AddDataset($dataset)
		{
			$idx = count($this->datasets);
			$this->datasets[$idx] = $dataset;
			return $idx;
		}
		public function RemoveDataset($index)
		{
			if ($index < 0 || $index > count($this->datasets))
				throw new Exception("The dataset index is out of range");
			return array_splice($this->datasets, $index, 1);
		}
		
		public function GetEncoding()
		{
			return $this->encoding;
		}
		public function SetEncoding($value)
		{
			$this->encoding = $value;
		}
		
		public function GetScale()
		{
			return $this->scale;
		}
		public function SetScale($value)
		{
			$this->scale = $value;
		}
		
		public function GetMargin()
		{
			return $this->margin;
		}
		public function SetMargin($value)
		{
			$this->margin = $value;
		}
		
		public function GetTextScaling()
		{
			return $this->textScaling;
		}
		public function SetTextScaling($values)
		{
			$this->textScaling = $values;
		}
		
		public function GetChartColorCount()
		{
			return count($this->chartColors);
		}
		public function GetChartColor($index)
		{
			if ($index < 0 || $index > count($this->chartColors))
				throw new Exception("The chart color index is out of range");
			return $this->chartColors[$index];
		}
		public function AddChartColor($value)
		{
			$idx = count($this->chartColors);
			$this->chartColors[$idx] = $value;
			return $idx;
		}
		public function RemoveChartColor($index)
		{
			if ($index < 0 || $index > count($this->chartColors))
				throw new Exception("The chart color index is out of range");
			return array_splice($this->chartColors, $index, 1);
		}	
		
		public function GetFillAreaCount()
		{
			return count($this->fillAreas);
		}
		public function GetFillArea($index)
		{
			if ($index < 0 || $index > count($this->fillAreas))
				throw new Exception("The fill area index is out of range");
			return $this->fillAreas[$index];
		}
		public function AddFillArea($value)
		{
			$idx = count($this->fillAreas);
			$this->fillAreas[$idx] = $value;
			return $idx;
		}
		public function RemoveFillArea($index)
		{
			if ($index < 0 || $index > count($this->fillAreas))
				throw new Exception("The fill area index is out of range");
			return array_splice($this->fillAreas, $index, 1);
		}
		
		public function GetFillCount()
		{
			return count($this->fills);
		}
		public function GetFill($index)
		{
			if ($index < 0 || $index > count($this->fills))
				throw new Exception("The  fill index is out of range");
			return $this->fills[$index];
		}
		public function AddFill($value)
		{
			$idx = count($this->fills);
			$this->fills[$idx] = $value;
			return $idx;
		}
		public function RemoveFill($index)
		{
			if ($index < 0 || $index > count($this->fills))
				throw new Exception("The  fill index is out of range");
			return array_splice($this->fills, $index, 1);
		}
		
		public function GetTitle()
		{
			return $this->title;
		}
		public function SetTitle($value)
		{
			$this->title = $value;
		}
		
		public function GetTitleColor()
		{
			return $this->titleColor;
		}
		public function SetTitleColor($value)
		{
			$this->titleColor = $value;
		}
		
		public function GetTitleSize()
		{
			return $this->titleSize;
		}
		public function SetTitleSize($value)
		{
			$this->titleSize = $value;
		}
		
		public function GetLegend()
		{
			return $this->legend;
		}
		public function SetLegend($values)
		{
			$this->legend = $values;
		}
		
		public function GetLegendPosition()
		{
			return $this->legendPosition;
		}
		public function SetLegendPosition($value)
		{
			$this->legendPosition = $value;
		}
		
		public function GetAxisCount()
		{
			return count($this->axis);
		}
		public function GetAxis($index)
		{
			if ($index < 0 || $index > count($this->axis))
				throw new Exception("The  axis index is out of range");
			return $this->axis[$index];
		}
		public function AddAxis($value)
		{
			$idx = count($this->axis);
			$this->axis[$idx] = $value;
			return $idx;
		}
		public function RemoveAxis($index)
		{
			if ($index < 0 || $index > count($this->axis))
				throw new Exception("The  axis index is out of range");
			return array_splice($this->axis, $index, 1);
		}
		
		public function GetGrid()
		{
			return $this->grid;
		}
		public function SetGrid($value)
		{
			$this->grid = $value;
		}
		
		public function GetMarkerCount()
		{
			return count($this->markers);
		}
		public function GetMarker($index)
		{
			if ($index < 0 || $index > count($this->markers))
				throw new Exception("The marker index is out of range");
			return $this->markers[$index];
		}
		public function AddMarker($value)
		{
			$idx = count($this->markers);
			$this->markers[$idx] = $value;
			return $idx;
		}
		public function RemoveMarker($index)
		{
			if ($index < 0 || $index > count($this->markers))
				throw new Exception("The marker index is out of range");
			return array_splice($this->markers, $index, 1);
		}
		
		public function GetLineStyles()
		{
			return $this->lineStyles;
		}
		public function SetLineStyles($value)
		{
			$this->lineStyles = $value;
		}
		
		public function GetBarWidth()
		{
			return $this->barWidth;
		}
		public function SetBarWidth($value)
		{
			$this->barWidth = $value;
		}
		
		public function GetBarSpace()
		{
			return $this->barSpace;
		}
		public function SetBarSpace($value)
		{
			$this->barSpace = $value;
		}
		
		public function GetBarGroupSpace()
		{
			return $this->barGroupSpace;
		}
		public function SetBarGroupSpace($value)
		{
			$this->barGroupSpace = $value;
		}
		
		public function GetBarZeroLine()
		{
			return $this->barZeroLine;
		}
		public function SetBarZeroLine($value)
		{
			$this->barZeroLine = $value;
		}
		
		public function GetPieRotation()
		{
			return $this->pieRotation;
		}
		public function SetPieRotation($value, $degrees = false)
		{
			if ($degrees)
				$value = $value / 180 * M_PI;
			$value = $value % (M_PI * 2);
			if ($value < 0)
				$value += M_PI * 2;
			$this->pieRotation = $value;
		}
		
		public function GetImageUrl()
		{
			$params = array();
			
			// Type
			$params["cht"] = $this->type;
			
			// Size
			$params["chs"] = sprintf("%dx%d", $this->width, $this->height);
			
			// Data
			if (count($this->datasets) > 0)
				$params["chd"] = GChartEncoder::Encode($this->encoding, 
					$this->datasets, $this->scale, $this->margin);
			
			// Text Encoding with Data Scaling
			if ($this->encoding == GChartEncoder::ENCODING_TEXT && $this->textScaling !== false)
				$params["chds"] = implode(",", $this->textScaling);
			
			// Chart Colors
			if (count($this->chartColors) > 0)
			{
				$colors = array();
				foreach ($this->chartColors as $color)
				{
					if (is_array($color))
						$colors[] = implode("|", $color);
					else
						$colors[] = $color;
				}
				$params["chco"] = implode(",", $colors);
			}
			
			// Fill Areas
			if (count($this->fillAreas) > 0)
				$params["chm"] = implode("|", $this->fillAreas);
			if (count($this->markers) > 0)
				$params["chm"] = (isset($params["chm"]) ? $params["chm"] . "|" : "") . implode("|", $this->markers);
			
			// Other Fills
			if (count($this->fills) > 0)
				$params["chf"] = implode("|", $this->fills);
			
			// Title, Title Color, Title Size
			if ($this->title !== false)
			{
				$params["chtt"] = str_replace("\n", "|", $this->title);
				if ($this->titleColor != false)
					$params["chts"] = sprintf("%s,%d", $this->titleColor, $this->titleSize ? $this->titleSize : 13);
			}
			
			// Legend and Legend Position
			if ($this->legend !== false)
			{
				$key = "chdl";
				if ($this->type == self::TYPE_PIECHART || 
					$this->type == self::TYPE_PIECHART_3D || 
					$this->type == self::TYPE_PIECHART_CONCENTRIC || 
					$this->type == self::TYPE_GOOGLE_O_METER || 
					$this->type == self::TYPE_QR_CODE)
					$key = "chl";
				
				$params[$key] = implode("|", $this->legend);
				
				if ($this->legendPosition !== false)
					$params["chdlp"] = $this->legendPosition;
			}
			
			// Axes
			if (count($this->axis) > 0)
			{
				$types = array();
				$labels = array();
				$positions = array();
				$ranges = array();
				$styles = array();
				$tickLengths = array();
				
				for ($i = 0; $i < count($this->axis); $i += 1)
				{
					$axis = $this->axis[$i];
					$types[] = $axis->GetType();
					
					if ($axis->GetLabels() != false)
						$labels[] = sprintf("%d:|%s", $i, implode("|", $axis->GetLabels()));
					
					if ($axis->GetLabelPositions() != false)
						$positions[] = sprintf("%d,%s", $i, implode(",", $axis->GetLabelPositions()));
					
					if ($axis->GetRangeStart() !== false)
					{
						$range = sprintf("%d,%.1f,%.1f", $i, $axis->GetRangeStart(), $axis->GetRangeEnd());
						if ($axis->GetRangeStep() !== false)
							$range .= sprintf(",%.1f", $axis->GetRangeStep());
						$ranges[] = $range;
					}
					
					if (($style = $axis->GetStyleString()) !== false)
						$styles[] = sprintf("%d,%s", $i, $style);
					
					if ($axis->GetTickLength() !== false)
						$tickLengths[] = sprintf("%d,%d", $i, $axis->GetTickLength());
				}
				
				$params["chxt"] = implode(",", $types);
				$params["chxl"] = implode("|", $labels);
				$params["chxp"] = implode("|", $positions);
				$params["chxr"] = implode("|", $ranges);
				$params["chxs"] = implode("|", $styles);
				$params["chxtc"] = implode("|", $tickLengths);
			}
			
			// Grid
			if ($this->grid != false)
				$params["chg"] = $this->grid;
			
			// Line Styles
			if ($this->lineStyles != false)
				$params["chls"] = implode("|", $this->lineStyles);
			
			// Bar Width & Spacing
			if ($this->barWidth != false)
			{
				$params["chbh"] = $this->barWidth;
				if ($this->barSpace !== false && $this->barGroupSpace !== false)
				{
					if ($this->barWidth == self::BAR_WIDTH_RELATIVE)
						$params["chbh"] .= sprintf(",%.2f,%.2f", $this->barSpace, $this->barGroupSpace);
					else
						$params["chbh"] .= sprintf(",%d,%d", $this->barSpace, $this->barGroupSpace);
				}
			}
			
			// Bar Zero Line
			if ($this->barZeroLine !== false)
			{
				if (is_array($this->barZeroLine))
					$params["chp"] = implode(",", $this->barZeroLine);
				else
					$params["chp"] = $this->barZeroLine;
			}
			
			// Pie Chart Orientation
			if ($this->pieRotation !== false)
				$params["chp"] = sprintf("%.2f", $this->pieRotation);
			
			// QR Code EC Level and Encoding
			if ($this->type == self::TYPE_QR_CODE && $this->qrECLevel !== false)
				$params["chld"] = sprintf("%s|%d", $this->qrECLevel, $this->qrMargin);
			if ($this->type == self::TYPE_QR_CODE && $this->qrEncoding !== false)
				$params["choe"] = $this->qrEncoding;
			
			// Map Geographical Area
			if ($this->type == self::TYPE_MAP)
				$params["chtm"] = $this->mapArea;
			
			// Map Colored Areas
			if ($this->type == self::TYPE_MAP && count($this->mapCountries) > 0)
				$params["chld"] = implode("", $this->mapCountries);
				
			return $this->api . "?" . implode("&", array_map(array("GChart", "ParamPair"), array_keys($params), array_values($params)));
		}
		
		public function Render($attributes = false)
		{
			if (count($this->datasets) == 0 && $this->type != self::TYPE_QR_CODE)
				throw new Exception("A GChart must contain at least one dataset");
			
			if ($attributes == false)
				$attributes = array("alt" => "Google Chart Image");
			
			$attributes["src"] = $this->GetImageUrl();

			$tag = "<img";
			foreach ($attributes as $name => $value)
				$tag .= sprintf(" %s=\"%s\"", $name, htmlspecialchars($value));
			$tag .= " />";
			
			return $tag;
		}
		
		public static function ParamPair($key, $value)
		{
			return $key . "=" . urlencode($value);
		}
	}
?>
