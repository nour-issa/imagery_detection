<?php
    include "../views/_templates/init.php";?>
<?php
try{
  $qByMonth = array();
    
$sql = "SELECT DATE_TRUNC('month', time) AS month_start,
COUNT(*) AS count
FROM yolox_all_targets
GROUP BY month_start
ORDER BY month_start";
$result = $pdo->query($sql);
if($result->rowCount()>0){

  while($row = $result->fetch()){
    $qByMonth[]= $row["count"];
    // echo $row;
  }
  

  unset($result);

}else{
  echo "No records match your query.";
}



//////////////////

$sql2 = "SELECT count(*) as count,name from yolox_all_targets group by name";
$result2 = $pdo->query($sql2);
if($result2->rowCount()>0){
  $classDistName = array();
  $classDistValue = array();
  while($row = $result2->fetch()){
    $classDistName[]= $row["name"];
    $classDistValue[]=$row["count"];
  }
  

  unset($result2);

}else{
  echo "No records match your query.";
}



///////////////////////



$sql3 = "SELECT count(*) as count,sahi from yolox_all_targets where model='yolox' group by sahi";
$result3 = $pdo->query($sql3);
if($result3->rowCount()>0){
  $sahiName = array();
  $sahiValue = array();
  while($row = $result3->fetch()){
    $sahiName[]= $row["sahi"];
    $sahiValue[]=$row["count"];
  }
  

  unset($result3);


}else{
  echo "No records match your query.";
}




  $sql31 = "SELECT count(*) as count,sahi from yolox_all_targets where model='yolonas' group by sahi";
  $result31= $pdo->query($sql31);
  if($result31->rowCount()>0){
    $sahiName2 = array();
    $sahiValue2 = array();
    while($row = $result31->fetch()){
      $sahiName2[]= $row["sahi"];
      $sahiValue2[]=$row["count"];
    }
    

    unset($result31);


  }else{
    echo "No records match your query.";
  }


/////////////////////


$bubbleData = array();

$timeConf=array();
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["submitFormCoord"])) {
  $east = $_POST["value1"];
  $west = $_POST["value2"];
  $north = $_POST["value3"];
  $south = $_POST["value4"];

  $sql4 = 'SELECT ST_X(ST_AsText(geom,3)) AS lon ,ST_Y(ST_AsText(geom,3)) AS lat,count(*) AS count ,conf  from yolox_all_targets
  WHERE ST_X(ST_AsText(geom)) BETWEEN ' . $east . ' - 1 '.' AND ' . $west . ' + 1 ' .
    'AND ST_Y(ST_AsText(geom)) BETWEEN ' . $south . ' - 1 '. 'AND ' . $north . ' + 1 GROUP BY
    ST_X(ST_AsText(geom, 3)),
    ST_Y(ST_AsText(geom, 3)),
    conf';
  $result4 = $pdo->query($sql4);

  if ($result4->rowCount() > 0) {
   

    while ($row = $result4->fetch()) {
    
        $bubbleData[] = array(
            "x" => $row["lon"],
            "y" => $row["lat"],
            "r" => $row["count"]*4, // Adjust the scale for circle sizes
            "c" => $row["conf"], // Used for color gradient
        );
    }

      unset($result4);
  } else {
      echo "No records match your query.";
  }
}

if (isset($_POST["submitFormTimeConf"])) {
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


}

// }



}catch(PDOException $e){
die("ERROR: not able to execute sql." . $e->getMessage());
}



$data = array(
    'qByMonth' => $qByMonth,
    'classDistName' => $classDistName,
    'classDistValue' => $classDistValue,
    'sahiName' => $sahiName,
    'sahiValue' => $sahiValue,
    'sahiName2' => $sahiName2,
    'sahiValue2' => $sahiValue2,
    'bubbleData' => $bubbleData,
    'timeConf' => $timeConf,
  );
  
  header('Content-type: application/json');
  
  echo json_encode($data);



?>