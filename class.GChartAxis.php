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

	class GChartAxis extends GetSetter
	{
		const TYPE_X = "x";
		const TYPE_BOTTOM = self::TYPE_X;
		const TYPE_TOP = "t";
		const TYPE_Y = "y";
		const TYPE_LEFT = self::TYPE_Y;
		const TYPE_RIGHT = "r";
		
		const RANGE_AUTO = -1;
		
		const ALIGN_LEFT = -1;
		const ALIGN_CENTER = 0;
		const ALIGN_RIGHT = 1;
		
		const DRAW_LINES = "l";
		const DRAW_TICKS = "t";
		const DRAW_BOTH = "lt";
		
		private $type;
		
		private $labels = false;
		private $labelPositions = false;
		
		private $rangeStart = false;
		private $rangeEnd = false;
		private $rangeStep = false;
		private $rangeFormat = false;
		
		private $color = false;
		private $size = false;
		private $alignment = false;
		private $drawingControl = false;
		private $tickColor = false;
		private $tickLength = false;
		
		public function __construct($type)
		{
			$this->SetType($type);
		}
		
		public function GetType()
		{
			return $this->type;
		}
		public function SetType($value)
		{
			$this->type = $value;
		}
		
		public function GetLabels()
		{
			return $this->labels;
		}
		public function SetLabels($values)
		{
			$this->labels = $values;
		}
		
		public function GetLabelPositions()
		{
			return $this->labelPositions;
		}
		public function SetLabelPositions($values)
		{
			$this->labelPositions = $values;
		}
		
		public function GetRangeStart()
		{
			return $this->rangeStart;
		}
		public function SetRangeStart($value)
		{
			$this->rangeStart = $value;
		}
		
		public function GetRangeEnd()
		{
			return $this->rangeEnd;
		}
		public function SetRangeEnd($value)
		{
			$this->rangeEnd = $value;
		}
		
		public function GetRangeStep()
		{
			return $this->rangeStep;
		}
		public function SetRangeStep($value)
		{
			$this->rangeStep = $value;
		}
		
		public function GetRangeFormat()
		{
			return $this->rangeFormat;
		}
		public function SetRangeFormat($value)
		{
			$this->rangeFormat = $value;
		}
		
		public function ExpandRange($margin = GChartEncoder::DEFAULT_SCALE_MARGIN)
		{
			$m = $margin * ($this->rangeEnd - $this->rangeStart);
			$this->rangeStart -= $m;
			$this->rangeEnd += $m;
		}
		
		public function GetColor()
		{
			return $this->color;
		}
		public function SetColor($value)
		{
			if (!($value instanceof GChartColor))
				throw new Exception("value should be of type GChartColor");
			$this->color = $value;
		}
		
		public function GetSize()
		{
			return $this->size;
		}
		public function SetSize($value)
		{
			$this->size = $value;
		}
		
		public function GetAlignment()
		{
			return $this->alignment;
		}
		public function SetAlignment($value)
		{
			if ($value != self::ALIGN_LEFT && $value != self::ALIGN_CENTER && $value != self::ALIGN_RIGHT)
				throw new Exception("Alignment value should be Left, Center or Right");
			$this->alignment = $value;
		}
		
		public function GetDrawingControl()
		{
			return $this->drawingControl;
		}
		public function SetDrawingControl($value)
		{
			$this->drawingControl = $value;
		}
		
		public function GetTickColor()
		{
			return $this->tickColor;
		}
		public function SetTickColor($value)
		{
			$this->tickColor = $value;
		}
		
		public function GetTickLength()
		{
			return $this->tickLength;
		}
		public function SetTickLength($value)
		{
			$this->tickLength = $value;
		}		
		
		public function GetStyleString()
		{
			if ($this->color == false)
				return false;
			
			$str = sprintf("%s", $this->color);
			
			if ($this->size === false)
				return $str;
			$str .= sprintf(",%d", $this->size);
			
			if ($this->alignment === false)
				return $str;
			$str .= sprintf(",%d", $this->alignment);
			
			if ($this->drawingControl === false)
				return $str;
			$str .= sprintf(",%s", $this->drawingControl);
			
			if ($this->tickColor === false)
				return $str;
			$str .= sprintf(",%s", $this->tickColor);			
			
			return $str;
		}
	}
?>
