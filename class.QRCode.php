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

	class QRCode extends GChart
	{
		const ENCODING_DEFAULT = self::ENCODING_UTF8;
		const ENCODING_UTF8 = "UTF-8";
		const ENCODING_SHIFT_JIS = "Shift_JIS";
		const ENCODING_LATIN1 = "ISO-8859-1";
		
		const EC_7 = "L";
		const EC_15 = "M";
		const EC_25 = "Q";
		const EC_30 = "H";
		
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_QR_CODE);
			parent::SetSize($width, $height);
		}
		
		public function GetValue()
		{
			if (($legend = parent::GetLegend()) === false)
				return false;
			return $legend[0];
		}
		public function SetValue($value)
		{
			parent::SetLegend(array($value));
		}
		
		public function GetMargin()
		{
			return $this->qrMargin;
		}
		public function SetMargin($value)
		{
			$this->qrMargin = $value;
		}
		
		public function GetECLevel()
		{
			return $this->qrECLevel;
		}
		public function SetECLevel($value)
		{
			$this->qrECLevel = $value;
		}
		
		public function GetEncoding()
		{
			return $this->qrEncoding;
		}
		public function SetEncoding($value)
		{
			$this->qrEncoding = $value;
		}
		
		public function SetType($value)
		{
			throw new Exception("QRCode does not support SetType");
		}

		public function GetFillAreaCount()
		{
			throw new Exception("QRCode does not support GetFillAreaCount");
		}

		public function GetFillArea($index)
		{
			throw new Exception("QRCode does not support GetFillArea");
		}

		public function AddFillArea($value)
		{
			throw new Exception("QRCode does not support AddFillArea");
		}

		public function RemoveFillArea($index)
		{
			throw new Exception("QRCode does not support RemoveFillArea");
		}

		public function GetFillCount()
		{
			throw new Exception("QRCode does not support GetFillCount");
		}

		public function GetFill($index)
		{
			throw new Exception("QRCode does not support GetFill");
		}

		public function AddFill($value)
		{
			throw new Exception("QRCode does not support AddFill");
		}

		public function RemoveFill($index)
		{
			throw new Exception("QRCode does not support RemoveFill");
		}

		public function GetTitle()
		{
			throw new Exception("QRCode does not support GetTitle");
		}

		public function SetTitle($value)
		{
			throw new Exception("QRCode does not support SetTitle");
		}

		public function GetTitleColor()
		{
			throw new Exception("QRCode does not support GetTitleColor");
		}

		public function SetTitleColor($value)
		{
			throw new Exception("QRCode does not support SetTitleColor");
		}

		public function GetTitleSize()
		{
			throw new Exception("QRCode does not support GetTitleSize");
		}

		public function SetTitleSize($value)
		{
			throw new Exception("QRCode does not support SetTitleSize");
		}

		public function GetLegend()
		{
			throw new Exception("QRCode does not support GetLegend");
		}

		public function SetLegend($values)
		{
			throw new Exception("QRCode does not support SetLegend");
		}

		public function GetLegendPosition()
		{
			throw new Exception("QRCode does not support GetLegendPosition");
		}

		public function SetLegendPosition($value)
		{
			throw new Exception("QRCode does not support SetLegendPosition");
		}

		public function GetAxisCount()
		{
			throw new Exception("QRCode does not support GetAxisCount");
		}

		public function GetAxis($index)
		{
			throw new Exception("QRCode does not support GetAxis");
		}

		public function AddAxis($value)
		{
			throw new Exception("QRCode does not support AddAxis");
		}

		public function RemoveAxis($index)
		{
			throw new Exception("QRCode does not support RemoveAxis");
		}

		public function GetGrid()
		{
			throw new Exception("QRCode does not support GetGrid");
		}

		public function SetGrid($value)
		{
			throw new Exception("QRCode does not support SetGrid");
		}

		public function GetMarkerCount()
		{
			throw new Exception("QRCode does not support GetMarkerCount");
		}

		public function GetMarker($index)
		{
			throw new Exception("QRCode does not support GetMarker");
		}

		public function AddMarker($value)
		{
			throw new Exception("QRCode does not support AddMarker");
		}

		public function RemoveMarker($index)
		{
			throw new Exception("QRCode does not support RemoveMarker");
		}

		public function GetLineStyles()
		{
			throw new Exception("QRCode does not support GetLineStyles");
		}

		public function SetLineStyles($value)
		{
			throw new Exception("QRCode does not support SetLineStyles");
		}

		public function GetBarWidth()
		{
			throw new Exception("QRCode does not support GetBarWidth");
		}

		public function SetBarWidth($value)
		{
			throw new Exception("QRCode does not support SetBarWidth");
		}

		public function GetBarSpace()
		{
			throw new Exception("QRCode does not support GetBarSpace");
		}

		public function SetBarSpace($value)
		{
			throw new Exception("QRCode does not support SetBarSpace");
		}

		public function GetBarGroupSpace()
		{
			throw new Exception("QRCode does not support GetBarGroupSpace");
		}

		public function SetBarGroupSpace($value)
		{
			throw new Exception("QRCode does not support SetBarGroupSpace");
		}

		public function GetBarZeroLine()
		{
			throw new Exception("QRCode does not support GetBarZeroLine");
		}

		public function SetBarZeroLine($value)
		{
			throw new Exception("QRCode does not support SetBarZeroLine");
		}

		public function GetPieRotation()
		{
			throw new Exception("QRCode does not support GetPieRotation");
		}

		public function SetPieRotation($value, $degrees = false)
		{
			throw new Exception("QRCode does not support SetPieRotation");
		}

	}
?>
