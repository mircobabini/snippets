<?
class Cache
{
	const CACHE_MODE_ONLY_READ		= 0;
	const CACHE_MODE_ONLY_WRITE		= 1;
	const CACHE_MODE_READ_AND_WRITE = 2;


	/**
	 * @param type $itemPath
	 * @param type $itemName
	 * @return \CacheItem
	 */
	protected function getCacheItem ($itemPath, $itemName) {
		return new CacheItem ($itemPath, $itemName);
	}

	
	/**
	 * @var String
	 */
	private $basedirectory;
	/**
	 * @var int
	 */
	private $expire;
	/**
	 * @var int
	 */
	private $mode;
	
	/**
	 * @param String $directory
	 * @param int $expire 
	 */
	public function __construct ($directory, $expire = 0, $mode = 2)
	{
		if (!is_dir ($directory) && !mkdir ($directory))
			throw new Exception ("impossible to create cache directory " . $directory);
		
		$this->basedirectory = realpath ($directory) . "/";
		$this->expire = $expire;
		$this->mode = $mode;
	}
	/**
	 * @param String $itemName
	 * @return CacheItem 
	 */
	public function get ($itemName)
	{
		if (!$this->readable ())
			return null;
		
		$itemPath = $this->basedirectory . $itemName . "/";
		if (!file_exists ($itemPath) || !is_dir ($itemPath))
			return null;
		
		if ($this->expire != 0 && filemtime ($itemPath) < time () - $this->expire)
			return null;
		
		return $this->getCacheItem ($itemPath, $itemName);
	}
	/**
	 * @param String $filename
	 * @param array $data
	 * @return CacheItem 
	 */
	public function set ($itemName, $data = array ())
	{
		if (!$this->writable ())
			return null;
		
		$itemPath = $this->basedirectory . $itemName . "/";
		if (file_exists ($itemPath))
		{
			if (is_dir ($itemPath))
				rrmdir ($itemPath);
			else
				unlink ($itemPath);
		}
		
		mkdir ($itemPath);
			
		$cacheitem = $this->getCacheItem ($itemPath, $itemName);
		foreach ($data as $propName => $content)
			$cacheitem->set ($propName, $content);
		
		return $cacheitem;
	}
	
	/**
	 * @param string $itemName
	 * @return boolean
	 */
	public function clean ($itemName = null)
	{
		if (!$this->writable ())
			return false;
		
		if ($itemName)
		{
			$item = $this->get ($itemName);
			if ($item === null)
				return false;
			
			return $this->get ($itemName)->uncache ();
		}

		rrmdir ($this->basedirectory);
		mkdir ($this->basedirectory);
		return true;
	}
	
	/**
	 * @return bool
	 */
	public function readable ()
	{
		return ($this->mode == self::CACHE_MODE_ONLY_READ ||
				$this->mode == self::CACHE_MODE_READ_AND_WRITE);
	}
	/**
	 * @return bool
	 */
	public function writable ()
	{
		return ($this->mode == self::CACHE_MODE_ONLY_WRITE ||
				$this->mode == self::CACHE_MODE_READ_AND_WRITE);
	}
}
