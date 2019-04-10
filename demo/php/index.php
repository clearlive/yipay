<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <title>聚合支付2.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
    <style>
    html,body,div,p,span,ul,dl,ol,h1,h2,h3,h4,h5,h6,table,td,tr{padding:0;margin:0}
    .content{width:400px;margin:100px auto;border:1px solid #ddd}
    h1{margin-bottom:30px;background-color:#eee;;border-bottom:1px solid #ddd;padding:10px;text-align: center}
    table{border-collapse:collapse;width:90%;margin:20px auto}
    table tr td{height:40px;font-size:14px}
    input,select{width:100%;line-height:25px}
    button{font-size:16px}
    </style>
</head>
<body>
<div class="content">
    <h1>查询订单</h1>
    <form action="check.php" method="post" target="_blank">
        <table>
            <tr>
                <td>订单号：</td>
                <td><input type="text" name="ddh" value=""></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit">查询订单</button></td>
            </tr>
        </table>
    </form>
</div>
<div class="content">
    <h1>模拟支付</h1>
    <form action="pay.php" method="post">
        <table>
            <tr>
                <td width="120">版本号：</td>
                <td>
                    <select name="bb">
                        <option value="1.0">1.0</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>订单号：</td>
                <td><input type="text" name="ddh" value="<?php echo date('Ymd',time()).rand(10000000,99999999); ?>"></td>
            </tr>

            <tr>
                <td>订单金额：</td>
                <td><input type="text" name="je" value="1.00"></td>
            </tr>

            <tr>
                <td>支付通道：</td>
                <td>
                    <select class="zftd" name="zftd" onChange="changePay(this.options[this.selectedIndex].value)">
						<option value="alipaywap">支付宝</option>
						<option value="alipay">支付宝WAP</option>
						<option value="weixingz">微信公众号</option>
						<option value="weixinh5">微信H5</option>
						<option value="weixin">微信</option>
						<option  class="ylkj" value="yinlian">银联</option>
                    </select>
                </td>
            </tr>

            <tr>
                   <td>选择银行(银联选择)：</td>
                                <td>
                    <select class="bank"  name="bank" >
                      <option value="">请选择</option>
                      <option value="ICBC">工商银行</option>
                      <option value="CMBCHINA">招商银行</option>
                      <option value="ABC">中国农业银行</option>
                      <option value="CCB">建设银行</option>
                      <option value="BOCO">交通银行</option>
                      <option value="CIB">兴业银行</option>
                      <option value="CMBC">中国民生银行</option>
                      <option value="CEB">光大银行</option>
                      <option value="BOC">中国银行</option>
                      <option value="ECITIC">中信银行</option>
                      <option value="SDB">深圳发展银行</option>
                      <option value="GDB">广发银行</option>
                      <option value="SPDB">上海浦东发展银行</option>
                      <option value="POST">中国邮政</option>
                      <option value="PINGANBANK">平安银行</option>
                      <option value="HXB">华夏银行</option>
                      <option value="HKBEA">东亚银行</option>
                       <option value="BCCB">北京银行</option>
                   </select>
                                    </td>
                          </tr>

            <tr>
                <td>订单名称：</td>
                <td><input type="text" name="ddmc" value="订单名称"></td>
            </tr>

            <tr>
                <td>订单备注：</td>
                <td><input type="text" name="ddbz" value="备注"></td>
            </tr>

            <tr>
                <td></td>
                <td><button type="submit">提交订单</button></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
<!--<script>-->
<!---->
<!--    $('.ylkj').click(function () {-->
<!--        $('.bank').parent().parent().remove()-->
<!--        var _this= $(this)-->
<!--        var html ='<tr>\n' +-->
<!--            '                <td>选择银行：</td>\n' +-->
<!--            '                <td>\n' +-->
<!--            '                    <select class="bank"  name="bank" >\n' +-->
<!--            '\t\t\t\t\t\t<option value="ICBC">工商银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="CMBCHINA">招商银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="ABC">中国农业银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="CCB">建设银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="BOCO">交通银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="CIB">兴业银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="CMBC">中国民生银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="CEB">光大银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="BOC">中国银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="ECITIC">中信银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="SDB">深圳发展银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="GDB">广发银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="SPDB">上海浦东发展银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="POST">中国邮政</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="PINGANBANK">平安银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="HXB">华夏银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="HKBEA">东亚银行</option>\n' +-->
<!--            '\t\t\t\t\t\t<option value="BCCB">北京银行</option>\n' +-->
<!--            '                    </select>\n' +-->
<!--            '                </td>\n' +-->
<!--            '            </tr>'-->
<!--        _this.parent().parent().parent().after(html)-->
<!--    });-->
<!---->
<!--    $('.zftd').change(function () {-->
<!--        var _this= $(this)-->
<!---->
<!--        if ($('.zftd option:selected ').val() !== 'yinlian'){-->
<!--                $('.bank').parent().parent().remove()-->
<!--        }-->
<!--    })-->
<!--</script>-->