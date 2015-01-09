# UUIDs
Module to record hits/view/anything by universal unique id, mainly developed to track users on mobile apps.

### Usage example (for angular, uses [Srv_Api.js](https://gist.github.com/mircobabini/64a0c4720b295f45ae26))
-----------------
    angular.module('app.services', [])
    .factory('Api', ['$http', 'Constants', function($http, Constants){
    	 return {
    	 		hit: function( uuid ){
    				var uri = Constants.endpoint+'/hit/';
    
    				$http.get(uri, { params: { uuid: uuid } })
    					.success(function(){})
    					.error(function(){});
    	 		},
    	 };
    }])
    .service('Constants', function(){
    	return {
    		endpoint: 'http://example.org/api',
    	}
    })

### Server-side implementation

    <?php
    require_once 'uuids.php';
    
    $uuid = @$_GET['uuid'];
    $instance = uuids()->hit( $uuid );
    echo $instance->hits;
