<?php
	class GChartColor extends GetSetter
	{
		const TRANSPARENT = 0x00;
		const OPAQUE = 0xFF;
		
		private $r, $g, $b, $a;
		
		public function __construct($r, $g = 0, $b = 0, $a = self::OPAQUE)
		{
			if (!is_numeric($r))
			{
				if (substr($r, 0, 1) == "#")
					$r = substr($r, 1);
					
				if (strlen($r) == 6 || strlen($r) == 8)
				{
					$hex = $r;
					
					$r = hexdec(substr($hex, 0, 2));
					$g = hexdec(substr($hex, 2, 2));
					$b = hexdec(substr($hex, 4, 2));
					if (strlen($hex) == 8)
						$a = hexdec(substr($hex, 6, 2));
				}
				else
				{
					$r = 0;
				}
			}
			
			$this->SetR($r);
			$this->SetG($g);
			$this->SetB($b);
			$this->SetA($a);
		}
		
		public function GetR()
		{
			return $this->r;
		}
		public function SetR($value)
		{
			if ($value >= 0 && $value <= 1)
				$value *= 0xFF;
			$this->r = $value;
		}
		
		public function GetG()
		{
			return $this->g;
		}
		public function SetG($value)
		{
			if ($value >= 0 && $value <= 1)
				$value *= 0xFF;
			$this->g = $value;
		}
		
		public function GetB()
		{
			return $this->b;
		}
		public function SetB($value)
		{
			if ($value >= 0 && $value <= 1)
				$value *= 0xFF;
			$this->b = $value;
		}
		
		public function GetA()
		{
			return $this->a;
		}
		public function SetA($value)
		{
			if ($value >= 0 && $value <= 1)
				$value *= 0xFF;
			$this->a = $value;
		}
		
		public function __ToString()
		{
			$hex = sprintf("%02X%02X%02X", $this->r, $this->g, $this->b);
			if ($this->a != self::OPAQUE)
				$hex .= sprintf("%02X", $this->a);
			return $hex;
		}
	}
?>
