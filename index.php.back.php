<?php
ini_set('display_errors', 'ON');
ini_set('display_startup_errors', 'ON');
ini_set('log_errors', '/User/seldoon/error.log');
phpinfo();
/**
 * 如果一个数是奇数，就把它增加1倍；
 * 如果它是偶数，就把它加上7。
 * 这样称作一次操作。
 * 经过6次操作后得到的数是162，那么开始的数是多少?
 */
//for ($i = 1; $i < 100; $i++) { // 从 1 到 100 一次递增循环, 每个
//    $ac = $i;
//    for ($x = 1; $x <= 6; $x++) { // 每个数循环六次
//        $ac += ($ac % 2) ? $ac : 7; // 基数 增加一倍 偶数 增加7
//    }
//    if ($ac === 162) {
//        $ac = $i;
//        break;
//    }
//}
//die($ac);


//var_dump(json_encode(['123', '1232' => 1231]));die;
//phpinfo();die;

//$num = 7655.5714 / 100;
//var_dump(ceil($num), round($num, 2), round($num));
//$acc = [1,2,45,67,67,2,123,1235,1];
//var_dump($acc);
//var_dump(array_values($acc));
//unset($acc[3]);
//var_dump($acc);
//var_dump(array_values($acc));
//var_dump(json_encode(array_values($acc)));
//$a=array("red","green","blue","yellow","brown", 12,23,45,456,5676,8789,79);
//print_r(array_slice($a,0, 10));

//var_dump(['ya' => 'や', '' => '', 'yu' => 'ゆ', '' => '', 'yo' => 'よ']);
//$name = $_GET['name'];
//
//header('X-Accel-Redirect: /media/mp3/' . $name);
// phpinfo();
// $year = date('Y');
// var_dump($year);
// $week = date('W');
// $weeks = date('W', mktime(0, 0, 0, 12, 30, $year));

// echo $year . '年一共有' . $weeks . '周<br />';

// if ($week > $weeks || $week <= 0) {
//     $week = 1;
// }

// if ($week < 10) {
//     $week = '0' . $week; // 注意：一定要转为 2位数，否则计算出错
// }
// $timestamp['start'] = strtotime($year . 'W' . $week);
// $timestamp['end'] = strtotime('+1 week -1 day', $timestamp['start']);

// echo $year . '年第' . $week . '周开始日期：' . date("Y-m-d", $timestamp['start']) . '<br />';
// echo $year . '年第' . $week . '周结束日期：' . date("Y-m-d", $timestamp['end']);
class Base {
    public function sayHello() {
        echo 'Hello ';
    }
}

trait SayWorld {
    public function sayHello() {
        // parent::sayHello();
        echo 'World!';
    }
}

class MyHelloWorld extends Base {
    use SayWorld;
}

$o = new MyHelloWorld();
//$o->sayHello();

$data = [
    'appId' => '3177b0572b374812804df850f33c6722',
    'st' => time(),
    //'endDate' => '2018-10-12',
    //'startDate' => '2018-10-09',
    //'studentId' => '857789388938018816',
    'classId' => 201165
];
//echo strtotime('‌2018-09-11 00:00:00');
//echo ‌‌strtotime('‌2018-09-11 00:00:00');
//echo strtotime('‌2018-09-11 00:00:00');

ksort($data);
$sign = '';
foreach ($data as $key => $item) {
    $sign .= "{$key}={$item}&";
}
$sign .= 'key=3/G07rV1Jdpbwfqe8D00QA';
echo md5($sign),'  ', time();

die;

//var_export(json_decode('{
//	"objData":[
//		{
//			"shareCount":1,
//			"shareUser":"4486"
//		},
//		{
//			"shareCount":3,
//			"shareUser":"857794065905745921"
//		},
//		{
//			"shareCount":2,
//			"shareUser":"884627025250222080"
//		}
//	],
//	"state":true
//}', true));

//$data = ['objData' => [0 => ['shareCount' => 1, 'shareUser' => '4486',], 1 => ['shareCount' => 3, 'shareUser' => '857794065905745921',], 2 => ['shareCount' => 2, 'shareUser' => '884627025250222080',],], 'state' => true,];
//var_dump(array_sum(array_column($data['objData'], 'shareCount')));
//var_dump(json_encode([]));


$redis = new \Redis();
$redis->connect('192.168.1.198', 6380);
$redis->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_IGBINARY);
//new  as1();
echo 'Connection to server sucessfully';
//设置 redis 字符串数据
//$redis->set("tutorial-name", "Redis tutorial");
// 获取存储的数据并输出
var_dump(call_user_func_array([$redis, 'mGet'], [['CACHE_RPC_SCHEDULE:201274']]));
var_dump($redis->mGet(['CACHE_RPC_SCHEDULE:201274']));
var_dump($redis->getOption(Redis::OPT_SERIALIZER));


die;
?>
<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <title>音频播放器</title>
</head>
<body>
<style>
    audio::-webkit-media-controls {
        overflow: hidden !important
    }
    
    audio::-webkit-media-controls-enclosure {
        width: calc(100%);
        margin-left: auto;
    }
</style>
<div id="player">

</div>
<object height="50" width="100" data="http://localhost/media.php?name=a.mp3"></object>
<script>
    // $(function () {
    //     var player = '<audio style="vertical-align: middle;" controls="controls"\n' +
    //         '       src="http://localhost/media/?name=a.mp3" preload="auto"  controlsList="nodownload"></audio>';
    //
    //     setTimeout(function () {
    //         $('#player').html(player);
    //     }, 1000);
    // })
</script>
</body>
</html> -->
