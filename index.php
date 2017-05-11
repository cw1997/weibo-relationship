<?php
ini_set('max_execution_time', 120);

// $gsid = "";
// $aid = "";
$token = "";

function fetch($url,$cookie=null,$postdata=null){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	if (!is_null($postdata)) curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
	if (!is_null($cookie)) curl_setopt($ch, CURLOPT_COOKIE,$cookie);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	$re = curl_exec($ch);
	curl_close($ch);
	return $re;
}
/**  
* @author 昌维<867597730@qq.com> 
* @param array
* @return array
*/ 
function array_add($a1,$a2){
	$n = 0;
	foreach ($a1 as $key => $value) {
		$re[$n] = $value;
		$n++;
	}
	foreach ($a2 as $key => $value) {
		$re[$n] = $value;
		$n++;
	}
	return $re;
}

	

function get_friends($uid,$uname,$uimg,$ulocation){
	global $i;
	global $j;
	global $result;
	global $count;
	global $deep;
	
	$j++;
	if ($j > $deep) {
		return $result;
	}
	$guanzhu = json_decode(file_get_contents("http://api.weibo.cn/2/friendships/friends?networktype=wifi&trim_status=0&uicode=10000195&moduleID=700&featurecode=10000001&c=android&i=39b3e35&s=7427c218&ua=Meizu-M578C__weibo__6.4.0__android__android5.1&wm=9848_0009&aid=01Ao_lf0wQkI08S7yJExcs03HqldztOkKI2wqQUlgKhIiopmA.&uid={$uid}&v_f=2&from=1064095010&gsid=_2A256Fw-cDeRxGeNP6VUZ8C_MwjWIHXVWhQRUrDV6PUJbrdAKLVjmkWpLHeugwfkkKAubZPEgKa8Pn5L8mZKi0g..&lang=zh_CN&lfid=1076033198740351_-_WEIBO_SECOND_PROFILE_WEIBO&page=1&skin=default&sort=1&has_pages=1&count=20&oldwm=19005_0019&sflag=1&luicode=10000198&has_top=0&has_relation=1&has_member=1&lastmblog=1"),1);
	// /2/friendships/friends?networktype=wifi&trim_status=0&uicode=10000195&moduleID=700&featurecode=10000001&c=android&i=39b3e35&s=7427c218&ua=Meizu-M578C__weibo__6.4.0__android__android5.1&wm=9848_0009&aid=01Ao_lf0wQkI08S7yJExcs03HqldztOkKI2wqQUlgKhIiopmA.&uid=3198740351&v_f=2&from=1064095010&gsid=_2A256Fw-cDeRxGeNP6VUZ8C_MwjWIHXVWhQRUrDV6PUJbrdAKLVjmkWpLHeugwfkkKAubZPEgKa8Pn5L8mZKi0g..&lang=zh_CN&lfid=1076033198740351_-_WEIBO_SECOND_PROFILE_WEIBO&page=1&skin=default&sort=1&has_pages=1&count=20&oldwm=19005_0019&sflag=1&luicode=10000198&has_top=0&has_relation=1&has_member=1&lastmblog=1

	// $re = array_add($fensi['users'],$guanzhu['users']);
	// print_r($re);
	// $i = 0;
	// print_r("进入get函数 此时变量i为{$i}，j变量为{$j},开始抓取【{$uid}】的粉丝--------------------------------------------------\n");
	foreach ($guanzhu['users'] as $key => $value) {
		$result[$i]['source_uid'] = $uid;
		$result[$i]['source_name'] = $uname;
		$result[$i]['source_img'] = $uimg;
		$result[$i]['source_location'] = $ulocation;

		$result[$i]['target_uid'] = $value['id'];
		$result[$i]['target_name'] = $value['screen_name'];
		$result[$i]['target_img'] = $value['profile_image_url'];
		$result[$i]['target_location'] = $value['location'];
		$i++;
		// print_r($result);
		// print_r("进入get函数 此时变量i为{$i}，j变量为{$j},开始抓取【".$value['name']."】的粉丝--------------------------------------------------\n");
		$result = get_friends($value['id'],$value['screen_name'],$value['profile_image_url'],$value['location']);
		// print_r("进入get函数 此时变量i为{$i}，j变量为{$j}--------------------------------------------------\n");
	}
	// print_r("退出foreach 此时变量i为{$i}，j变量为{$j},结束抓取--------------------------------------------------\n");
	return $result;
}
function get_followers($uid,$uname,$uimg,$ulocation){
	global $i;
	global $j;
	global $result;
	global $count;
	global $deep;
	
	$j++;
	if ($j > $deep) {
		return $result;
	}
	$fensi = json_decode(file_get_contents("http://api.weibo.cn/2/friendships/followers?networktype=wifi&trim_status=0&uicode=10000081&moduleID=700&featurecode=10000001&c=android&i=39b3e35&s=7427c218&ua=Meizu-M578C__weibo__6.4.0__android__android5.1&wm=9848_0009&aid=01Ao_lf0wQkI08S7yJExcs03HqldztOkKI2wqQUlgKhIiopmA.&uid={$uid}&v_f=2&from=1064095010&gsid=_2A256Fw-cDeRxGeNP6VUZ8C_MwjWIHXVWhQRUrDV6PUJbrdAKLVjmkWpLHeugwfkkKAubZPEgKa8Pn5L8mZKi0g..&lang=zh_CN&lfid=1076033198740351_-_WEIBO_SECOND_PROFILE_WEIBO&page=1&skin=default&sort=3&has_pages=0&count=20&oldwm=19005_0019&sflag=1&luicode=10000198&has_top=0&has_relation=1&has_member=1&lastmblog=1"),1);
	// /2/friendships/followers?networktype=wifi&trim_status=0&uicode=10000081&moduleID=700&featurecode=10000001&c=android&i=39b3e35&s=7427c218&ua=Meizu-M578C__weibo__6.4.0__android__android5.1&wm=9848_0009&aid=01Ao_lf0wQkI08S7yJExcs03HqldztOkKI2wqQUlgKhIiopmA.&uid=3198740351&v_f=2&from=1064095010&gsid=_2A256Fw-cDeRxGeNP6VUZ8C_MwjWIHXVWhQRUrDV6PUJbrdAKLVjmkWpLHeugwfkkKAubZPEgKa8Pn5L8mZKi0g..&lang=zh_CN&lfid=1076033198740351_-_WEIBO_SECOND_PROFILE_WEIBO&page=1&skin=default&sort=3&has_pages=0&count=20&oldwm=19005_0019&sflag=1&luicode=10000198&has_top=0&has_relation=1&has_member=1&lastmblog=1

	// $re = array_add($fensi['users'],$guanzhu['users']);
	// print_r($re);
	// $i = 0;
	// print_r("进入get函数 此时变量i为{$i}，j变量为{$j},开始抓取【{$uid}】的粉丝--------------------------------------------------\n");
	foreach ($fensi['users'] as $key => $value) {
		$result[$i]['target_uid'] = $uid;
		$result[$i]['target_name'] = $uname;
		$result[$i]['target_img'] = $uimg;
		$result[$i]['target_location'] = $ulocation;

		$result[$i]['source_uid'] = $value['id'];
		$result[$i]['source_name'] = $value['screen_name'];
		$result[$i]['source_img'] = $value['profile_image_url'];
		$result[$i]['source_location'] = $value['location'];
		$i++;
		// print_r($result);
		// print_r("进入get函数 此时变量i为{$i}，j变量为{$j},开始抓取【".$value['name']."】的粉丝--------------------------------------------------\n");
		$result = get_followers($value['id'],$value['screen_name'],$value['profile_image_url'],$value['location']);
		// print_r("进入get函数 此时变量i为{$i}，j变量为{$j}--------------------------------------------------\n");
	}
	// print_r("退出foreach 此时变量i为{$i}，j变量为{$j},结束抓取--------------------------------------------------\n");
	return $result;
}

$url = 'https://api.weibo.com/2/users/show.json?screen_name='.urlencode($_GET['weiboid']).'&access_token='.$token;
// $user_info = fetch($url);
$user_info = json_decode(file_get_contents($url),1);
// print_r(json_decode($user_info));exit();

$result = array();
$i = 0;
$j = 0;
$count = $_GET['count'];
$deep = $_GET['deep'];

$option_data = get_friends($user_info['id'],$_GET['weiboid'],$user_info['profile_image_url'],$user_info['location']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $_GET['weiboid'] ?>的微博关系网</title>
</head>
<body>
	<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
	   <div id="main" style="width: <?php echo $_GET['width'] ?>px;height: <?php echo $_GET['height'] ?>px"></div>
	   <!-- ECharts单文件引入 -->
	   <script src="http://echarts.baidu.com/build/dist/echarts.js"></script>
	   <script type="text/javascript">
	       // 路径配置
	       require.config({
	           paths: {
	               echarts: 'http://echarts.baidu.com/build/dist'
	           }
	       });
	       
	       // 使用
	       require(
	           [
	               'echarts',
	               'echarts/chart/force' // 使用柱状图就加载bar模块，按需加载
	           ],
	           function (ec) {
	               // 基于准备好的dom，初始化echarts图表
	               var myChart = ec.init(document.getElementById('main')); 
	               
	               option = {
	                   title : {
	                       text: '新浪微博关系网',
	                       subtext: 'www.changwei.me',
	                       x:'right',
	                       y:'bottom'
	                   },
	                   tooltip : {
	                       trigger: 'item',
	                       formatter: '{a} : {b}'
	                   },
	                   toolbox: {
	                       show : true,
	                       feature : {
	                           restore : {show: true},
	                           magicType: {show: true, type: ['force', 'chord']},
	                           saveAsImage : {show: true}
	                       }
	                   },
	                   legend: {
	                       x: 'left',
	                       data:['家人','朋友']
	                   },
	                   series : [
	                       {
	                           type:'force',
	                           name : "人物关系",
	                           ribbonType: false,
	                           categories : [/*
	                               {
	                                   name: '人物'
	                               },
	                               {
	                                   name: '家人',
	                                   symbol: 'diamond'
	                               },
	                               {
	                                   name:'朋友'
	                               }*/
	                           ],
	                           itemStyle: {
	                               normal: {
	                                   label: {
	                                       show: true,
	                                       textStyle: {
	                                           color: '#333'
	                                       }
	                                   },
	                                   nodeStyle : {
	                                       brushType : 'both',
	                                       borderColor : 'rgba(255,215,0,0.4)',
	                                       borderWidth : 1
	                                   }
	                               },
	                               emphasis: {
	                                   label: {
	                                       show: false
	                                       // textStyle: null      // 默认使用全局文本样式，详见TEXTSTYLE
	                                   },
	                                   nodeStyle : {
	                                       //r: 30
	                                   },
	                                   linkStyle : {}
	                               }
	                           },
	                           minRadius : <?php echo $_GET['minRadius'] ?>,
	                           maxRadius : <?php echo $_GET['maxRadius'] ?>,
	                           gravity: <?php echo $_GET['gravity'] ?>,
	                           scaling: <?php echo $_GET['scaling'] ?>,
	                           draggable: true,
	                           linkSymbol: 'arrow',
	                           steps: 10,
	                           coolDown: 0.9,
	                           //preventOverlap: true,
	                           // size: 50%,
	                           nodes:[
                                   <?php foreach ($option_data as $key => $value) { ?>
	                               {category:1, name: '<?php echo $value['source_name'] ?>',value : 2},
	                               {category:2, name: '<?php echo $value['target_name'] ?>',value : 2},
	                               <?php } ?>
	                           ],
	                           links : [
	                               // {source : '丽萨-乔布斯', target : '乔布斯', weight : 1, name: '女儿', itemStyle: {
	                               //     normal: {
	                               //         width: 1.5,
	                               //         color: 'red'
	                               //     }
	                               // }},
	                               // {source : '乔布斯', target : '丽萨-乔布斯', weight : 1, name: '父亲', itemStyle: {
	                               //     normal: { color: 'red' }
	                               // }},
	                               <?php foreach ($option_data as $key => $value) { ?>
	                               		{source : '<?php echo $value['source_name'] ?>', target : '<?php echo $value['target_name'] ?>', weight : 1, name: ''},
	                               <?php } ?>
	                           ]
	                       }
	                   ]
	               };
	       
	               // 为echarts对象加载数据 
	               myChart.setOption(option); 
	           }
	       );
	   </script>
</body>
</html>