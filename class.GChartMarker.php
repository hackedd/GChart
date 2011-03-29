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

	class GChartMarker extends GetSetter
	{
		const TYPE_AT = "@";	// datapoint is coordinates
		const TYPE_ARROW = "a";
		const TYPE_CROSS = "c";
		const TYPE_DIAMOND = "d";
		const TYPE_CIRCLE = "o";
		const TYPE_SQUARE = "s";
		const TYPE_LINE_V = "v";
		const TYPE_LINE_V_FULL = "V";
		const TYPE_LINE_H = "h";
		const TYPE_X = "x";
		const TYPE_RANGE_H = "r";
		const TYPE_RANGE_V = "R";
		const TYPE_FINANCIAL = "F";

		const TYPE_TEXT = "t";
		
		const BOTTOM = -1;
		const BELOW = self::BOTTOM;
		const MID = 0;
		const TOP = 1;
		
		private $type;
		private $color;
		private $datasetIndex;
		private $datapoint;
		private $size;
		private $priority = false;
		
		public function __construct($type, $color, $datasetIndex, $datapoint, $size)
		{
			$this->SetType($type);
			$this->SetColor($color);
			$this->SetDatasetIndex($datasetIndex);
			$this->SetDatapoint($datapoint);
			$this->SetSize($size);
		}
		
		public function GetType()
		{
			return $this->type;
		}
		public function SetType($value)
		{
			$this->type = $value;
		}
		
		public function GetColor()
		{
			return $this->color;
		}
		public function SetColor($value)
		{
			$this->color = $value;
		}
		
		public function GetDatasetIndex()
		{
			return $this->datasetIndex;
		}
		public function SetDatasetIndex($value)
		{
			$this->datasetIndex = $value;
		}
		
		public function GetDatapoint()
		{
			return $this->datapoint;
		}
		public function SetDatapoint($value)
		{
			$this->datapoint = $value;
		}
		
		public function GetSize()
		{
			return $this->size;
		}
		public function SetSize($value)
		{
			$this->size = $value;
		}
		
		public function GetRangeStart()
		{
			return $this->datapoint;
		}
		public function SetRangeStart($value)
		{
			$this->datapoint = $value;
		}
		
		public function GetRangeEnd()
		{
			return $this->size;
		}
		public function SetRangeEnd($value)
		{
			$this->size = $value;
		}		
		public function GetPriority()
		{
			return $this->priority;
		}
		public function SetPriority($value)
		{
			$this->priority = $value;
		}
		
		public function __ToString()
		{
			$str = sprintf("%s,%s,%d,%s,%.2f", $this->type, $this->color, 
				$this->datasetIndex, $this->datapoint, $this->size);
			
			if ($this->priority !== false)
				$str .= sprintf(",%d", $this->priority);
			
			return $str;
		}
		
		public static function TextType($text)
		{
			return self::TYPE_TEXT . $text;
		}
		
		public static function Every($i = 1, $start = false, $end = false)
		{
			if ($start == false && $end == false)
				return -$i;
			return sprintf("%d:%d:%d", $start, $end, $i);
		}
		
		public static function At($x, $y)
		{
			return sprintf("%.2f:%.2f", $x, $y);
		}
	}
?>