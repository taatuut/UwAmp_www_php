<?php

$str = 'ets{"serverID":1531156402,"serverName":"tag009441190987","systemProfile":"easyTravel","data":{"browserErrors":0,"audioStreams":0,"isp":"DRN-AS - Dickey Rural Networks","videoStreams":0,"location":{"country":"United States","region":"North Dakota","city":"Ellendale","continent":"North America"},"connectionType":"Broadband","application":"easyTravel portal","clientType":"browser","businessTransactions":{"Conversion+visits":{"measures":{},"splittings":null},"Visits+by+connection+type":{"measures":{},"splittings":{"Connection+Type+of+Visits":"Broadband (>1500kb/s)"}}},"endTime":1485520593828,"bandwidth":5496,"visitId":24888,"duration":171,"startTime":1485520593657,"appVersion":"1.4","ipAddress":"65.23.161.234","visitTag":emil,"clientDetails":{"browserFamily":"Firefox","browserVersion":"33.0","osVersion":"Windows 7","osFamily":"Window';


$rgx = '/"visitTag":([\w]*),/';
preg_match($rgx, $str, $out);
echo $out[1];


?>