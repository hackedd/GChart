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

	class BarChart extends GChart
	{
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_BARCHART_V);
			parent::SetSize($width, $height);
			parent::SetMargin(0);
			parent::SetBarWidth(GChart::BAR_WIDTH_AUTO);
		}

		public function SetType($value)
		{
			if ($value != GChart::TYPE_BARCHART_H && 
				$value != GChart::TYPE_BARCHART_V && 
				$value != GChart::TYPE_BARCHART_H_GROUPED && 
				$value != GChart::TYPE_BARCHART_V_GROUPED)
				throw new Exception("Invalid Chart Type for BarChart");
			parent::SetType($value);
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
