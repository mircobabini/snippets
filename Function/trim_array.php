<?
function trim_array( $data ){
	if( is_string( $data ) ){
        return trim( $data );

	}else if( is_object( $data ) ){
		return trim_object( $data );

	}else if( is_array( $data ) ){
		return array_map( 'trim_array', $data );
	}
}
