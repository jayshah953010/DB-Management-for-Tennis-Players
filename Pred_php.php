<?php
 include 'FINAL_HEADER.php';
// Connects to the XE service (i.e. database) on the "localhost" machine
$u="jsshah";
$p="Yash!12081997";
$db="oracle.cise.ufl.edu/orcl";
$conn = oci_connect($u,$p,$db);

if(!$conn) 
{
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
else
{
	$p1f = $_GET['p1fname'];
	$p2f = $_GET['p2fname'];
	$p1l = $_GET['p1lname'];
	$p2l = $_GET['p2lname'];
	$c = $_GET['coat'];

	print '<center><table border="1">';
	$stid3 = oci_parse($conn, "select 0.2*T_W_P + 0.2* T_W_2P + 0.3* T_W_3P + 0.3* T_W_4P as Winning_Chances from 
(select (w1 / (w1 + l1 ) )*100 as T_W_P from (select count(wid) as w1 from winner where wid = (select pid from player where firstname = '$p1f' and lastname = '$p1l')),(select count(lid) as l1 from loser where lid = (select pid from player where firstname = '$p1f' and lastname = '$p1l'))),

(select (w1 / (w1 + l1) ) * 100 as T_W_2P from (select count(wid) as w1 from tournament_match where wid = (select pid from player where firstname = '$p1f' and lastname = '$p1l') and lid = (select pid from player where firstname = '$p2f' and lastname = '$p2l')),
(select count(lid) as l1 from tournament_match where wid = (select pid from player where firstname = '$p2f' and lastname = '$p2l') and lid = (select pid from player where firstname = '$p1f' and lastname = '$p1l'))),

(select (w1 / (w1 + l1) ) * 100 as T_W_3P from (select count(wid) as w1 from tournament_match where wid = (select pid from player where firstname = '$p1f' and lastname = '$p1l') and lid = (select pid from player where firstname = '$p2f' and lastname = '$p2l') and tid in (select tid from tournament where surface = '$c')),
(select count(lid) as l1 from tournament_match where wid = (select pid from player where firstname = '$p2f' and lastname = '$p2l') and lid = (select pid from player where firstname = '$p1f' and lastname = '$p1l') and tid in (select tid from tournament where surface = '$c'))),


(select w1,l1,(w1 / (w1 + l1) ) * 100 as T_W_4P from (select count(wid) as w1 from tournament_match where wid = (select pid from player where firstname = '$p1f' and lastname = '$p1l') and lid in (select pid from rating where RDATE > '24-DEC-2016' and rating > (select rating from (select pid,rating,rownum as rank from rating where RDATE > '24-DEC-2016') where pid = (select pid from player where firstname = '$p1f' and lastname = '$p1l'))) and tid in (select tid from tournament where year = 2016)),
(select count(lid) as l1 from tournament_match where lid = (select pid from player where firstname = '$p1f' and lastname = '$p1l') and wid in (select pid from rating where RDATE > '24-DEC-2016' and rating > (select rating from (select pid,rating,rownum as rank from rating where RDATE > '24-DEC-2016') where pid = (select pid from player where firstname = '$p1f' and lastname = '$p1l'))) and tid in (select tid from tournament where YEAR = 2016)))");
	$r3 = oci_execute($stid3);

	$stid4 = oci_parse($conn, "select 0.2*T_W_P + 0.2* T_W_2P + 0.3* T_W_3P + 0.3* T_W_4P as Winning_Chances from 
(select (w1 / (w1 + l1 ) )*100 as T_W_P from (select count(wid) as w1 from winner where wid = (select pid from player where firstname = '$p2f' and lastname = '$p2l')),(select count(lid) as l1 from loser where lid = (select pid from player where firstname='$p1f' and lastname = '$p1l'))),

(select (w1 / (w1 + l1) ) * 100 as T_W_2P from (select count(wid) as w1 from tournament_match where wid = (select pid from player where firstname = '$p2f' and lastname = '$p2l') and lid = (select pid from player where firstname='$p1f' and lastname = '$p1l')),
(select count(lid) as l1 from tournament_match where wid = (select pid from player where firstname='$p1f' and lastname = '$p1l') and lid = (select pid from player where firstname = '$p2f' and lastname = '$p2l'))),

(select (w1 / (w1 + l1) ) * 100 as T_W_3P from (select count(wid) as w1 from tournament_match where wid = (select pid from player where firstname = '$p2f' and lastname = '$p2l') and lid = (select pid from player where firstname='$p1f' and lastname = '$p1l') and tid in (select tid from tournament where surface = '$c')),
(select count(lid) as l1 from tournament_match where wid = (select pid from player where firstname='$p1f' and lastname = '$p1l') and lid = (select pid from player where firstname = '$p2f' and lastname = '$p2l') and tid in (select tid from tournament where surface = '$c'))),


(select w1,l1,(w1 / (w1 + l1) ) * 100 as T_W_4P from (select count(wid) as w1 from tournament_match where wid = (select pid from player where firstname = '$p2f' and lastname = '$p2l') and lid in (select pid from rating where RDATE > '24-DEC-2016' and rating > (select rating from (select pid,rating,rownum as rank from rating where RDATE > '24-DEC-2016') where pid = (select pid from player where firstname = '$p2f' and lastname = '$p2l'))) and tid in (select tid from tournament where year = 2016)),
(select count(lid) as l1 from tournament_match where lid = (select pid from player where firstname = '$p2f' and lastname = '$p2l') and wid in (select pid from rating where RDATE > '24-DEC-2016' and rating > (select rating from (select pid,rating,rownum as rank from rating where RDATE > '24-DEC-2016') where pid = (select pid from player where firstname = '$p2f' and lastname = '$p2l'))) and tid in (select tid from tournament where YEAR = 2016)))");
	$r4 = oci_execute($stid4);


	//print '<tr><td><b>'. $p1f . " ". $p1l . '</b></td><td><b>' . $p2f. " ". $p2l . '</b></td></tr>';
	
			$row13 = oci_fetch_row($stid3);
			$row14 = oci_fetch_row($stid4);
			$t = round($row13[0],2);
			$q = round($row14[0],2);
	if($t>$q)
	print '<h3>'. $p1f . " ". $p1l . ' has <b>'. $t.'% </b> chances of winning against '.$p2f . " ". $p2l .'.</h3>';
	else
	print '<h3>'. $p2f . " ". $p2l . ' has <b>'. $q.'% </b> chances of winning against '.$p1f . " ". $p1l .'.</h3>';
	// . $q . '%</td></tr></table></center>';
	
}

?>