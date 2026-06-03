<?
error_reporting(E_ALL);
require("con_mysql.php");
mysql_query("DELETE FROM stat_top WHERE IP='77.239.179.143'");

$time_con=floor(time()/86400)*86400-date('Z')-1;
$time_nach=$time_con-86400+1;

$r=mysql_query("SELECT itemID,stype,COUNT(DISTINCT IP) AS hosts,COUNT(DISTINCT userID) AS users,COUNT(*) AS hits FROM stat_top WHERE date_add BETWEEN $time_nach AND $time_con GROUP BY itemID,stype");
while ($f=mysql_fetch_array($r)) {
  $rr=mysql_query("SELECT ID FROM stat_daily WHERE itemID=$f[itemID] AND stype='$f[stype]' AND date_add=$time_nach");
  if (mysql_num_rows($rr)) {
    mysql_query("UPDATE stat_daily SET hosts=$f[hosts],users=$f[users],hits=$f[hits] WHERE itemID=$f[itemID] AND stype='$f[stype]' AND date_add=$time_nach");
  } else {
    mysql_query("INSERT INTO stat_daily SET itemID=$f[itemID],stype='$f[stype]',hosts=$f[hosts],users=$f[users],hits=$f[hits],date_add=$time_nach");
  }
}

mysql_query("DELETE FROM stat_top WHERE date_add<".(time()-86400*8)); //8 day
mysql_query("OPTIMIZE TABLE stat_top");

?>