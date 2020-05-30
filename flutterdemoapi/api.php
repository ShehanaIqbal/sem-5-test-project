<?php
require_once('./database_connection/utilityManager.php');
if(isset($_FILES["image"]["name"])) {
    // Make sure you have created this directory already
    $target_dir = "./uploads/";
    // Generate a random name 
    $target_file = $target_dir . md5(time()) . '.' . $_POST['ext'];
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
    $dateTime=$_POST['dateTime'];
    $method=$_POST['method'];
    if($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $out= exec("python object_detection_yolo.py --image=".$target_file." --output=output.txt");
            $myFile = fopen("output.txt", "r") or die("Unable to open file!");
            $out= fread($myFile,filesize("output.txt"));
            $error="errorInImage";
            if (strpos($out, $error)===false) {
                $out=substr($out ,0, 8);
                fclose($myFile);
                if ($out!==""){
                    $utility=new utility();
                    if ($method==="blacklist"){
                        $result=$utility->BlackList_Vehicle($out,$latitude,$longitude,5,$dateTime,4);
                        if($result==="saved"){
                            echo json_encode(['response' => "Vehicle Blacklisted Successfully",'vehicleNo'=>$out,'dateTime'=>$dateTime,'latitude'=>$latitude,'longitude'=>$longitude]);
                        }else if($result=== 'isBlacklisted'){
                            echo json_encode(['response' => "Vehicle Is Already Blacklisted.",'vehicleNo'=>$out,'dateTime'=>$dateTime,'latitude'=>$latitude,'longitude'=>$longitude]);
                        }else if($result==='updated'){
                            echo json_encode(['response' => "Vehicle Blacklisted Successfully",'vehicleNo'=>$out,'dateTime'=>$dateTime,'latitude'=>$latitude,'longitude'=>$longitude]);
                        }else{
                            echo json_encode(['error' => "Please Try Again"]);
                        }
                    }else if($method==="check"){
                        $result=$utility->Check_Vehicle($out,$latitude,$longitude,5,$dateTime,4);
                        if ($result){
                            echo json_encode(['response' => "Blacklisted Vehicle Identified",'vehicleNo'=>$out,'dateTime'=>$dateTime,'latitude'=>$latitude,'longitude'=>$longitude]);
                        }else{
                            echo json_encode(['response' => "Vehicle Is Not Blacklisted",'vehicleNo'=>$out,'dateTime'=>$dateTime,'latitude'=>$latitude,'longitude'=>$longitude]);
                        }
                    }
                }else{
                    echo json_encode(['error' => "Please Try Again"]);
                }
            }else{
                echo json_encode(['response' => "System did not detect a number plate "]);
            }
     	}else {
      		echo json_encode(["error" => "Sorry, there was an error uploading your file."]); 
    	}
    } else {
        echo json_encode(["error" => "File is not an image."]);      
    }  
}
 else {
     echo json_encode(["error" => "Please provide a image to upload"]);
}


?>