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

	class GChartFill extends GetSetter
	{
		const AREA_BACKGROUND = "bg";
		const AREA_CHART = "c";
		const AREA_TRANSPARENCY = "a";
		
		const TYPE_SOLID = "s";
		const TYPE_GRADIENT = "lg";
		const TYPE_STRIPES = "ls";
	
		const ANGLE_VERTICAL = 0;
		const ANGLE_HORIZONTAL = 90;
	
		private $area;	// called fill type
		private $type;
		private $colors;
		private $angle = 0;
		
		public function __construct($area, $type, $colors)
		{
			$this->SetArea($area);
			$this->SetType($type);
			$this->SetColors($colors);
		}
		
		public function GetArea()
		{
			return $this->area;
		}
		public function SetArea($value)
		{
			$this->area = $value;
		}

		public function GetType()
		{
			return $this->type;
		}
		public function SetType($value)
		{
			$this->type = $value;
		}

		public function GetColors()
		{
			return $this->colors;
		}
		public function SetColors($value)
		{
			if ($this->type == self::TYPE_SOLID && !($value instanceof GChartColor))
				throw new Exception("for solid fill, value should be of type GChartColor");
			else if ($this->type != self::TYPE_SOLID && count($value) % 2)
				throw new Exception("for gradient and stripes, value should contain an even number of items");
				
			$this->colors = $value;
		}
		
		public function GetAngle()
		{
			return $this->angle;
		}
		public function SetAngle($value)
		{
			$this->angle = $value;
		}
		
		public function __ToString()
		{
			$str = sprintf("%s,%s", $this->area, $this->type);
			
			if ($this->type == self::TYPE_SOLID)
			{
				$str .= sprintf(",%s", $this->colors);
			}
			else
			{
				$str .= sprintf(",%d", $this->angle);
				for ($i = 0; $i < count($this->colors); $i += 2)
					$str .= sprintf(",%s,%.3f", $this->colors[$i], $this->colors[$i + 1]);
			}
			
			return $str;
		}
	}
?>
