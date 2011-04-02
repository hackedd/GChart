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
		
		const TEXT_MIN = 0;
		const TEXT_MAX = 100;
		const TEXT_MISSING_VALUE = "-1";
		const TEXT_MISSING_SET = "_";
			
		const SIMPLE_CHARSET = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		const SIMPLE_MIN = 0;
		const SIMPLE_MAX = 61;
		const SIMPLE_MISSING_VALUE = "_";
		const SIMPLE_MISSING_SET = "_";
		
		const EXTENDED_CHARSET = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-.";
		const EXTENDED_MIN = 0;
		const EXTENDED_MAX = 4095;
		const EXTENDED_WRAP = 64;
		const EXTENDED_MISSING_VALUE = "__";
		const EXTENDED_MISSING_SET = "_";
		
		const DEFAULT_SCALE_MARGIN = 0.00;
		
		const SCALE_ALL = 0;			// all sets are scaled to $min,$max, global min/max
		const SCALE_ODD = 1;			// only sets 1,3,... scaled, global min/max
		const SCALE_INDIVIDUAL = 2;		// all sets are scaled to $min,$max, individual min/max
		const SCALE_NONE = 50;			// do not scale
		
		const SCALE_FLAG_MASK	= 0xFF00;
		const SCALE_FLAG_ROUND = 0x0100; // expand max to a multiple of 10 before scaling
		const SCALE_FLAG_MIN_0  = 0x0200; // $min is zero for all sets
		
		/*
			$index is the number of data series that are used to draw 
			chart data. Other data series will not be drawn, but will 
			be available for positioning labels or markers.
		*/
		public static function SingleSetEncoding($encoding, $index)
		{
			return sprintf("%s%d", $encoding, $index + 1);
		}
		
		public static function ScaleSet($dataset, $scaleMin, $scaleMax, 
			$margin = self::DEFAULT_SCALE_MARGIN, $setMin, $setMax, $flags)
		{
			$tempSetMin = $setMin;
			$tempSetMax = $setMax;
			
			if ($setMin === false)
				$tempSetMin = ($flags & self::SCALE_FLAG_MIN_0) ? 0 : min($dataset);
			if ($setMax === false)
				$tempSetMax = ($flags & self::SCALE_FLAG_ROUND) ? self::ScaleUp(max($dataset)) : max($dataset);

			$tempMargin = $margin * ($tempSetMax - $tempSetMin);
			
			if ($setMin === false)
				$setMin = $tempSetMin - $tempMargin;
			if ($setMax === false)
				$setMax = $tempSetMax + $tempMargin;
			
			for ($i = 0; $i < count($dataset); $i += 1)
			{
				if ($dataset[$i] === false || $dataset[$i] === null)
					$dataset[$i] = false;
				else if ($setMin == $setMax)
					$dataset[$i] = ($scaleMax - $scaleMin) / 2;
				else
					$dataset[$i] = $scaleMin + $scaleMax * 
						(((float)$dataset[$i] - $setMin) / ($setMax - $setMin));
			}
			
			return $dataset;
		}
		
		public static function TextEncodeValue($value)
		{
			if ($value === false)
				return self::TEXT_MISSING_VALUE;
			
			$str = sprintf("%.1f", (float)$value);
			if (substr($str, -2) == ".0")
				$str = substr($str, 0, -2);
			return $str;
		}
			
		public static function TextEncodeSet($dataset, $scale = true, 
			$min = false, $max = false, $margin = self::DEFAULT_SCALE_MARGIN, $flags)
		{
			if ($dataset === false)
				return self::TEXT_MISSING_SET;
			
			if ($scale)
				$dataset = self::ScaleSet($dataset, self::TEXT_MIN, self::TEXT_MAX, $margin, $min, $max, $flags);
			
			return implode(",", array_map(array("self", "TextEncodeValue"), $dataset));
		}
		
		public static function SimpleEncodeValue($value)
		{
			if ($value === false)
				return self::SIMPLE_MISSING_VALUE;
			
			return substr(self::SIMPLE_CHARSET, $value, 1);
		}
		
		public static function SimpleEncodeSet($dataset, $scale = true, 
			$min = false, $max = false, $margin = self::DEFAULT_SCALE_MARGIN, $flags)
		{
			if ($dataset === false)
				return self::SIMPLE_MISSING_SET;
			
			if ($scale)
				$dataset = self::ScaleSet($dataset, self::SIMPLE_MIN, self::SIMPLE_MAX, $margin, $min, $max, $flags);
			
			return implode("", array_map(array("self", "SimpleEncodeValue"), $dataset));
		}
		
		public static function ExtendedEncodeValue($value)
		{
			if ($value === false)
				return self::EXTENDED_MISSING_VALUE;
			
			return substr(self::EXTENDED_CHARSET, $value / self::EXTENDED_WRAP, 1) .
				substr(self::EXTENDED_CHARSET, $value % self::EXTENDED_WRAP, 1);
		}
		
		public static function ExtendedEncodeSet($dataset, $scale = true, 
			$min = false, $max = false, $margin = self::DEFAULT_SCALE_MARGIN, $flags)
		{
			if ($dataset === false)
				return self::EXTENDED_MISSING_SET;
			
			if ($scale)
				$dataset = self::ScaleSet($dataset, self::EXTENDED_MIN, self::EXTENDED_MAX, $margin, $min, $max, $flags);
			
			return implode("", array_map(array("self", "ExtendedEncodeValue"), $dataset));
		}
		
		public static function ScaleUp($value)
		{
			$base = pow(10, floor(log($value, 10)));
			return ceil($value / $base) * $base;
		}
		
		public static function Encode($encoding, $datasets, $scale = self::SCALE_ALL, 
			$margin = self::DEAULT_SCALE_MARGIN)
		{
			$flags = $scale & self::SCALE_FLAG_MASK;
			$scale = $scale & ~self::SCALE_FLAG_MASK;

			if ($scale == self::SCALE_ALL)
			{
				$globalMin = min(array_map("min", $datasets));
				$globalMax = max(array_map("max", $datasets));
				$m = $margin * ($globalMax - $globalMin);
				$globalMin -= $m;
				$globalMax += $m;
			}
			else if ($scale == self::SCALE_ODD)
			{
				$globalMin = min($datasets[0]);
				$globalMax = max($datasets[0]);
				for ($i = 2; $i < count($datasets); $i += 2)
				{
					$globalMin = min($globalMin, min($datasets[$i]));
					$globalMax = max($globalMax, max($datasets[$i]));
				}
				$m = $margin * ($globalMax - $globalMin);
				$globalMin -= $m;
				$globalMax += $m;
			}			
			
			if ($flags & self::SCALE_FLAG_MIN_0)
				$globalMin = 0;
			if ($flags & self::SCALE_FLAG_ROUND)
				$globalMax = self::ScaleUp($globalMax);
			
			if ($encoding[0] == self::ENCODING_TEXT)
			{
				$encodeSet = array("self", "TextEncodeSet");
				$setDelim = "|";
			}
			else if ($encoding[0] == self::ENCODING_SIMPLE)
			{
				$encodeSet = array("self", "SimpleEncodeSet");
				$setDelim = ",";
			}
			else if ($encoding[0] == self::ENCODING_EXTENDED)
			{
				$encodeSet = array("self", "ExtendedEncodeSet");
				$setDelim = ",";
			}
			else
			{
				throw new Exception("Unknown encoding type");
			}
			
			$encoded = array();
			for ($i = 0; $i < count($datasets); $i += 1)
			{
				if ($scale == self::SCALE_ALL || ($scale == self::SCALE_ODD && ($i % 2) == 0))
					$encoded[$i] = call_user_func($encodeSet, $datasets[$i], true, $globalMin, $globalMax, false, $flags);
				else if ($scale == self::SCALE_INDIVIDUAL)
					$encoded[$i] = call_user_func($encodeSet, $datasets[$i], true, false, false, $margin, $flags);
				else
					$encoded[$i] = call_user_func($encodeSet, $datasets[$i], false, false, false, false, $flags);
			}
			
			return $encoding . ":" . implode($setDelim, $encoded);				
				
		}
	}
?>
