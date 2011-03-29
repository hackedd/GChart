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

	class ScatterPlot extends GChart
	{
		public function __construct($width, $height)
		{
			parent::SetType(GChart::TYPE_SCATTER);
			parent::SetSize($width, $height);
			parent::SetMargin(0);
		}

		public function SetType($value)
		{
			throw new Exception("ScatterPlot does not support SetType");
		}

		public function AddDataset($dataset)
		{
			if (count($this->datasets) >= 3)
				throw new Exception("ScatterPlot does not support more than three datasets");
			parent::AddDataset($dataset);
		}
		
		public function Render($attributes = false)
		{
			if (count($this->datasets) < 2)
				throw new Exception("You need to specify at least two datasets for a ScatterPlot");
			return parent::Render($attributes);
		}
		
		public function AddMarker($value)
		{
			if ($value->GetType() == TYPE_FINANCIAL)
				throw new Exception("ScatterPlot does not support Financial Markers");
			parent::AddMarker($value);
		}

		public function GetLineStyles()
		{
			throw new Exception("ScatterPlot does not support GetLineStyles");
		}

		public function SetLineStyles($value)
		{
			throw new Exception("ScatterPlot does not support SetLineStyles");
		}

		public function GetFillAreaCount()
		{
			throw new Exception("ScatterPlot does not support GetFillAreaCount");
		}
		
		public function GetFillArea($index)
		{
			throw new Exception("ScatterPlot does not support GetFillArea");
		}
		
		public function AddFillArea($value)
		{
			throw new Exception("ScatterPlot does not support AddFillArea");
		}
		
		public function RemoveFillArea($index)
		{
			throw new Exception("ScatterPlot does not support RemoveFillArea");
		}
		
		public function GetBarWidth()
		{
			throw new Exception("ScatterPlot does not support GetBarWidth");
		}

		public function SetBarWidth($value)
		{
			throw new Exception("ScatterPlot does not support SetBarWidth");
		}

		public function GetBarSpace()
		{
			throw new Exception("ScatterPlot does not support GetBarSpace");
		}

		public function SetBarSpace($value)
		{
			throw new Exception("ScatterPlot does not support SetBarSpace");
		}

		public function GetBarGroupSpace()
		{
			throw new Exception("ScatterPlot does not support GetBarGroupSpace");
		}

		public function SetBarGroupSpace($value)
		{
			throw new Exception("ScatterPlot does not support SetBarGroupSpace");
		}

		public function GetBarZeroLine()
		{
			throw new Exception("ScatterPlot does not support GetBarZeroLine");
		}

		public function SetBarZeroLine($value)
		{
			throw new Exception("ScatterPlot does not support SetBarZeroLine");
		}

		public function GetPieRotation()
		{
			throw new Exception("ScatterPlot does not support GetPieRotation");
		}

		public function SetPieRotation($value, $degrees = false)
		{
			throw new Exception("ScatterPlot does not support SetPieRotation");
		}
	}
?>
