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

	// http://code.google.com/apis/chart/formats.html
	class GChartEncoder
	{
		const ENCODING_TEXT = "t";
		const ENCODING_SIMPLE = "s";
		const ENCODING_EXTENDED = "e";
		
		const SCALE_ALL = 0;				// all sets are scaled to $min,$max, global min/max
		const SCALE_ODD = 1;				// only sets 1,3,... scaled, global min/max
		const SCALE_INDIVIDUAL = 2;			// all sets are scaled to $min,$max, individual min/max
		const SCALE_NONE = 50;				// do not scale
		
		const SCALE_FLAG_MASK = 0xFF00;
		const SCALE_FLAG_ROUND = 0x0100;	// round min and max to round numbers
		const SCALE_FLAG_MIN_0 = 0x0200;	// $min is zero for all sets

		protected $encoding;
		protected $scale;
		protected $flagRound;
		protected $minZero;
		protected $min, $max;
		protected $setDelim, $valueDelim;
		
		protected function __construct($scale, $flags)
		{
			$this->scale = $scale;
			
			$this->flagRound = (bool)($flags & self::SCALE_FLAG_ROUND);
			$this->minZero = (bool)($flags & self::SCALE_FLAG_MIN_0);
		}
		
		public function Encode($datasets)
		{
			if ($this->scale == self::SCALE_ALL)
			{
				$globalMin = min(array_map("min", $datasets));
				$globalMax = max(array_map("max", $datasets));
			}
			else if ($this->scale == self::SCALE_ODD)
			{
				$globalMin = min($datasets[0]);
				$globalMax = max($datasets[0]);
				for ($i = 2; $i < count($datasets); $i += 2)
				{
					$globalMin = min($globalMin, min($datasets[$i]));
					$globalMax = max($globalMax, max($datasets[$i]));
				}
			}
			
			if ($this->minZero)
				$globalMin = 0;
			if ($this->flagRound)
			{
				$globalMax = self::RoundUp($setMax);
				if ($globalMin > 0)
					$globalMin = self::RoundDown($globalMin, $globalMax);
			}
			
			$encoded = array();
			for ($i = 0, $c = count($datasets); $i < $c; $i += 1)
			{
				if ($this->scale == self::SCALE_INDIVIDUAL)
					$set = self::ScaleSet($datasets[$i], false, false);
				else if ($this->scale == self::SCALE_ALL || ($this->scale == self::SCALE_ODD && ($i % 2) == 1))
					$set = self::ScaleSet($datasets[$i], $globalMin, $globalMax);
				else
					$set = $datasets[$i];
				
				$encoded[] = $this->EncodeSet($set);
			}
			
			return $this->encoding . ":" . implode($this->setDelim, $encoded);
		}

		protected function EncodeSet($dataset)
		{
			if ($dataset === false)
				return self::EXTENDED_MISSING_SET;
			
			return implode($this->valueDelim, array_map(array($this, "EncodeValue"), $dataset));
		}

		protected function ScaleSet($dataset, $setMin, $setMax)
		{
			if ($setMin === false)
				$setMin = $this->minZero ? 0 : min($dataset);
			if ($setMax === false)
				$setMax = max($dataset);
			
			if ($this->flagRound)
			{
				$setMax = self::RoundUp($setMax);
				if ($setMin > 0)
					$setMin = self::RoundDown($setMin, $setMax);
			}
			
			for ($i = 0; $i < count($dataset); $i += 1)
			{
				if ($dataset[$i] === false || $dataset[$i] === null)
					$dataset[$i] = false;
				else if ($setMin == $setMax)
					$dataset[$i] = ($this->max - $this->min) / 2;
				else
					$dataset[$i] = $this->min + $this->max * 
						(((float)$dataset[$i] - $setMin) / ($setMax - $setMin));
			}
			
			return $dataset;
		}

		public static function GetEncoder($type, $scale)
		{
			$flags = $scale & self::SCALE_FLAG_MASK;
			$scale = $scale & ~self::SCALE_FLAG_MASK;
			
			if ($type == self::ENCODING_TEXT)
				$e = new GChartTextEncoder($scale, $flags);
			else if ($type == self::ENCODING_SIMPLE)
				$e = new GChartSimpleEncoder($scale, $flags);
			else if ($type == self::ENCODING_EXTENDED)
				$e = new GChartExtendedEncoder($scale, $flags);
			else
				throw new Exception("Unknown encoding type");
				
			$e->encoding = $type;
			return $e;
		}

		public static function RoundUp($value, $max = false)
		{
			if ($max == false)
				$max = $value;
				
			$base = pow(10, floor(log($max, 10)));
			return ceil($value / $base) * $base;
		}

		public static function RoundDown($value, $max = false)
		{
			if ($max == false)
				$max = $value;
				
			$base = pow(10, floor(log($max, 10)));
			return floor($value / $base) * $base;
		}
	}
?>
