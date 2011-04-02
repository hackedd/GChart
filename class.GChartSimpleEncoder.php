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
	
	class GChartSimpleEncoder extends GChartEncoder
	{
		const SIMPLE_CHARSET = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		const SIMPLE_MIN = 0;
		const SIMPLE_MAX = 61;
		const SIMPLE_MISSING_VALUE = "_";
		const SIMPLE_MISSING_SET = "_";
		const SIMPLE_SET_DELIM = ",";
		
		public function __construct($scale, $flags)
		{
			parent::__construct($scale, $flags);
			$this->min = self::SIMPLE_MIN;
			$this->max = self::SIMPLE_MAX;
			$this->setDelim = self::SIMPLE_SET_DELIM;
			$this->valueDelim = "";
		}

		public function EncodeValue($value)
		{
			if ($value === false)
				return self::SIMPLE_MISSING_VALUE;
			
			return substr(self::SIMPLE_CHARSET, $value, 1);
		}
	}
?>
