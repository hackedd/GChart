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
	
	class GChartExtendedEncoder extends GChartEncoder
	{
		const EXTENDED_CHARSET = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-.";
		const EXTENDED_MIN = 0;
		const EXTENDED_MAX = 4095;
		const EXTENDED_WRAP = 64;
		const EXTENDED_MISSING_VALUE = "__";
		const EXTENDED_MISSING_SET = "_";
		const EXTENDED_SET_DELIM = ",";

		public function __construct($scale, $flags)
		{
			parent::__construct($scale, $flags);
			$this->min = self::EXTENDED_MIN;
			$this->max = self::EXTENDED_MAX;
			$this->setDelim = self::EXTENDED_SET_DELIM;
			$this->valueDelim = "";
		}

		public function EncodeValue($value)
		{
			if ($value === false)
				return self::EXTENDED_MISSING_VALUE;
			
			return substr(self::EXTENDED_CHARSET, $value / self::EXTENDED_WRAP, 1) .
				substr(self::EXTENDED_CHARSET, $value % self::EXTENDED_WRAP, 1);
		}
	}
?>
