<?
/**
 * A CacheItem is a package (directory) containing
 * various and arbitrary properties (files).
 */
class CacheItem
{
	public $itemPath;
	public $itemName;
	
	public function __construct ($itemPath, $itemName)
	{
		$this->itemPath = $itemPath;
		$this->itemName = $itemName;
	}
	/**
	 * @param String $propName
	 * @return null|\CacheItemProp
	 */
	public function get ($propName)
	{
		$propPath = $this->itemPath . $propName;
		return new CacheItemProp ($propPath, $propName);
	}
	/**
	 * @param String $propName
	 * @param mixed $content
	 */
	public function set ($propName, $content)
	{
		$cacheItemProp = $this->get ($propName);
		$cacheItemProp->content ($content);
		
		return $this;
	}
	
	public function uncache ()
	{
		return rrmdir ($this->itemPath);
	}
}