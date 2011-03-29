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

	class GChartFillArea extends GetSetter
	{
		const MODE_BETWEEN = "b";
		const MODE_FROM_ZERO = "B";
		
		private $mode;
		private $color;
		private $start;
		private $end;
		
		public function __construct($mode, $color, $start, $end)
		{
			$this->SetMode($mode);
			$this->SetColor($color);
			$this->SetStart($start);
			$this->SetEnd($end);
		}
		
		public function GetMode()
		{
			return $this->mode;
		}
		public function SetMode($value)
		{
			$this->mode = $value;
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

		public function GetStart()
		{
			return $this->start;
		}
		public function SetStart($value)
		{
			$this->start = $value;
		}

		public function GetEnd()
		{
			return $this->end;
		}
		public function SetEnd($value)
		{
			$this->end = $value;
		}

		public function __ToString()
		{
			return sprintf("%s,%s,%s,%s,0", $this->mode, $this->color, $this->start, $this->end);
		}
	}
?>
