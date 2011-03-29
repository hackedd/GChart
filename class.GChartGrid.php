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

	class GChartGrid extends GetSetter
	{
		private $xstep;
		private $ystep;
		private $line;
		private $blank;
		private $xoffset = false;
		private $yoffset = false;
		
		public function __construct($xstep, $ystep, $line = false, $blank = false)
		{
			$this->SetXStep($xstep);
			$this->SetYStep($ystep);
			$this->SetLine($line);
			$this->SetBlank($blank);
		}
		
		public function GetXStep()
		{
			return $this->xstep;
		}
		public function SetXStep($value)
		{
			$this->xstep = $value;
		}
		
		public function GetYStep()
		{
			return $this->ystep;
		}
		public function SetYStep($value)
		{
			$this->ystep = $value;
		}

		public function GetLine()
		{
			return $this->line;
		}
		public function SetLine($value)
		{
			$this->line = $value;
		}
		
		public function GetBlank()
		{
			return $this->blank;
		}
		public function SetBlank($value)
		{
			$this->blank = $value;
		}

		public function GetXOffset()
		{
			return $this->xoffset;
		}
		public function SetXOffset($value)
		{
			$this->xoffset = $value;
		}
		
		public function GetYOffset()
		{
			return $this->yoffset;
		}
		public function SetYOffset($value)
		{
			$this->yoffset = $value;
		}
		
		public function __ToString()
		{
			$str = sprintf("%d,%d", $this->xstep, $this->ystep);
			
			if ($this->line === false || $this->blank === false)
				return $str;
			$str .= sprintf(",%d,%d", $this->line, $this->blank);
			
			if ($this->xoffset === false || $this->yoffset === false)
				return $str;
			$str .= sprintf(",%d,%d", $this->xoffset, $this->yoffset);
			
			return $str;
		}
	}
?>