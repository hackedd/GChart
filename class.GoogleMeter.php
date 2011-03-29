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

	class GoogleMeter extends GChart
	{
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_GOOGLE_O_METER);
			parent::SetSize($width, $height);
			parent::SetMargin(0);
			parent::SetScale(GChartEncoder::SCALE_NONE);
		}
		
		public function GetValue()
		{
			if (count($this->datasets) < 0)
				return false;
			return $this->datasets[0][0];
		}
		
		public function SetValue($value)
		{
			if (!is_numeric($value) || $value < 0 || $value > 100)
				throw new Exception("GoogleMeter accepts values between 0 and 100");
			$this->datasets = array(array((int)$value));
		}
		
		public function AddDataset($dataset)
		{
			throw new Exception("GoogleMeter does not suppor AddDataset");
		}

		public function SetType($value)
		{
			throw new Exception("GoogleMeter does not support SetType");
		}

		public function GetFillAreaCount()
		{
			throw new Exception("GoogleMeter does not support GetFillAreaCount");
		}

		public function GetFillArea($index)
		{
			throw new Exception("GoogleMeter does not support GetFillArea");
		}

		public function AddFillArea($value)
		{
			throw new Exception("GoogleMeter does not support AddFillArea");
		}

		public function RemoveFillArea($index)
		{
			throw new Exception("GoogleMeter does not support RemoveFillArea");
		}

		public function GetAxisCount()
		{
			throw new Exception("GoogleMeter does not support GetAxisCount");
		}

		public function GetAxis($index)
		{
			throw new Exception("GoogleMeter does not support GetAxis");
		}

		public function AddAxis($value)
		{
			throw new Exception("GoogleMeter does not support AddAxis");
		}

		public function RemoveAxis($index)
		{
			throw new Exception("GoogleMeter does not support RemoveAxis");
		}

		public function GetGrid()
		{
			throw new Exception("GoogleMeter does not support GetGrid");
		}

		public function SetGrid($value)
		{
			throw new Exception("GoogleMeter does not support SetGrid");
		}

		public function GetMarkerCount()
		{
			throw new Exception("GoogleMeter does not support GetMarkerCount");
		}

		public function GetMarker($index)
		{
			throw new Exception("GoogleMeter does not support GetMarker");
		}

		public function AddMarker($value)
		{
			throw new Exception("GoogleMeter does not support AddMarker");
		}

		public function RemoveMarker($index)
		{
			throw new Exception("GoogleMeter does not support RemoveMarker");
		}

		public function GetLineStyles()
		{
			throw new Exception("GoogleMeter does not support GetLineStyles");
		}

		public function SetLineStyles($value)
		{
			throw new Exception("GoogleMeter does not support SetLineStyles");
		}

		public function GetBarWidth()
		{
			throw new Exception("GoogleMeter does not support GetBarWidth");
		}

		public function SetBarWidth($value)
		{
			throw new Exception("GoogleMeter does not support SetBarWidth");
		}

		public function GetBarSpace()
		{
			throw new Exception("GoogleMeter does not support GetBarSpace");
		}

		public function SetBarSpace($value)
		{
			throw new Exception("GoogleMeter does not support SetBarSpace");
		}

		public function GetBarGroupSpace()
		{
			throw new Exception("GoogleMeter does not support GetBarGroupSpace");
		}

		public function SetBarGroupSpace($value)
		{
			throw new Exception("GoogleMeter does not support SetBarGroupSpace");
		}

		public function GetBarZeroLine()
		{
			throw new Exception("GoogleMeter does not support GetBarZeroLine");
		}

		public function SetBarZeroLine($value)
		{
			throw new Exception("GoogleMeter does not support SetBarZeroLine");
		}

		public function GetPieRotation()
		{
			throw new Exception("GoogleMeter does not support GetPieRotation");
		}

		public function SetPieRotation($value, $degrees = false)
		{
			throw new Exception("GoogleMeter does not support SetPieRotation");
		}
	}
?>
