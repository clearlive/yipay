<!--#include file="asp_md5.asp"-->
<!--#include file="config.asp"-->
<%



	Randomize 
	rnds = Int((900 * Rnd) + 100)
	orderid=year(now())&month(now())&day(now())&hour(now())&minute(now())&second(now())&rnds''''�����̻�������,�̻������ж���

	version			=	"1.0"
	customerid		=	userid
	sdorderno		=	orderid
	total_fee		=	request("total_fee")
	paytype			=	request("paytype")
	bankcode		=	request("bankcode")
	notifyurl		=	request("notifyurl")
	returnurl		=	request("returnurl")
	remark			=	'';
	get_code		=	request("get_code")

	sign=asp_md5("version="&version&"&customerid="&customerid&"&total_fee="&total_fee&"&sdorderno="&sdorderno&"&notifyurl="&notifyurl&"&returnurl="&returnurl&"&"&userkey)

%>
<!doctype html>
<html>
<head>
    <meta charset="utf8">
    <title>����ת������ҳ</title>
</head>
<body onLoad="document.pay.submit()">
    <form name="pay" action="http://dev.123.com/pay/api.php" method="post">
        <input type="hidden" name="version" value="<% =version %>">
        <input type="hidden" name="customerid" value="<% =customerid %>">
        <input type="hidden" name="sdorderno" value="<% =sdorderno %>">
        <input type="hidden" name="total_fee" value="<% =total_fee %>">
        <input type="hidden" name="paytype" value="<% =paytype %>">
        <input type="hidden" name="notifyurl" value="<% =notifyurl %>">
        <input type="hidden" name="returnurl" value="<% =returnurl %>">
        <input type="hidden" name="remark" value="<% =remark %>">
        <input type="hidden" name="bankcode" value="<%=bankcode %>">
        <input type="hidden" name="sign" value="<% =sign %>">
        <input type="hidden" name="get_code" value="<% =get_code %>">
    </form>
</body>
</html>