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

	class RadarChart extends GChart
	{
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_RADAR);
			parent::SetSize($width, $height);
		}

		public function SetType($value)
		{
			if ($value != GChart::TYPE_RADAR && $value != GChart::TYPE_RADAR_SPLINES)
				throw new Exception("Invalid Chart Type for RadarChart");
			parent::SetType($value);
		}
		
		public function AddMarker($value)
		{
			if ($value->GetType() == TYPE_FINANCIAL)
				throw new Exception("RadarChart does not support Financial Markers");
			parent::AddMarker($value);
		}

		public function GetBarWidth()
		{
			throw new Exception("RadarChart does not support GetBarWidth");
		}

		public function SetBarWidth($value)
		{
			throw new Exception("RadarChart does not support SetBarWidth");
		}

		public function GetBarSpace()
		{
			throw new Exception("RadarChart does not support GetBarSpace");
		}

		public function SetBarSpace($value)
		{
			throw new Exception("RadarChart does not support SetBarSpace");
		}

		public function GetBarGroupSpace()
		{
			throw new Exception("RadarChart does not support GetBarGroupSpace");
		}

		public function SetBarGroupSpace($value)
		{
			throw new Exception("RadarChart does not support SetBarGroupSpace");
		}

		public function GetBarZeroLine()
		{
			throw new Exception("RadarChart does not support GetBarZeroLine");
		}

		public function SetBarZeroLine($value)
		{
			throw new Exception("RadarChart does not support SetBarZeroLine");
		}

		public function GetPieRotation()
		{
			throw new Exception("RadarChart does not support GetPieRotation");
		}

		public function SetPieRotation($value, $degrees = false)
		{
			throw new Exception("RadarChart does not support SetPieRotation");
		}
	}
?>
