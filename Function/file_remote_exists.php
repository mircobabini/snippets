<?
function file_remote_exists ($path)
{
	$handle = @fopen ($path, "r"); // forse dovrei fare anche la close
	return (bool)$handle;
}