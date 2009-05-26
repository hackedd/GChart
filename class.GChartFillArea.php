<?php
	class GChartFillArea
	{
		const MODE_BETWEEN = "b";
		const MODE_FROM_ZERO = "B";
		
		private $mode;
		private $color;
		private $start;
		private $end;
		
		public function __construct($mode, $color, $start, $end)
		{
			$this->SetMode($mode);
			$this->SetColor($color);
			$this->SetStart($start);
			$this->SetEnd($end);
		}
		
		public function GetMode()
		{
			return $this->mode;
		}
		public function SetMode($value)
		{
			$this->mode = $value;
		}

		public function GetColor()
		{
			return $this->color;
		}
		public function SetColor($value)
		{
			if (!($value instanceof GChartColor))
				throw new Exception("value should be of type GChartColor");
			$this->color = $value;
		}

		public function GetStart()
		{
			return $this->start;
		}
		public function SetStart($value)
		{
			$this->start = $value;
		}

		public function GetEnd()
		{
			return $this->end;
		}
		public function SetEnd($value)
		{
			$this->end = $value;
		}

		public function __ToString()
		{
			return sprintf("%s,%s,%s,%s,0", $this->mode, $this->color, $this->start, $this->end);
		}
	}
?>
