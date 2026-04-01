<?php
    include "../views/_templates/init.php";?>
    <?php
try{
    $timeConf=array();
  $month = $_POST["Month"];
  $day = $_POST["Day"];
$sql5 ='SELECT name,EXTRACT(HOUR FROM time) AS "extracted_hour", EXTRACT(MINUTE FROM time) AS extracted_minute,conf from user_targets
where EXTRACT(Month FROM time) = 8 and EXTRACT(Day FROM time) = 2';
$result5 = $pdo->query($sql5);
var_dump($result5);
if($result5->rowCount()>0){
  while($row = $result5->fetch()){
    $time_real = $row["extracted_hour"].".".$row["extracted_minute"];
    $timeConf[]=array( 
      "x"=>  $time_real  ,
    "y"=> $row["conf"]);
  }
  

  unset($result5);

}else{
  echo "No records match your query.";
}
}catch(PDOException $e){
die("ERROR: not able to execute sql." . $e->getMessage());
}

$data = array(
    'timeConf' => $timeConf,
  );
  header('Content-type: application/json');
  echo json_encode($data);

?>
