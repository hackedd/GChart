<?php
	class GChart
	{
		/*
		 * Google Maps API Location (change if you want to proxy/cache the browser's call)
		 */
		public static $api = "http://chart.apis.google.com/chart";
		public static $default_linestyle = array(1, 1, 0);
		
		/*
		 * Chart Types
		 */
		const TYPE_LINECHART = "lc";
		const TYPE_XY_LINECHART = "lxy";
		const TYPE_SPARKLINES = "ls";
		
		const TYPE_BARCHART_H = "bhs";
		const TYPE_BARCHART_V = "bvs";
		const TYPE_BARCHART_H_GROUPED = "bhg";
		const TYPE_BARCHART_V_GROUPED = "bvg";
		
		const TYPE_PIECHART = "p";
		const TYPE_PIECHART_3D = "p3";
		
		const TYPE_VENN = "v";
		
		const TYPE_SCATTER = "s";
		
		const TYPE_RADAR = "r";
		const TYPE_RADAR_SPLINES = "rs";
		
		const TYPE_MAP = "t";
		
		const TYPE_GOOGLE_O_METER = "gom";
		
		/*
		 * Maximum Sizes (used in setSize)
		 */
		const MAX_SIZE = 1000;
		const MAX_AREA = 300000;
		const MAX_MAP_WIDTH = 440;
		const MAX_MAP_HEIGHT = 220;
		
		/*
		 * Encodings (Handled by EncodeData)
		 */
		const ENCODING_TEXT = "t";
		const ENCODING_SIMPLE = "s";
		const ENCODING_EXTENDED = "e";
		
		/*
		 * Map Areas (Used by char type MAP)
		 */
		const AREA_AFRICA = "africa";
		const AREA_ASIA = "asia";
		const AREA_EUROPE = "europe";
		const AREA_MIDDLE_EAST = "middle_east";
		const AREA_SOUTH_AMERICA = "south_america";
		const AREA_USA = "usa";
		const AREA_WORLD = "world";

		/*
		 * Fill Areas
		 */
		const FILL_TRANSPARENCY = "a";
		const FILL_BACKGROUND = "bg";
		const FILL_CHART = "c";
		
		/*
		 * Fill Types
		 */
		const FILL_SOLID = "s";
		const FILL_GRADIENT = "lg";
		const FILL_STRIPES = "ls";
		
		/*
		 * Legend Positions
		 */
		const LEGEND_POS_BOTTOM = "b";
		const LEGEND_POS_TOP = "t";
		const LEGEND_POS_RIGHT = "r";
		const LEGEND_POS_LEFT = "l";
		
		/*
		 * Axis Positions
		 */
		const AXIS_X = "x";
		const AXIS_BOTTOM = self::AXIS_X;
		const AXIS_TOP = "t";
		const AXIS_Y = "y";
		const AXIS_LEFT = self::AXIS_Y;
		const AXIS_RIGHT = "r";
		
		/*
		 * Axis Style Alignment Constants
		 */
		const AXIS_ALIGN_LEFT = -1;
		const AXIS_ALIGN_CENTER = 0;
		const AXIS_ALIGN_RIGHT = 1;
		
		/*
		 * Marker Types
		 */
		const MARKER_TYPE_ARROW = "a";
		const MARKER_TYPE_CROSS = "c";
		const MARKER_TYPE_DIAMOND = "d";
		const MARKER_TYPE_CIRCLE = "o";
		const MARKER_TYPE_SQUARE = "s";
		const MARKER_TYPE_TEXT = "t";
		const MARKER_TYPE_LINE_V = "v";
		const MARKER_TYPE_LINE_V_FULL = "V";
		const MARKER_TYPE_LINE_H = "h";
		const MARKER_TYPE_X = "x";
	
		/*
		 * Marker Overlay Priority
		 */
		const MARKER_PRIO_BOTTOM = -1;
		const MARKER_PRIO_MID = 0;
		const MARKER_PRIO_TOP = 1;
		
		/*
		 * Range marker Orientation
		 */
		const RANGEMARKER_H = "r";
		const RANGEMARKER_V = "R";
		
		/*
		 * Required Data with defaults
		 */
		var $width = 320;
		var $height = 240;
		var $type = self::TYPE_LINECHART;
		var $encoding = self::ENCODING_SIMPLE;
		var $scaling = false;
		var $data = array(null);

		/*
		 * Optional Data
		 */
		private $area = self::AREA_WORLD;
		private $map_areas = array();
		private $colors = array();
		private $areas = array();
		private $fills = array();
		private $title_text = false;
		private $title_size = false;
		private $title_color = false;
		private $legends = array();
		private $legend_pos = false;
		private $axis = array();
		private $bar_width = false;
		private $bar_groupspacing = false;
		private $bar_spacing = false;
		private $bar_zero = false;
		private $linestyles = array();
		private $grid = false;
		private $markers = array();
		private $rangemarkers = array();
		
		/*
		 * Extra parameters to be passed to the API
		 */
		private $extra_params = array();
		
		function GChart()
		{
		}
		
		/*
		 * Helper function used in Render()
		 */
		static function ParamPair($key, $value)
		{
			return sprintf("%s=%s", $key, urlencode($value));
		}
		
		/*
		 * Sets and checks the Chart Size and Area. Returns false on error.
		 */
		function SetSize($w, $h)
		{
			if ($this->type != self::TYPE_MAP && ($w > self::MAX_SIZE || $h > self::MAX_SIZE || $w * $h > self::MAX_AREA))
				return false;
			if ($this->type == self::TYPE_MAP && ($w > self::MAX_MAP_WIDTH || $h > self::MAX_MAP_HEIGHT))
				return false;
			
			$this->width = $w;
			$this->height = $h;
			
			return true;
		}
		
		/*
		 * Sets the Geographic Area of a Map type Graph
		 */
		function SetArea($area)
		{
			if ($this->type != self::TYPE_MAP)
				return false;
//			if (!in_array(self::AREA_CONSTANTS, $area))
//				return false;
			$this->area = $area;
		}
		
		/*
		 * Specifies which areas of the map are colored
		 * according to the data values.
		 * Areas are either:
		 *   ISO 3166-1-alpha-2 codes for countries as defined by ISO3166
		 *   2-letter USA state codes
		 */
		function SetColoredMapAreas($areas)
		{
			$this->map_areas = $areas;
		}
		
		/*
		 * Returns the list of colored Map Areas
		 */
		function GetColoredMapAreas()
		{
			return $this->map_areas;
		}
		
		/*
		 * Easier way to address coloring of Map Areas.
		 * $data is a map of Area Code => Value.
		 */
		function SetValueByArea($data)
		{
			$areas = array();
			$values = array();
			foreach ($data as $area => $value)
			{
				$areas[] = $area;
				$values[] = $values;
			}
			
			$this->data = array(0 => $values);
			$this->map_areas = $areas;
		}
		
		/*
		 * Converts R, G, B and Alpha components to a color array.
		 */
		static function MakeColor($r, $g, $b, $a = 0)
		{
			if ($r >= 0 && $r <= 1)
				$r *= 0xFF;
			if ($g >= 0 && $g <= 1)
				$g *= 0xFF;
			if ($b >= 0 && $b <= 1)
				$b *= 0xFF;
			if ($a >= 0 && $a <= 1)
				$a *= 0xFF;
			
			return array($r, $g, $b, $a);
		}
		
		/*
		 * Format a color array as RRGGBB[AA]
		 */
		static function FormatColor($color)
		{
			$hex = sprintf("%02X%02X%02X", $color[0], $color[1], $color[2]);
			if ($color[3] > 0)
				$hex .= sprintf("%02X", $color[3]);
			return $hex;
		}
		
		/*
		 * Adds a chart color
		 */
		function AddColor($r, $g, $b, $a = 0)
		{
			$this->colors[] = self::MakeColor($r, $g, $b, $a);
		}
		
		/*
		 * Sets a chart color
		 */
		function SetColor($idx, $r, $g, $b, $a = 0)
		{
			if ($idx < 0 || $idx >= count($this->colors))
				return $this->AddColor($r, $g, $b, $a);
			$this->colors[$idx] = self::MakeColor($r, $g, $b, $a);
		}
		
		/*
		 * Removes a chart color
		 */
		function RemoveColor($idx = -1)
		{
			if ($idx < 0)
				return $this->colors = array();
			if ($idx >= 0 && $idx <= count($this->colors))
				return array_splice($this->colors, $idx, 1);
			return false;
		}
		
		/*
		 * Format a Fill Area
		 */
		static function FormatFillArea($area)
		{
			return sprintf("%s,%s,%s,%s,0", $area[0], self::FormatColor($area[1]), $area[2], $area[3]);
		}
		
		/*
		 * Adds a Fill Area
		 */
		function AddFillArea($mode, $color, $start, $end)
		{
			$this->areas[] = array($mode, $color, $start, $end);
		}
		
		/*
		 * Sets a Fill Area
		 */
		function SetFillArea($idx, $mode, $color, $start, $end)
		{
			if ($idx < 0 || $idx >= count($this->areas))
				return $this->AddFillArea($mode, $color, $start, $end);
			$this->areas[$idx] = array($mode, $color, $start, $end);
		}
		
		/*
		 * Removes a Fill Area
		 */
		function RemoveFillArea($idx = -1)
		{
			if ($idx < 0)
				return $this->areas = array();
			if ($idx >= 0 && $idx <= count($this->areas))
				return array_splice($this->areas, $idx, 1);
			return false;
		}

		/*
		 * Format a Solid Fill
		 */
		static function FormatSolidFill($fill)
		{
			$str = sprintf("%s,%s", $fill[0], $fill[1]);
			switch ($fill[1])
			{
				case self::FILL_SOLID:
					$str .= sprintf(",%s", self::FormatColor($fill[2]));
					break;
				case self::FILL_GRADIENT:
				case self::FILL_STRIPES:
					// chf=<bg or c>,<lg or ls>,<angle>,<color 1>,<width 1>,<color n>,<width n>
					$str .= sprintf(",%d", $fill[2]);
					for ($i = 3; $i < count($fill); $i += 2)
						$str .= sprintf(",%s,%.2f", self::FormatColor($fill[$i]), $fill[$i + 1]);
					break;
				default:
			}
			return $str;
		}
		
		/*
		 * Creates a Solid Fill
		 */
		static function CreateSolidFill($area, $mode, $optional)
		{
			$fill = array($area, $mode);
			foreach ($optional as $value)
				$fill[] = $value;
			return $fill;
		}
		
		/*
		 * Adds a Solid Fill
		 */
		function AddSolidFill($area, $mode, $optional = array())
		{
			$this->fills[] = self::CreateSolidFill($area, $mode, $optional);
		}
		
		/*
		 * Sets a Solid Fill
		 */
		function SetSolidFill($idx, $area, $mode, $optional = array())
		{
			if ($idx < 0 || $idx >= count($this->fills))
				return $this->AddSolidFill($mode, $area, $mode, $optional);
			$this->fills[$idx] = self::CreateSolidFill($area, $mode, $optional);
		}
		
		/*
		 * Removes a Solid Fill
		 */
		function RemoveSolidFill($idx = -1)
		{
			if ($idx < 0)
				return $this->fills = array();
			if ($idx >= 0 && $idx <= count($this->fills))
				return array_splice($this->fills, $idx, 1);
			return false;
		}
		
		/*
		 * Sets title text and optionally color and size
		 */
		function SetTitle($title, $color = false, $size = false)
		{
			$this->title_text = str_replace("\n", "|", $title);
			if ($color !== false)
				$this->title_color = $color;
			if ($size !== false)
				$this->title_size = $size;
		}
		
		/*
		 * Gets the title Text
		 */
		function GetTitle()
		{
			return $this->title_text;
		}
		
		/*
		 * Gets the title Color
		 */
		function GetTitleColor()
		{
			return $this->title_color;
		}
		
		/*
		 * Gets the title Size
		 */
		function GetTitleSize()
		{
			return $this->title_size;
		}
		
		/*
		 * Sets the legend for data set $idx
		 */
		function SetLegend($idx, $text)
		{
			$this->legends[$idx] = $text;
		}
		
		/*
		 * Removes the legend for data set $idx
		 */
		function UnSetLegend($idx)
		{
			if (isset($this->legends[$idx]))
				unset($this->legends[$idx]);
		}
		 
		/*
		 * Sets the legend position to one of LEGEND_POS_*
		 */
		function SetLegendPosition($position)
		{
			$this->legend_pos = $position;
		}
		
		/*
		 * Creates a Axis Range
		 */
		static function CreateAxisRange($start, $end)
		{
			return array($start, $end);
		}
		
		/*
		 * Creates a Axis Style
		 */
		static function CreateAxisStyle($color, $size = false, $alignment = false)
		{
			return array($color, $size, $alignment);
		}
		
		/*
		 * Formats a Axis Style
		 */
		static function FormatAxisStyle($style)
		{
			$str = self::FormatColor($style[0]);
			if ($style[1] !== false && is_numeric($style[1]))
				$str .= sprintf(",%d", $style[1]);
			if ($style[2] !== false && is_numeric($style[2]) && -1 <= $style[2] && 1 >= $style[2])
				$str .= sprintf(",%d", $style[2]);
			return $str;
		}
		
		/*
		 * Set the axis data for axis $idx
		 */
		function SetAxis($idx, $type, $labels = false, $positions = false, $range = false, $style = false)
		{
			$this->axis[$idx] = array($type, $labels, $positions, $range, $style);
		}
		
		/*
		 * Removes the axis $idx
		 */
		function UnSetAxis($idx)
		{
			if (isset($this->axis[$idx]))
				unset($this->axis[$idx]);
		}
		
		/*
		 * Sets the with of individual bars, the amount of spacing
		 * between bars in the same group, and the amount of spacing between
		 * groups in a bar chart.
		 */
		function SetBarSpacing($width, $groupspace = false, $space = false)
		{
			if ($this->width !== false)
				$this->bar_width = $width;
			if ($groupspace !== false)
				$this->bar_groupspace = $groupspace;
			if ($space !== false)
				$this->bar_space = $space;
		}
		
		/*
		 * Resets the bar spacing parameters
		 */
		function UnsetBarSpacing()
		{
			$this->bar_width = $this->bar_groupspace = $this->bar_space = false;
		}
		
		/*
		 * Sets the vertical position of the zero line in a bar chart.
		 * 0 => Bottom, 1 => Top
		 */
		function SetBarZero($zero)
		{
			$this->bar_zero = $zero;
		}
		
		/*
		 * Resets the vertical position of the zero line
		 */
		function UnSetBarZero()
		{
			$this->SetBarZero(false);
		}
		
		/*
		 * Sets the line style for dataset $idx.
		 * A Thickness of 0 renders the line invisible
		 */
		function SetLineStyle($idx, $thickness, $line, $blank)
		{
			$this->linestyles[$idx] = array($thickness, $line, $blank);
		}
		
		/*
		 * Reset the linestyle for dataset $idx
		 */
		function UnSetLineStyle($idx)
		{
			if (isset($this->linestyles[$idx]))
				unset($this->linestyles[$idx]);
		}
		
		/*
		 * Sets the grid.
		 */
		function SetGrid($xstep, $ystep, $line, $blank)
		{
			$this->grid = array($xstep, $ystep, $line, $blank);
		}
		
		/*
		 * Resets the grid
		 */
		function UnSetGrid()
		{
			$this->grid = false;
		}
		
		/*
		 * Format a marker for use in parameters
		 */
		static function FormatMarker($marker)
		{
			$str = sprintf("%s,%s,%d,%.2f,%.2f", $marker[0], 
				self::FormatColor($marker[1]), $marker[2], $marker[3], $marker[4]);
			if ($marker[5] !== false)
				$str .= sprintf(",%d", $marker[5]);
			return $str;
		}
		
		/*
		 * When specifying text markers, use this macro for the $type
		 */
		static function MarkerText($text)
		{
			return sprintf("%s%s", self::MARKER_TYPE_TEXT, $text);
		}
		
		/*
		 * Adds a marker
		 */
		function AddMarker($type, $color, $dataset, $datapoint, $size, $priority = false)
		{
			$this->markers[] = array($type, $color, $dataset, $datapoint, $size, $priority);
		}
		
		/*
		 * Removes a marker
		 */
		function RemoveMarker($idx)
		{
			if ($idx < 0)
				return $this->markers = array();
			if ($idx >= 0 && $idx <= count($this->markers))
				return array_splice($this->markers, $idx, 1);
			return false;
		}
		
		/*
		 * Add a range marker
		 */
		function AddRangeMarker($orientation, $color, $start, $end)
		{
			$this->AddMarker($orientation, $color, 0, $start, $end);
		}
		
		/*
		 * Removes a range marker
		 */
		function RemoveRangeMarker($idx)
		{
			$this->RemoveMarker($idx);
		}
		
		/*
		 * Scale all data points in all sets to the $min_o - $max_o range (inclusive).
		 * If $min_i and/or $max_i are given, these are assumed the minimum and
		 *   maximum values of the sets.
		 * If $single is true, a single min and max value is assumed for all sets
		 */
		function ScaleData($min_i = false, $max_i = false, $min_o = 0, $max_o = 100, $single = false)
		{
			$min = array();
			$max = array();
			for ($s = 0; $s < count($this->data); $s++)
			{
				$min[$s] = min($this->data[$s]);
				$max[$s] = max($this->data[$s]);
			}
			
			if (isset($this->minmax))
			{
				if (!is_array($this->minmax[0]))
					$this->minmax[0] = array($this->minmax[0]);
				if (!is_array($this->minmax[1]))
					$this->minmax[1] = array($this->minmax[1]);
					
				$min_i = $this->minmax[0];
				$max_i = $this->minmax[1];
				
				for ($i = 0; $i < count($min_i); $i++)
				{
					if ($min_i[$i] === false)
						$min_i[$i] = $min[$i];
					if ($max_i[$i] === false)
						$max_i[$i] = $max[$i];
				}
			}
			
			if ($min_i === false)
				$min_i = $single ? array(min($min)) : $min;
			if ($max_i === false)
				$max_i = $single ? array(max($max)) : $max;
			
			$data = array();
			for ($s = 0; $s < count($this->data); $s++)
			{
				if ($this->data[$s] === null)
				{
					$data[] = null;
				}
				else
				{
					$setvalues = array();
					foreach ($this->data[$s] as $value)
					{
						$is = $single ? 0 : ($s % count($min_i));
						
						if ($value === null)
							$setvalues[] = null;
						else
							$setvalues[] = $min_o + $max_o * (((float)$value - $min_i[$is]) / ($max_i[$is] - $min_i[$is]));
					}
					$data[] = $setvalues;
				}
			}
			
			return $data;
		}
		
		/*
		 * Encode the data in $data according to the specific encoding's rules.
		 * Returns a string directly usable in URL's (but not yet urlencoded).
		 */
		function EncodeData()
		{
			switch ($this->encoding)
			{
				case self::ENCODING_TEXT:
					if ($this->scaling && isset($this->minmax))
					{
						$data = $this->data;
						$this->extra_params["chds"] = implode(",", $this->minmax);
					}
					else if ($this->scaling)
					{
						$data = $this->data;
						$minmax = array();
						for ($s = 0; $s < count($data); $s++)
						{
							$minmax[] = sprintf("%.1f", min($data[$s]));
							$minmax[] = sprintf("%.1f", max($data[$s]));
						}
						$this->extra_params["chds"] = implode(",", $minmax);
					}
					else
					{
						$data = $this->ScaleData(false, false, 0, 100);
					}
					
					$values = array();
					foreach ($data as $set)
					{
						if ($set === null)
						{
							$values[] = "_";
						}
						else
						{
							$setvalues = array();
							foreach ($set as $value)
							{
								if ($value === null)
									$setvalues[] = "-1";
								else
									$setvalues[] = sprintf("%.1f", $value);
							}
							$values[] = implode(",", $setvalues);
						}
					}
						
					return sprintf("%s:%s", $this->encoding, implode("|", $values));
					break;
					
				case self::ENCODING_SIMPLE:
					$charset = 
						"ABCDEFGHIJKLMNOPQRSTUVWXYZ" .
						"abcdefghijklmnopqrstuvwxyz" .
						"0123456789";
					
					$data = $this->ScaleData(false, false, 0, strlen($charset) - 1);
					
					$values = array();
					foreach ($data as $set)
					{
						if ($set === null)
						{
							$values[] = "_";
						}
						else
						{
							$setvalues = "";
							foreach ($set as $value)
							{
								if ($value === null)
									$setvalues .= "_";
								else
									$setvalues .= $charset[$value];
							}
							$values[] = $setvalues;
						}
					}
					
					return sprintf("%s:%s", $this->encoding, implode(",", $values));
					break;
					
				case self::ENCODING_EXTENDED:
					$charset = 
						"ABCDEFGHIJKLMNOPQRSTUVWXYZ" .
						"abcdefghijklmnopqrstuvwxyz" .
						"0123456789-.";
					$len = strlen($charset);
					
					$data = $this->ScaleData(false, false, 0, $len * $len - 1);
					$values = array();
					foreach ($data as $set)
					{
						if ($set === null)
						{
							$values[] = "_";
						}
						else
						{
							$setvalues = "";
							foreach ($set as $value)
							{
								if ($value === null)
									$setvalues .= "__";
								else
									$setvalues .= $charset[(int)($value / $len)] . $charset[$value % $len];
							}
							$values[] = $setvalues;
						}
					}
					
					return sprintf("%s:%s", $this->encoding, implode(",", $values));
					break;
				default:
					return false;
			}
		}
		
		/*
		 * Returns the API URL for the current Chart
		 */
		function Render($amp = false)
		{
			$params = array();
			
			// Size
			$params["chs"] = sprintf("%dx%d", $this->width, $this->height);
			// Data
			$params["chd"] = $this->EncodeData();
			// Type
			$params["cht"] = $this->type;
			
			// Map Area
			if ($this->type == self::TYPE_MAP)
				$params["chtm"] = $this->area;
			if ($this->type == self::TYPE_MAP && count($this->map_areas) > 0)
				$params["chld"] = implode("", $this->map_areas);
				
			// Colors
			if (count($this->colors) > 0)
				$params["chco"] = implode(",", array_map(array("GChart", "FormatColor"), $this->colors));
			
			// Fill Areas
			if (count($this->areas) > 0)
				$params["chm"] = implode("|", array_map(array("GChart", "FormatFillArea"), $this->areas));
			
			// Solid Fills
			if (count($this->fills) > 0)
				$params["chf"] = implode("|", array_map(array("GChart", "FormatSolidFill"), $this->fills));
			
			// Title Text and Size
			if ($this->title_text !== false)
			{
				$params["chtt"] = $this->title_text;
				if ($this->title_size !== false && $this->title_color !== false)
					$params["chts"] .= sprintf("%s|%d", self::FormatColor($this->title_color), $this->title_size);
			}
			
			// Legends and Legend Position
			if (count($this->legends) > 0)
			{
				$legends = array();
				for ($i = 0; $i <= max(array_keys($this->legends)); $i++)
					$legends[] = isset($this->legends[$i]) ? $this->legends[$i] : "";
					
				if ($this->type == self::TYPE_PIECHART || $this->type == self::TYPE_PIECHART_3D || $this->type == self::TYPE_GOOGLE_O_METER)
				{
					$params["chl"] = implode("|", $legends);
				}
				else
				{
					$params["chdl"] = implode("|", $legends);
					if ($this->legend_pos !== false)
						$params["chdlp"] = $this->legend_pos;
				}
			}
			
			// Axis
			if (count($this->axis) > 0)
			{
				$axis = array();
				foreach ($this->axis as $a)
					$axis[] = $a;
				
				$types = array();
				$labels = array();
				$positions = array();
				$ranges = array();
				$styles = array();
				
				for ($i = 0; $i < count($axis); $i++)
				{
					$types[] = $axis[$i][0];
					
					// Labels
					if ($axis[$i][1] !== false) 
						$labels[] = sprintf("%d:|%s", $i, implode("|", $axis[$i][1]));
					
					// Positions
					if ($axis[$i][2] !== false)
						$positions[] = sprintf("%d,%s", $i, implode(",", $axis[$i][2]));
					
					// Ranges
					if ($axis[$i][3] !== false)
						$ranges[] = sprintf("%d,%d,%d", $i, $axis[$i][3][0], $axis[$i][3][1]);
					
					// Styles
					if ($axis[$i][4] !== false)
						$styles[] = sprintf("%d,%s", $i, self::FormatAxisStyle($axis[$i][4]));
				}
				
				$params["chxt"] = implode(",", $types);
				if (count($labels) > 0)
					$params["chxl"] = implode("|", $labels);
				if (count($positions) > 0)
					$params["chxp"] = implode("|", $positions);
				if (count($ranges) > 0)
					$params["chxr"] = implode("|", $ranges);
				if (count($styles) > 0)
					$params["chxs"] = implode("|", $styles);
			}
			
			// Bar width and spacing
			if ($this->bar_width !== false && 
				($this->type == self::TYPE_BARCHART_H || 
					$this->type == self::TYPE_BARCHART_V || 
					$this->type == self::TYPE_BARCHART_H_GROUPED || 
					$this->type == self::TYPE_BARCHART_V_GROUPED)
				)
			{
				$data = array($this->bar_width);
				if ($this->bar_groupspacing !== false)
					$data[] = $this->bar_groupspacing;
				if ($this->bar_spacing !== false)
					$data[] = $this->bar_spacing;
				$params["chbh"] = implode(",", $data);
			}
			
			// Bar chart zero line
			if ($this->bar_zero !== false && 
				($this->type == self::TYPE_BARCHART_H || 
					$this->type == self::TYPE_BARCHART_V || 
					$this->type == self::TYPE_BARCHART_H_GROUPED || 
					$this->type == self::TYPE_BARCHART_V_GROUPED)
				)
			{
				if (is_array($this->bar_zero))
					$params["chp"] = implode(",", $this->bar_zero);
				else
					$params["chp"] = $this->bar_zero;
			}
			
			// Line Styles
			if (count($this->linestyles) > 0)
			{
				$styles = array();
				for ($i = 0; $i < count($this->data); $i++)
					$styles[] = isset($this->linestyles[$i]) ? implode(",", $this->linestyles[$i]) : implode(",", self::$default_linestyle);
				$params["chls"] = implode("|", $styles);
			}
			
			// Grid
			if ($this->grid !== false)
				$params["chg"] = implode(",", $this->grid);
			
			// Markers & Range Markers
			if (count($this->markers) > 0)
				$params["chm"] = implode("|", array_map(array("GChart", "FormatMarker"), $this->markers));
			
			foreach ($this->extra_params as $k => $v)
				if (!isset($params[$k]))
					$params[$k] = $v;
					
			return sprintf("%s?%s", self::$api, join($amp ? "&amp;" : "&", 
				array_map(array("GChart", "ParamPair"), array_keys($params), array_values($params))));
		}
	}
	
	if (basename($_SERVER["PHP_SELF"]) == basename(__FILE__))
	{
		error_reporting(E_ALL);
		ob_start();
		
		$data = array();
		$data[0] = array();
		$data[1] = array();
		for ($i = 0; $i < 62 /* pi * 2 * 10 */; $i++)
		{
			$data[0][] = sin((float)$i / 10);
			$data[1][] = cos((float)$i / 10);
		}
		
		$c = new GChart();
		$c->encoding = GChart::ENCODING_SIMPLE;
		$c->data = $data;
		$c->AddColor(1, 0, 0);
		$c->AddColor(0, 0, 1);
		
//		$c->AddSolidFill(GChart::FILL_CHART, GChart::FILL_STRIPES, array(90, GChart::MakeColor(0x80, 0x80, 0x80), 0.25, GChart::MakeColor(0xFF, 0xFF, 0xFF), 0.25));
		
		$c->SetTitle("sin v. cos");
		
		$c->SetLegend(0, "sin(0 - 2pi)");
		$c->SetLegend(1, "cos(0 - 2pi)");
		$c->SetLegendPosition(GChart::LEGEND_POS_BOTTOM);
		
		$c->SetAxis(0, "y", array("-1", "0", "1"), false, false, GChart::CreateAxisStyle(GChart::MakeColor(0, 0, 1)));
		$c->SetAxis(1, "x", array("0", "pi", "2pi"));
		
		$c->SetGrid(25, 25, 2, 5);
		
		$c->AddMarker(GChart::MARKER_TYPE_LINE_V, GChart::MakeColor(0, 0, 0), 0, 31.415 * 0.25, 2, GChart::MARKER_PRIO_TOP);
		$c->AddMarker(GChart::MARKER_TYPE_LINE_V_FULL, GChart::MakeColor(1, 1, 0), 0, 31.415 * 1.25, 1, GChart::MARKER_PRIO_TOP);
		
		$c->AddRangeMarker(GChart::RANGEMARKER_H, GChart::MakeColor(0xEE, 0xEE, 0xFF), 0.25, 0.75);
		
		print_r($c);
		
		printf("\n\n");
		
		printf("%s\n", str_replace(array("&", "?", "="), array(" &\n\t", "?\n\t", "\t= "), $c->Render()));
		
		$debug = ob_get_contents();
		ob_end_clean();
		
		printf("<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"\n\t\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n<html>\n<head>\n<title>GChart</title>\n</head>\n<body>\n<pre>%s\n\n</pre>\n<p>\n<img src=\"%s\" alt=\"GChart\" />\n</p>\n</body>\n</html>\n", htmlspecialchars($debug), $c->Render(true));
	}
?>
