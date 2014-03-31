<?php

/**
 * @param object $object
 * @return array
 * call get_object_vars from neutral context even from a method
 */
function _get_object_vars ($object) {
	return get_object_vars ($object);
}