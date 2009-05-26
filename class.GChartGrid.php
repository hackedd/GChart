<?php
	class GChartGrid
	{
		private $xstep;
		private $ystep;
		private $line;
		private $blank;
		private $xoffset = false;
		private $yoffset = false;
		
		public function __construct($xstep, $ystep, $line = false, $blank = false)
		{
			$this->SetXStep($xstep);
			$this->SetYStep($ystep);
			$this->SetLine($line);
			$this->SetBlank($blank);
		}
		
		public function GetXStep()
		{
			return $this->xstep;
		}
		public function SetXStep($value)
		{
			$this->xstep = $value;
		}
		
		public function GetYStep()
		{
			return $this->ystep;
		}
		public function SetYStep($value)
		{
			$this->ystep = $value;
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

		public function GetXOffset()
		{
			return $this->xoffset;
		}
		public function SetXOffset($value)
		{
			$this->xoffset = $value;
		}
		
		public function GetYOffset()
		{
			return $this->yoffset;
		}
		public function SetYOffset($value)
		{
			$this->yoffset = $value;
		}
		
		public function __ToString()
		{
			$str = sprintf("%d,%d", $this->xstep, $this->ystep);
			
			if ($this->line === false || $this->blank === false)
				return $str;
			$str .= sprintf(",%d,%d", $this->line, $this->blank);
			
			if ($this->xoffset === false || $this->yoffset === false)
				return $str;
			$str .= sprintf(",%d,%d", $this->xoffset, $this->yoffset);
			
			return $str;
		}
	}
?>