<?php

$input_line = '{"serverID":1531156402,"serverName":"tag009441190987","systemProfile":"easyTravel","data":{"name":"click on \"Search\"","location":{"country":"Taiwan","region":"","continent":"Asia","city":"Taipei"},"type":"click","target":{"url":"http://localhost:8080/orange.jsf","title":"easyTravel - One step to happiness"},"clientErrors":0,"actionGroup":"Search Actions","navTiming":{"connect":0,"dns":1,"processing":543,"documentRequest":119,"documentResponse":36,"urlRedirect":-1,"ssl":-1},"domready":0,"onLoad":-1,"source":{"url":"http://localhost:8080/orange.jsf","title":"easyTravel - One step to happiness","viewDuration":3096},"adkStrings":{},"adkValues":{},"serverErrors":0,"metaData":null,"xhrUrl":"http://localhost:8080/CalculateRecommendations","agentId":125745543,"tagId":6009,"visitId":37912,"application":"easyTravel portal","resourceSummary":null,"serverContributionTime":62.43664,"networkContributionTime":190.56335,"failingReasons":null,"businessTransactions":{"End+User+Actions+by+Country":{"measures":{"Count":1.0},"splittings":{"Country+of+Visits":"Taiwan"}},"Pageview+Apdex+by+URL":{"measures":{"Apdex":1.0},"splittings":{"URL+of+Page+Actions":"/orange.jsf"}},"Pageview+Apdex+by+Country":{"measures":{"Apdex":1.0},"splittings":{"Country+of+Visits":"Taiwan"}},"End+User+Actions+by+Apdex+zone":{"measures":{"Count":1.0},"splittings":{"Apdex+performance+zone+for+Page+Actions":"satisfied"}},"Pageview+Apdex+by+Application":{"measures":{"Apdex":1.0},"splittings":null},"Pageview+Apdex+by+URL+%28Landing+Pages%29":{"measures":{"Apdex":1.0},"splittings":{"URL+of+Page+Actions":"/orange.jsf"}},"Pageviews+by+Apdex+performance+zone+and+Country":{"measures":{"Count":1.0},"splittings":{"Apdex+performance+zone+for+Page+Actions":"satisfied","Country+of+Visits":"Taiwan"}},"Pageviews+by+Apdex+performance+zone":{"measures":{"Count":1.0},"splittings":{"Apdex+performance+zone+for+Page+Actions":"satisfied"}},"User+Action+by+Connection+Type":{"measures":{"Count":1.0},"splittings":{"Connection+Type+of+Visits":"Broadband (>1500 kb/s)"}},"easyTravel+Sales+Search":{"measures":{"Apdex":1.0},"splittings":{"easyTravel+Sales+Search+Action":"Search"}}},"perceivedRenderTimeSlowestImageSrc":null,"startTime":1485992956519,"actionGroupPerformanceBaseline":4000,"perceivedRenderTime":-1,"endTime":1485992956772,"appVersion":"1.5","responseTime":253.0,"prettyName":"click on \"Search\"","clientDetails":{"browserVersion":"4.0","browserFamily":"Android browser","osFamily":"Android","osVersion":"Android 2.3.x Gingerbread"},"isFailed":0,"visitTag":"harihar","userExperience":"satisfied","additionalTags":{},"apdex":1.0,"cdnContribution":-1.0,"firstPartyContribution":-1.0,"thirdPartyContribution":-1.0}}';

//echo $input_line;

preg_match("/(?<=\"visitTag\":\")(.*?)(?=\",)/", $input_line, $output_array);
echo '$output_array = '.$output_array[0];
echo '$output_array = '.$output_array[1];

$myarray = json_decode($input_line, true);
$visitTag = $myarray['data']['visitTag'];

//echo '$visitTag = '.$visitTag;

?>
