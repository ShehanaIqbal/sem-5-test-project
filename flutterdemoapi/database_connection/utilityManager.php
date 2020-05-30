<?php
     require_once('DBController.php');
?>

<?php
	class utility{
		private $controller;

		public function __construct(){
			$this->controller= new DBController();
		}

    ///////////////////////////////////////////////////////
    public function BlackList_Vehicle($out,$latitude,$longitude,$username,$dateTime,$branch){
        $query="SELECT saveVehicleNumber('$out','$latitude','$longitude','$username','$dateTime','$branch') AS 'out'";
        $res=$this->controller->runQuery($query);
        if ($res[0]['out']==2){
          return ("saved");
        }else if ($res[0]['out']==0){
          return("isBlacklisted");
        }else{
          return("updated");
        }
    }

    public function Check_Vehicle($out,$latitude,$longitude,$username,$dateTime,$branch){
      $query="SELECT checkVehicle('$out','$latitude','$longitude','$username','$dateTime','$branch') AS 'res'";
        $res=$this->controller->runQuery($query);
        if ($res[0]['res']==1){
          return (true);
        }else{
          return(false);
        }
    }
  }

