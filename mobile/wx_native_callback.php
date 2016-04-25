<?php

define('IN_ECTOUCH', true);
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
 
require(ROOT_PATH . 'includes/lib_payment.php');
require_once(ROOT_PATH .'includes/modules/payment/wx_new_jspay.php');
$payment = new wx_new_jspay();
$payment->respond();
exit;