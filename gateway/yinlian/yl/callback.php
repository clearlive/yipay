<?php

/*
 * @Description API֧��B2C����֧���ӿڷ��� 
 */
 
include 'payCommon.php';	
	
#	ֻ��֧���ɹ�ʱAPI֧���Ż�֪ͨ�̻�.
##֧���ɹ��ص������Σ�����֪ͨ������֧����������е�p8_Url�ϣ�������ض���;��������Ե�ͨѶ.

#	�������ز���.
$return = getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);

#	�жϷ���ǩ���Ƿ���ȷ��True/False��
$bRet = CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
#	���ϴ���ͱ�������Ҫ�޸�.
	 	
#	У������ȷ.
if($bRet){
	if($r1_Code=="1"){
		
	#	��Ҫ�ȽϷ��صĽ�����̼����ݿ��ж����Ľ���Ƿ���ȣ�ֻ����ȵ�����²���Ϊ�ǽ��׳ɹ�.
	#	������Ҫ�Է��صĴ������������ƣ����м�¼�������Դ����ڽ��յ�֧�����֪ͨ���ж��Ƿ���й�ҵ���߼�������Ҫ�ظ�����ҵ���߼�������ֹ��ͬһ�������ظ��������������.
		if($r9_BType=="1"){
            handle($r6_Order,$r3_Amt);
			echo "���׳ɹ�";
			echo  "<br />����֧��ҳ�淵��";
		}elseif($r9_BType=="2"){
			#�����ҪӦ�����������д��,��success��ͷ,��Сд������.
            handle($r6_Order,$r3_Amt);
			echo "success";
			echo "<br />���׳ɹ�";
			echo  "<br />����֧������������";      			 
		}
	}
	
}else{
	echo "������Ϣ���۸�";
}

function handle($order_no,$jes){
    $out_trade_no = uhtml(check(trim($order_no))); //������

    //�������
    $je = uhtml(check(trim($jes)));
    $dd=queryall(co_dingdan,"where ddh='$out_trade_no' and ddje='$je'"); //У��ͨ�������Ҷ�����
    if($dd['ddzt'] != 'success' or $dd['ddzt'] != 'fail'){
        $yhm=$dd['username'];
        queryg(co_dingdan,"ddzt='success' where ddh='$out_trade_no' and ddje='$je'");//�鿴�ö���״̬�����״̬����success�͸�Ϊsuccess��
        queryg(co_diaodan,"ddzt='success' where ddh='$out_trade_no' and ddje='$je'");//�鿴�úڵ�״̬�����״̬����success�͸�Ϊsuccess��
        $url=$dd['ddybtz'];
        $user=queryall(co_user_sys,"where user='$yhm'");
        $sign=md5('status=success&shid='.$dd['userid'].'&bb='.$dd['jkbb'].'&zftd='.$dd['ddtd'].'&ddh='.$dd['apiddh'].'&je='.$dd['ddje'].'&ddmc='.$dd['apiddmc'].'&ddbz='.$dd['apiddbz'].'&ybtz='.$dd['ddybtz'].'&tbtz='.$dd['ddtbtz'].'&'.$user['apikey']);
        $data=array(
            "status"=>'success',
            "shid"=>$dd['userid'],
            "bb"=>$dd['jkbb'],
            "zftd"=>$dd['ddtd'],
            "ddh"=>$dd['apiddh'],
            "je"=>$dd['ddje'],
            "ddmc"=>$dd['apiddmc'],
            "ddbz"=>$dd['apiddbz'],
            "ybtz"=>$dd['ddybtz'],
            "tbtz"=>$dd['ddtbtz'],
            "sign"=>$sign
        );
        if($dd['agentje']!=null){//�����������Ϊ��
            $agentje=$dd['agentje'];//�������ý��
            $agentuser=$dd['agent'];//��������
            queryg(co_agent_sys,"yue=yue+$agentje where agentuser='$agentuser'");//����ԭ���˻�����������ý��
        }
        $sdje=$dd['sdje'];//�̻����ý��
        queryg(co_user_sys,"yue=yue+$sdje where user='$yhm'");//ԭ���˻�����������ý��
        if(curlPost($url,$data)){
            queryg(co_dingdan,"ddtzzt='֪ͨ�ɹ�' where ddh='$out_trade_no' and ddje='$je'");
        }else{
            queryg(co_dingdan,"ddtzzt='֪ͨʧ��' where ddh='$out_trade_no' and ddje='$je'");
            header("location:$url");
        }
    }
}

?>
<html>
<head>
<title>Return from API Page</title>
</head>
<body>
</body>
</html>