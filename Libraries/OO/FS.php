<?php
class FS {
	/**
	 * @var string The basepath without ending slash
	 */
	protected $basedir;
	
	/**
	 * @param string $basedir Absolute basepath
	 */
	public function __construct ($basedir) {
		$basedir = untrailingslashit ($basedir);
		@mkdir ($basedir);

		$this->basedir = $basedir;
	}
	
	public function subfs ($path) {
		$path = ltrim ($path, '/');
		$fullpath = $this->basedir . '/' . $path;
		return new self ($fullpath);
	}

	/**
	 * Absolute filepath
	 * @param string $filepath Relative filepath
	 * @return string
	 */
	public function path ($filepath) {
		$filepath = '/' . ltrim ($filepath, '/');

		return $this->basedir . $filepath;
	}
	/**
	 * @param string $filepath
	 * @return bool
	 */
	public function exists ($filepath) {
		$filepath = $this->path ($filepath);
		return file_exists ($filepath);
	}
	public function raw ($filepath) {
		$filepath = $this->path ($filepath);
		if (!file_exists ($filepath)) {
			return false;
		}

		return @file_get_contents ($filepath);
	}
	public function json ($filepath, $assoc = false) {
		$raw = $this->raw ($filepath);
		if ($raw === false) {
			return false;
		}
		
		return json_decode ($raw, $assoc);
	}
	public function json_a ($filepath) {
		return $this->json ($filepath, ARRAY_A);
	}
	public function json_n ($filepath) {
		return $this->json ($filepath, ARRAY_N);
	}
	
	public function put ($filepath, $data) {
		$filepath = $this->path ($filepath);
		
		if (is_array ($data) || is_object ($data)) {
			$data = json_prettify (json_encode ($data));
		}
		
		@mkdir (dirname ($filepath), 0777, true);

		@touch ($filepath);
		@file_put_contents ($filepath, $data);
		
		return @file_get_contents ($filepath);
	}
	public function age ($filepath) {
		$filepath = $this->path ($filepath);
		
	}
	
	public function copy ($source, $dest){
		return( $this->put($dest, $this->raw($source)) !== FALSE );
	}
	public function move ($source, $dest){
		// n
		$success = $this->copy ($source, $dest);
		if ($success) {
			return $this->delete ($source);
		}
		
		return false;
	}
	public function delete ($source){
		$filepath = $this->path($source);
		return unlink($filepath);
	}
}
