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

	class LineChart extends GChart
	{
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_LINECHART);
			parent::SetSize($width, $height);
		}
		
		public function SetType($value)
		{
			if ($value != GChart::TYPE_LINECHART && $value != GChart::TYPE_XY_LINECHART && $value != GChart::TYPE_SPARKLINES)
				throw new Exception("Invalid Chart Type for LineChart");
			parent::SetType($value);
		}
		
		public function GetBarWidth()
		{
			throw new Exception("LineChart does not support GetBarWidth");
		}

		public function SetBarWidth($value)
		{
			throw new Exception("LineChart does not support SetBarWidth");
		}

		public function GetBarSpace()
		{
			throw new Exception("LineChart does not support GetBarSpace");
		}

		public function SetBarSpace($value)
		{
			throw new Exception("LineChart does not support SetBarSpace");
		}

		public function GetBarGroupSpace()
		{
			throw new Exception("LineChart does not support GetBarGroupSpace");
		}

		public function SetBarGroupSpace($value)
		{
			throw new Exception("LineChart does not support SetBarGroupSpace");
		}

		public function GetBarZeroLine()
		{
			throw new Exception("LineChart does not support GetBarZeroLine");
		}

		public function SetBarZeroLine($value)
		{
			throw new Exception("LineChart does not support SetBarZeroLine");
		}

		public function GetPieRotation()
		{
			throw new Exception("BarChart does not support GetPieRotation");
		}
		
		public function SetPieRotation($value)
		{
			throw new Exception("BarChart does not support SetPieRotation");
		}
	}
?>
