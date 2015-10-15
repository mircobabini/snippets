<?
function trim_object( $data ){
	if( is_string( $data ) ){
        return trim( $data );

	}else if( is_object( $data ) ){
	    $vars = get_object_vars( $data );
	    foreach( $vars as $var_key => $var_value ){
	    	$data->$var_key = trim_object( $var_value );
	    }

	}else if( is_array( $data ) ){
		return trim_array( $data );
	}

    return $data;
}
