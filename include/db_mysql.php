<?php
class DB2 {

    public $link_id;
    public $result = [];
    public $old_sql;
    public $sql_count = 0;
    public $sql_time_count = 0;
    public $start_time;
    public $end_time;
    public $total;

    // Нормальный конструктор
    public function __construct() {}

    public function connect(
        $host = 'floren.mysql.tools',
        $user = 'floren_utf2025',
        $pass = 'i4d4XB48bV',
        $dbname = 'floren_utf2025',
        $charset = 'utf8'
    ) {
        $this->link_id = new mysqli($host, $user, $pass, $dbname);

        if ($this->link_id->connect_errno) {
            die(
                'MySQL CONNECT ERROR (' .
                $this->link_id->connect_errno .
                '): ' .
                $this->link_id->connect_error
            );
        }

        if (!$this->link_id->set_charset($charset)) {
            die(
                'SET CHARSET ERROR: ' .
                $this->link_id->error
            );
        }

        $this->link_id->query("SET SESSION query_cache_type = OFF");

        return $this->link_id;
    }

    public function close() {
        if ($this->link_id instanceof mysqli) {
            $this->link_id->close();
        }
    }
    public function escape($str){
        return mysqli_real_escape_string($this->link_id, $str);
    }
    public function query($sql, $result = 0) {

        if (!($this->link_id instanceof mysqli)) {
            die('MySQL link is not initialized');
        }

        $this->old_sql = $sql;

        $microtime = microtime(true);
        $this->start_time = $microtime;

        $this->result[$result] = $this->link_id->query($sql);

        if ($this->result[$result] === false) {
          
            if ($_SERVER['SERVER_NAME']!='floren.com.ua') {

                echo "<pre style='color:red'>";
                echo "SQL ERROR\n";
                echo "Errno: " . $this->link_id->errno . "\n";
                echo "Error: " . $this->link_id->error . "\n\n";
                echo "SQL:\n" . $sql;
                echo "</pre>";
                exit;
            } else {
                ob_start();
          			echo date("d/m/Y h:i:s").'<BR>';
          			echo $_SERVER['REQUEST_URI'].'<BR>';
          			echo "Errno: " . $this->link_id->errno . "<BR>";
                echo "Error: " . $this->link_id->error . "<BR>";
          			echo '<FONT COLOR="#FF0000"><BR>' . htmlspecialchars($sql) . '</FONT><BR>';
          			echo 'GET<PRE>';
          			print_r($_GET);
          			echo '</PRE>';
          			echo 'POST<PRE>';
          			print_r($_POST);
          			echo '</PRE>';
          			echo 'COOKIE<PRE>';
          			print_r($_COOKIE);
          			echo '</PRE>';
          			echo 'SERVER<PRE>';
          			print_r($_SERVER);
          			echo '</PRE>';
          			//phpinfo();
          			$text=ob_get_contents();
          			ob_end_clean();
          			@mail('info@floren.com.ua', $_SERVER['SERVER_NAME'].' SQL error', $text, 'Content-Type: text/html; charset=utf-8');
            }
          
        }

        $this->end_time = microtime(true);
        $this->total = $this->end_time - $this->start_time;

        $this->sql_time_count += $this->total;
        $this->sql_count++;

        return $this->result[$result];
    }

    public function fetch($result = 0) {
        if (!isset($this->result[$result])) {
            return false;
        }
        return $this->result[$result]->fetch_array(MYSQLI_BOTH);
    }

    public function free_result($result = 0) {
        if (isset($this->result[$result]) && $this->result[$result] instanceof mysqli_result) {
            $this->result[$result]->free();
        }
    }
  
    public function num_rows($result = 0) {
        if (!isset($this->result[$result])) {
            return 0;
        }
        return $this->result[$result]->num_rows;
    }

    public function insert_id() {
        return $this->link_id->insert_id;
    }

    public function affected_rows() {
        return $this->link_id->affected_rows;
    }
}
?>
