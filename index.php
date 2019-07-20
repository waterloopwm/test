<?php
require_once './vendor/autoload.php';
use think\Db;;
// 数据库配置信息设置（全局有效）
Db::setConfig([
        // 数据库类型
        'type'        => 'mysql',
        // 数据库连接DSN配置
        'dsn'         => '',
        // 服务器地址
        'hostname'    => '127.0.0.1',
        // 数据库名
        'database'    => 'test',
        // 数据库用户名
        'username'    => 'root',
        // 数据库密码
        'password'    => 'root',
        // 数据库连接端口
        'hostport'    => '3306',
        // 数据库连接参数
        'params'      => [],
        // 数据库编码默认采用utf8
        'charset'     => 'utf8',
        // 数据库表前缀
        'prefix'      => '',
]);

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

/*
//双色球-红色任选6个数字,可以多选1个
$redArr           = ['01','02','03','04','05','06','07','08'];
$redCombinationArr = getCombinationToString($redArr, 6); //8个数里面,取出6个数有多少种组合(即不考虑顺序)
//双色球-蓝色任选1个数字,可以多选1个
$reArr=[];
$blueArr=['01','02','03'];
foreach ($blueArr as $v) {
    foreach ($redCombinationArr as $value) {
        $reArr[]=$value.','.$v;
    }
}
*/


//大乐透-红色任选5个数字,可以多选2个
$redArr           = ['01','02','03','04','05','06','07'];
$redCombinationArr = getCombinationToString($redArr, 5); //7个数里面,取出5个数有多少种组合(即不考虑顺序)
//大乐透-蓝色任选2个数字,可以多选2个
$reArr=[];
$blueArr=['01','02','03','04'];
$blueCombinationArr = getCombinationToString($blueArr, 2); //4个数里面,取出2个数有多少种组合(即不考虑顺序)
foreach ($blueCombinationArr as $v) {
    foreach ($redCombinationArr as $value) {
        $reArr[]=$value.','.$v;
    }
}


echo count($reArr);
$reStr=implode("|",$reArr);

/*foreach ($reArr as $value) {
    $data[]=['bet_content'=>$value];
}
Db::name("bet")->insertAll($data);*/
//$data=['bet_content'=>$reStr];
//Db::name("bet")->insert($data);
$one=['1','2'];
$two=['3','4'];
$three=['5','6'];
$four=['7','8'];
$five=['9','10'];
$six=['11','12'];
$seven=['13','14'];
foreach ($one as $v) {
    foreach ($two as $vv) {
        foreach ($three as $vvv) {
            foreach ($four as $vvvv) {
                foreach ($five as $vvvvv) {
                    foreach ($six as $vvvvvv) {
                        foreach ($seven as $vvvvvvv) {
                            $data[]=$v.$vv.$vvv.$vvvv.$vvvvv.$vvvvvv.$vvvvvvv;
                        }
                    }
                }
            }
        }
    }
}
echo '<pre>';
print_r($data);
