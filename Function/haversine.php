<?php
// echo haversine( 44.420031, 11.911681, 44.417063, 12.201196 );
function haversine($center_lat, $center_lng, $lat, $lng){
	$distance =( 6371 * acos((cos(deg2rad($center_lat)) ) * (cos(deg2rad($lat))) * (cos(deg2rad($lng) - deg2rad($center_lng)) )+ ((sin(deg2rad($center_lat))) * (sin(deg2rad($lat))))) );
	return $distance;
}