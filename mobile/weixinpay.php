<?php
define('IN_ECS', true);
require('../includes/init.php');
require('../includes/lib_order.php');
include_once('../includes/lib_payment.php');
error_reporting(E_ALL ^ E_NOTICE);
$out_trade_no = intval($_GET['out_trade_no']);

//$log = $db->getRow("SELECT order_id,order_amount FROM ".$ecs->table('pay_log')." WHERE log_id = '$out_trade_no'");
//$order = $db->getRow("SELECT * FROM " . $ecs->table('order_info') . " WHERE order_id = '".$log['order_id']."'");
//$order = $GLOBALS['db']->getRow("SELECT * from ".$GLOBALS['ecs']->table('order_info')." where order_sn = '".$_GET['out_trade_no']."'");
//$payment = payment_info($order['pay_id']);


$order = $db->getRow("SELECT * FROM " . $ecs->table('order_info') . " WHERE order_id = $out_trade_no");////青城调整:购买正版请联系93138905

//if($order['pay_status'] == 2) exit('is payed');
if ($order['order_amount'] > 0){
	$payment = payment_info($order['pay_id']); //青城调整:购买正版请联系93138905
	include_once('includes/modules/payment/' . $payment['pay_code'] . '.php');
	$pay_obj    = new $payment['pay_code'];
	$code = $pay_obj->get_code($order, unserialize_config($payment['pay_config']));
}else{
	echo 1;exit;
}
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>微信安全支付</title>
	<script type="text/javascript">
		function jsApiCall()
		{
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $code;?>,
				function(res){
					//WeixinJSBridge.log(res.err_msg);
					if(res.err_msg == "get_brand_wcpay_request:ok" ) {
						window.location.href = "<?php echo return_url('weixin');?>";
					} else {
						alert("交易取消");
						window.location.href = "./index.php";
					}
				}
			);
		}
		//function callpay()
		window.onload = function ()

		{
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall);
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
		}
	</script>
</head>
<body>
<!--	</br></br></br></br>
	<div align="center">
		<button style="width:400px; height:100px; background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:28px;" type="button" onclick="callpay()" >微信支付</button>
	</div>
	-->
</body>
</html>