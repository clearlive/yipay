<?php
	//请求微信公众号支付 2018年4月1日15:38:06
	echo '
<body onLoad="document.pay.submit()">
    <form name="pay" action="../gateway/weixin_gz/gopay.php" method="GET">
        <input type="hidden" name="ddh" value="'.$out_trade_no.'">
        <input type="hidden" name="je" value="'.$je.'">
        <input type="hidden" name="ddmc" value="'.$subject.'">
    </form>
</body>
</html>';

?>