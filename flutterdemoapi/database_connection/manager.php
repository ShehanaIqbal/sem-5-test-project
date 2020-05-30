<?php
	 require_once('DBController.php');
	 require_once('utilityManager.php');
     require_once('initialize.php');
     require_once('logger.php');

     echo ("came");
class manager{

    	private static $sessions=array();

        public static function getInstance($key)
        {
            if(!array_key_exists($key, self::$sessions)) {
                self::$sessions[$key] = new self();
            }
            return self::$sessions[$key];
        }

        private function __construct(){}

        private function __clone(){}
        //return the list of items of the seller
        
        public function BlackList_Vehicle($out,$latitude,$longitude,$dateTime,$branch,$username){
            $utility=new utility();
            $updated=$utility->BlackList_Vehicle($out,$latitude,$longitude,$dateTime,$branch,$username);
            if($updated){
                return (true);
            }else {
                return (false);
            }
        }
}
    ?>