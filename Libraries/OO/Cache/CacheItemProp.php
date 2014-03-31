<?
/**
 * A CacheItemProp is a property of a CacheItem, ossia un file,
 * il quale puo' essere ad esempio il contenuto della risorsa o
 * qualsiasi altra informazione associata ad un determinato item
 * che si è opportunamente messo a cache.
 */
class CacheItemProp
{
	public $content;
	
	public $filePath;
	public $fileName;
	
	public function __construct ($filePath, $fileName)
	{
		$this->filePath = $filePath;
		$this->fileName = $fileName;
	}
	
	/**
	 * @param String $content
	 * @return String|\CacheItemProp
	 */
	public function content ($content = null)
	{
		if ($content === null)
		{
			if (!isset ($this->content))
				$this->content = @file_get_contents ($this->filePath);
			
			return $this->content;
		}
		else
		{
			if (is_string ($content))
			{
				$this->content = $content;
				file_put_contents ($this->filePath, $this->content);
			}
			else
			{
				$this->json ($content);
			}

			return $this;
		}
	}
	/**
	 * @param mixed $data
	 * @return mixed|\CacheItemProp
	 */
	public function json ($data = null)
	{
		if ($data === null)
		{
			// i want to return the content as json obj
			$content = $this->content ();
			$json = json_decode ($content);
			
			// check if json was valid
			if (json_last_error () === JSON_ERROR_SYNTAX)
				return null;
			
			return $json;
		}
		else
		{
			$content = json_encode ($data);
			$this->content ($content);
			
			return $this;
		}
	}
	
	public function __toString ()
	{
		return $this->content ();
	}
}