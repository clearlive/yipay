<?php

/*网站配置*/
	if($web['sitestatus']=='no'){
		if(basename(__DIR__)!='webadmin'){
			exit("网站已关闭");
		}
	}

?>