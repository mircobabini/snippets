<?php
/**
 * Module to record hits/view/anything by universal unique id
 * Mainly developed to track users on mobile apps
 * 
 * @version 1
 * @author mircobabini <mirkolofio@gmail.com>
 * @license GPLv2
 */
class uuids{
	protected static $tablename = 'uuids';
	public static function tablename(){
		global $wpdb;
		return $wpdb->prefix.self::$tablename;
	}

	public function __construct(){
		global $wpdb;
		$query = "CREATE TABLE IF NOT EXISTS `wp_uuids` (
		  `ID` int(20) unsigned NOT NULL AUTO_INCREMENT,
		  `uuid` varchar(40) NOT NULL,
		  `date` date NOT NULL,
		  `details` text CHARACTER SET utf8 NOT NULL,
		  `hits` int(20) unsigned NOT NULL,
		  `date_last` date NOT NULL,
		  PRIMARY KEY (`ID`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
		$wpdb->query( $query );
	}

	public function hit( $uuid ){
		$instance = $this->get( $uuid );
		if( ! $instance ){
			$instance = new uuid( $uuid );
		}

		$instance->hits++;
		$instance->date_last = date( 'Y/m/d' );
		$instance->save();
		return $instance;
	}
	public function get( $uuid ){
		global $wpdb;
		$tablename = self::tablename();

		$row = $wpdb->get_row( "SELECT * FROM {$tablename} WHERE uuid = '$uuid'");
		if( ! $row ){
			return null;
		}

		return $this->instance( $row );
	}

	public function instance( $row ){
		$instance = new uuid( $row->uuid );
		$instance->ID = (int)$row->ID;
		$instance->date = $row->date;
		$instance->details = unserialize( $row->details );
		$instance->hits = (int)$row->hits;
		$instance->date_last = $row->date_last;
		return $instance;
	}
}
class uuid{
	public $ID;
	protected $uuid;
	public $date;
	public $details = array();
	public $hits = 0;
	public $date_last;

	public function __construct( $uuid ){
		$this->uuid = $uuid;
	}
	public function save(){
		global $wpdb;
		$tablename = uuids::tablename();

		$details = serialize( $this->details );
		if( $this->ID ){
			// update
			$success =
			$wpdb->update(
				$tablename, 
				array( 
					'details' => $details,
					'hits'	  => $this->hits,
					'date_last' => $this->date_last,
				), 
				array( 'ID' => $this->ID ), 
				array( 
					'%s',	// details
					'%d',	// hits
					'%s',	// date_last
				), 
				array( '%d' )
			);

			if( ! $success ){
				throw new Exception();
			}
		}else{
			// create
			$cdate = date( 'Y/m/d' );

			$success = 
			$wpdb->insert( 
				$tablename, 
				array( 
					'uuid' => $this->uuid,
					'date' => $cdate,
					'details' => $details,
					'hits'	  => $this->hits,
					'date_last' => $this->date_last,
				), 
				array( 
					'%s',	// uuid
					'%s',	// date
					'%s',	// details
					'%d',	// hits
					'%s',   // date_last
				) 
			);

			if( ! $success ){
				throw new Exception();
			}

			$this->ID = $wpdb->insert_id;
		}

		return $this;
	}

	public function uuid(){
		return $this->uuid;
	}
}

function uuids(){
	static $instance;
	$instance = $instance ? $instance : new uuids();
	return $instance;
}