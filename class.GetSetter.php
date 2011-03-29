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

	class GetSetter
	{
		// Override this if you want another naming pattern for your getters
		protected function GetGetterMethod($name)
		{
			return "Get" . ucfirst($name);
		}
		
		// Override this if you want another naming pattern for your setters
		protected function GetSetterMethod($name)
		{
			return "Set" . ucfirst($name);
		}
		
		public function __get($name)
		{
			$method = $this->GetGetterMethod($name);
			if (!method_exists($this, $method))
				throw new Exception("Unknown member variable " . $name);
			return $this->$method();
		}
		
		public function __set($name, $value)
		{
			$method = $this->GetSetterMethod($name);
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
			else
			{
				if (method_exists($this, $this->GetGetterMethod($name)))
					throw new Exception($name . " is read-only");
				$this->$name = $value;
			}
		}
	}
?>