<?php
set_exception_handler(function ($exception) {
    echo $exception->getMessage();
});

//从$arr数组中，获取$m个数字组成数组,也就是排列组合的C运算符
function getCombinationToString($arr, $m)
{
    $result = array();
    if ($m == 1) {
        return $arr;
    }
    if ($m == count($arr)) {
		//当取出的个数等于数组的长度，就是只有一种组合，即本身
        $result[] = implode(',', $arr);
        return $result;
    }
    $temp_firstelement = $arr[0];
    unset($arr[0]);
    $arr         = array_values($arr);
    $temp_first1 = getCombinationToString($arr, $m - 1);
    foreach ($temp_first1 as $s) {
        $s        = $temp_firstelement . ',' . $s;
        $result[] = $s;
    }
    unset($temp_first1);
    $temp_first2 = getCombinationToString($arr, $m);
    foreach ($temp_first2 as $s) {
        $result[] = $s;
    }
    unset($temp_first2);
    return $result;
}
//双色球-红色任选10个数字
$redArr           = ['01','02','03','04','05','06','07','08','09','10'];
$redCombinationArr = getCombinationToString($redArr, 6); //10个数里面,取出6个数有多少种组合(即不考虑顺序)
//echo "<pre>";
//print_r($redCombinationArr);
//echo "</pre>";
//$data['count'] = count($result); //组合种数
//$data['data']  = $result; //各种数据组合
//echo "<pre>";
//print_r($data);
//echo "</pre>";
//双色球-蓝色任选3个数字
$reArr=[];
$blueArr=['01','02','03'];
foreach ($blueArr as $v) {
    foreach ($redCombinationArr as $value) {
        $reArr[]=$value.','.$v;
    }
}
$reStr=implode("|",$reArr);

$connection = mysql_connect("127.0.0.1", "root", "root");//连接到数据库
mysql_query("set names 'utf8'");//编码转化
if (!$connection) {
    die("could not connect to the database.\n" . mysql_error());//诊断连接错误
}
$selectedDb = mysql_select_db("test");//选择数据库
if (!$selectedDb) {
    die("could not to the database\n" . mysql_error());
}
$insertSql = "insert into bet(bet_content) values('$reStr')";
$result = mysql_query($insertSql);
echo $result . "\n";
