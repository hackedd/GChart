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
	
	class GChartTextEncoder extends GChartEncoder
	{
		const TEXT_MIN = 0;
		const TEXT_MAX = 100;
		const TEXT_MISSING_VALUE = "-1";
		const TEXT_MISSING_SET = "_";
		const TEXT_SET_DELIM = "|";
				
		public function __construct($scale, $flags)
		{
			parent::__construct($scale, $flags);
			$this->min = self::TEXT_MIN;
			$this->max = self::TEXT_MAX;
			$this->setDelim = self::TEXT_SET_DELIM;
			$this->valueDelim = ",";
		}

		public function EncodeValue($value)
		{
			if ($value === false)
				return self::TEXT_MISSING_VALUE;
			
			$str = sprintf("%.1f", (float)$value);
			if (substr($str, -2) == ".0")
				$str = substr($str, 0, -2);
			return $str;
		}
	}
?>
