# UUIDs
Module to record hits/view/anything by universal unique id, mainly developed to track users on mobile apps.

### Client example (AngularJS, uses [Srv_Api.js](https://gist.github.com/mircobabini/64a0c4720b295f45ae26))
-----------------
    angular.module('app.services', [])
    .factory('Api', ['$http', 'Constants', function($http, Constants){
        return {
            hit: function( uuid, success, error ){
                success = success || function(){}
                error = error || function(){}
                
                var uri = Constants.endpoint+'/hit/';
    
                $http.get(uri, { params: { uuid: uuid } })
                    .success(success)
                    .error(error);
            },
        };
    }])
    .service('Constants', function(){
        return {
            endpoint: 'http://example.org/api',
        }
    })

### Server-side example

    <?php
    require_once 'uuids.php';
    
    $uuid = @$_GET['uuid'];
    $instance = uuids()->hit( $uuid );
    echo $instance->hits;
