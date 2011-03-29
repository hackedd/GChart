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

	class GChartLineStyle extends GetSetter
	{
		private $thickness;
		private $line;
		private $blank;
		
		public function __construct($thickness = 1, $line = 1, $blank = 0)
		{
			$this->SetThickness($thickness);
			$this->SetLine($line);
			$this->SetBlank($blank);
		}
		
		public function GetThickness()
		{
			return $this->thickness;
		}
		public function SetThickness($value)
		{
			$this->thickness = $value;
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
		
		public function __ToString()
		{
			return sprintf("%d,%d,%d", $this->thickness, $this->line, $this->blank);
		}
	}
?>