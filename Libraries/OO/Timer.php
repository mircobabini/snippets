<?

class Timer
{
	private $times;
	private $pause_time = 0;

	/**
	 * @param bool $start 
	 */
	public function __construct ($start = false)
	{
		if ($start)
			$this->start ();
	}

	public function start ()
	{
		$this->times[] = microtime (true);
		$this->pause_time = 0;
		
		return $this;
	}

	/*  pause the timer  */
	public function pause ()
	{
		$this->pause_time = microtime (true);

		return $this;
	}

	/*  unpause the timer  */
	public function unpause ()
	{
		/* increment paused time for each partials */
		foreach (array_keys ($this->times) as $key)
			$this->times[$key] += (microtime (true) - $this->pause_time);

		$this->pause_time = 0;

		return $this;
	}

	/**
	 * @param int $decimals
	 * @return float
	 */
	public function partial ($decimals = 8)
	{
		return $this->get (end ($this->times), $decimals);
	}
	/**
	 * @param int $decimals
	 * @return float
	 */
	public function total ($decimals = 8)
	{
		return $this->get (reset ($this->times), $decimals);
	}
	/**
	 * @param float $start
	 * @param int $decimals
	 * @return float
	 */
	protected function get ($start, $decimals)
	{
		$stop_time = ($this->pause_time === 0) ? microtime (true) : $this->pause_time;
		return round (($stop_time - $start), $decimals);
	}
}

