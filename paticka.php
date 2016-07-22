<?php
	// zapis do statistiky
	define("_BBC_PAGE_NAME", $_REQUEST['s']);
	define("_BBCLONE_DIR", "bbclone/");
	define("COUNTER", _BBCLONE_DIR."mark_page.php");

	if (is_readable(COUNTER))
		include_once(COUNTER);

	echo("<br><br>\n");
	echo("<div style='clear: both'>\n");
	echo("<div style='font-size: 9pt;' align=center>\n");
	echo("designed by <a href='http://trsek.com/curriculum' style='font-size: 12pt; font-weight: bold; color: rgb(73, 85, 120)'>Zdeno Sekerak</a>(c) 2016<br>\n");
	echo("</div>\n");

	require("bbclone/var/access.php");
	// spocti hodiny
	$dayvisit = 0;
	foreach ($access['time']['hour'] as $val) $dayvisit += $val;

    echo("<table cellpadding='1' cellspacing='10' style='font-size: 9pt;' align=center>");
    echo("<tr>");
    echo("<td> Generated: ".date('d.m.y, h:i a').", duration: " .stop_meas()."s </td>");
    echo("<td> Number of visitors: <a href='/bbclone/index.php'>". $access['stat']['totalvisits']."</a> </td>");
    echo("<td> Days visitors: ". $dayvisit." </td>");
    echo("<td> Counter started: ". date("d.m.y", $access['time']['reset'])." </td>");
    echo("</tr>");
    echo("</table>");

    echo("</div>\n");
    echo("</body>\n");
    echo("</html>\n");
?>
