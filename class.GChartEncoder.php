<?php
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
		
		const DEFAULT_SCALE_MARGIN = 0.05; // 5%
		
		const SCALE_ALL = 0;			// all sets are scaled to $min,$max, global min/max
		const SCALE_ODD = 1;			// only sets 1,3,... scaled, global min/max
		const SCALE_INDIVIDUAL = 2;		// all sets are scaled to $min,$max, individual min/max
		const SCALE_NONE = 50;			// do not scale
		
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
			$margin = self::DEFAULT_SCALE_MARGIN, $setMin = false, $setMax = false)
		{
			$tempSetMin = $setMin;
			$tempSetMax = $setMax;
			
			if ($setMin === false)
				$tempSetMin = min($dataset);
			if ($setMax === false)
				$tempSetMax = max($dataset);

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
			$min = false, $max = false, $margin = self::DEFAULT_SCALE_MARGIN)
		{
			if ($dataset === false)
				return self::TEXT_MISSING_SET;
			
			if ($scale)
				$dataset = self::ScaleSet($dataset, self::TEXT_MIN, self::TEXT_MAX, $margin, $min, $max);
			
			return implode(",", array_map(array("self", "TextEncodeValue"), $dataset));
		}
		
		public static function SimpleEncodeValue($value)
		{
			if ($value === false)
				return self::SIMPLE_MISSING_VALUE;
			
			return substr(self::SIMPLE_CHARSET, $value, 1);
		}
		
		public static function SimpleEncodeSet($dataset, $scale = true, 
			$min = false, $max = false, $margin = self::DEFAULT_SCALE_MARGIN)
		{
			if ($dataset === false)
				return self::SIMPLE_MISSING_SET;
			
			if ($scale)
				$dataset = self::ScaleSet($dataset, self::SIMPLE_MIN, self::SIMPLE_MAX, $margin, $min, $max);
			
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
			$min = false, $max = false, $margin = self::DEFAULT_SCALE_MARGIN)
		{
			if ($dataset === false)
				return self::EXTENDED_MISSING_SET;
			
			if ($scale)
				$dataset = self::ScaleSet($dataset, self::EXTENDED_MIN, self::EXTENDED_MAX, $margin, $min, $max);
			
			return implode("", array_map(array("self", "ExtendedEncodeValue"), $dataset));
		}
		
		public static function Encode($encoding, $datasets, $scale = self::SCALE_ALL, 
			$margin = self::DEAULT_SCALE_MARGIN)
		{
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
					$encoded[$i] = call_user_func($encodeSet, $datasets[$i], true, $globalMin, $globalMax, false);
				else if ($scale == self::SCALE_INDIVIDUAL)
					$encoded[$i] = call_user_func($encodeSet, $datasets[$i], true, false, false, $margin);
				else
					$encoded[$i] = call_user_func($encodeSet, $datasets[$i], false, false, false, false);
			}
			
			return $encoding . ":" . implode($setDelim, $encoded);				
				
		}
	}
?>