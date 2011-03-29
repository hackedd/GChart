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

	class VennDiagram extends GChart
	{
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_VENN);
			parent::SetSize($width, $height);
		}

		public function SetType($value)
		{
			throw new Exception("VennDiagram does not support SetType");
		}

		public function AddDataset($dataset)
		{
			if (count($this->datasets) >= 1)
				throw new Exception("VennDiagram does not support more than one dataset");
			parent::AddDataset($dataset);
		}
		
		public function GetAxisCount()
		{
			throw new Exception("VennDiagram does not support GetAxisCount");
		}

		public function GetAxis($index)
		{
			throw new Exception("VennDiagram does not support GetAxis");
		}

		public function AddAxis($value)
		{
			throw new Exception("VennDiagram does not support AddAxis");
		}

		public function RemoveAxis($index)
		{
			throw new Exception("VennDiagram does not support RemoveAxis");
		}

		public function GetGrid()
		{
			throw new Exception("VennDiagram does not support GetGrid");
		}

		public function SetGrid($value)
		{
			throw new Exception("VennDiagram does not support SetGrid");
		}

		public function GetMarkerCount()
		{
			throw new Exception("VennDiagram does not support GetMarkerCount");
		}

		public function GetMarker($index)
		{
			throw new Exception("VennDiagram does not support GetMarker");
		}

		public function AddMarker($value)
		{
			throw new Exception("VennDiagram does not support AddMarker");
		}

		public function RemoveMarker($index)
		{
			throw new Exception("VennDiagram does not support RemoveMarker");
		}

		public function GetLineStyles()
		{
			throw new Exception("VennDiagram does not support GetLineStyles");
		}

		public function SetLineStyles($value)
		{
			throw new Exception("VennDiagram does not support SetLineStyles");
		}

		public function GetBarWidth()
		{
			throw new Exception("VennDiagram does not support GetBarWidth");
		}

		public function SetBarWidth($value)
		{
			throw new Exception("VennDiagram does not support SetBarWidth");
		}

		public function GetBarSpace()
		{
			throw new Exception("VennDiagram does not support GetBarSpace");
		}

		public function SetBarSpace($value)
		{
			throw new Exception("VennDiagram does not support SetBarSpace");
		}

		public function GetBarGroupSpace()
		{
			throw new Exception("VennDiagram does not support GetBarGroupSpace");
		}

		public function SetBarGroupSpace($value)
		{
			throw new Exception("VennDiagram does not support SetBarGroupSpace");
		}

		public function GetBarZeroLine()
		{
			throw new Exception("VennDiagram does not support GetBarZeroLine");
		}

		public function SetBarZeroLine($value)
		{
			throw new Exception("VennDiagram does not support SetBarZeroLine");
		}

		public function GetPieRotation()
		{
			throw new Exception("VennDiagram does not support GetPieRotation");
		}

		public function SetPieRotation($value, $degrees = false)
		{
			throw new Exception("VennDiagram does not support SetPieRotation");
		}
	}
?>
