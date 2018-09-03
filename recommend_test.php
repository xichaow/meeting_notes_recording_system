<?php
error_reporting(E_ALL^E_NOTICE);
require_once("recommend.php");
require_once("sample_list.php");

$userinput = $_POST['userinput'];

if (!in_array($userinput,array('restaurants','movies'))) {
	$arr = array('returnStr'=>'not found!');
	echo json_encode($arr);
	exit;
}

$re = new Recommend();

$ratinglist=$re->getRecommendations($$userinput, "Lifeng");

arsort($ratinglist);

$returnStr = '';
$i=1;
foreach($ratinglist as $key=>$value)
{
    if($i<4)
    {
	$returnStr .= $i.":".$key."<br/>";
    }
	$i++;
}
$arr = array('returnStr'=>$returnStr);
echo json_encode($arr);
exit;


?>
