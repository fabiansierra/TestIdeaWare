<?php

class CrudSubscribers{

  public function create($data){
    include('../config/connection.php');

    $date = "1995-05-22 07:00:00";

    if($data['custom_fields']["Date"] != ""){
      $date = $data['custom_fields']["Date"];
    }

    $sql = "INSERT INTO subscribers VALUES(NULL,'".$data['name']."','".$data['email']."','".$data['ad_tracking']."','".$data['tags']['add'][0]."','".$data['custom_fields']["IP"]."','".$date."','".$data['custom_fields']["URL"]."')";

    if ($conn->query($sql) === TRUE) {
      $fp = fopen('../logs/logs.txt', 'a+');
      fwrite($fp, $data['email']." - ".date("Y-m-d h:i:s")." - Saved Successfully");
      fwrite($fp, chr(13).chr(10));
      fclose($fp);
      echo "200";
    } else {
      $fp = fopen('../logs/logs.txt', 'a+');
      fwrite($fp, $data['email']." - ".date("Y-m-d h:i:s")." - Insert error");
      fwrite($fp, chr(13).chr(10));
      fclose($fp);
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
  }

  public function update($data){
    include('../config/connection.php');

    $date = "1995-05-22 07:00:00";

    if($data['custom_fields']["Date"] != ""){
      $date = $data['custom_fields']["Date"];
    }

    $sql = "UPDATE subscribers SET name = '".$data['name']."', email = '".$data['email']."', track = '".$data['ad_tracking']."', tags = '".$data['tags']['add'][0]."', ip = '".$data['custom_fields']["IP"]."', date = '".$date."', url = '".$data['custom_fields']["URL"]."' WHERE email = '".$data['email']."' ";

    if ($conn->query($sql) === TRUE) {
      $fp = fopen('../logs/logs.txt', 'a+');
      fwrite($fp, $data['email']." - ".date("Y-m-d h:i:s")." - Updated Successfully");
      fwrite($fp, chr(13).chr(10));
      fclose($fp);
      echo "200";
    } else {
      $fp = fopen('../logs/logs.txt', 'a+');
      fwrite($fp, $data['email']." - ".date("Y-m-d h:i:s")." - Update error");
      fwrite($fp, chr(13).chr(10));
      fclose($fp);
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
  }
}