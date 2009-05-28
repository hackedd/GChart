<?php
	class GChartLineStyle extends GetSetter
	{
		private $thickness;
		private $line;
		private $blank;
		
		public function __construct($thickness = 1, $line = 1, $blank = 0)
		{
			$this->SetThickness($thickness);
			$this->SetLine($line);
			$this->SetBlank($blank);
		}
		
		public function GetThickness()
		{
			return $this->thickness;
		}
		public function SetThickness($value)
		{
			$this->thickness = $value;
		}

		public function GetLine()
		{
			return $this->line;
		}
		public function SetLine($value)
		{
			$this->line = $value;
		}
		
		public function GetBlank()
		{
			return $this->blank;
		}
		public function SetBlank($value)
		{
			$this->blank = $value;
		}
		
		public function __ToString()
		{
			return sprintf("%d,%d,%d", $this->thickness, $this->line, $this->blank);
		}
	}
?>