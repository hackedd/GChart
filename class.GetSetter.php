<?php
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