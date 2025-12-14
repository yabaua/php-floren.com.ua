<?php
class DB2 {
    private $link_id = null;    // соединение
    public $last_sql = '';      // последний SQL-запрос
    public $last_error = '';    // последняя ошибка
    private $results = [];      // массив результатов
    
    public $sql_count=0;
    public $sql_time_count=0;
    public $start_time;
    public $end_time;
    public $total;

    /**
     * Подключение к базе данных
     */
    public function connect($host = 'floren.mysql.tools', $user ='floren_db2025', $pass='m9286DRfUv', $dbname='floren_db2025', $charset = 'utf8mb4') {
        $this->link_id = new mysqli($host, $user, $pass, $dbname);

        if ($this->link_id->connect_errno) {
            die("❌ Ошибка подключения к MySQL на хосте '{$host}': " . $this->link_id->connect_error);
        }

        if (!$this->link_id->set_charset($charset)) {
            die("⚠️ Ошибка установки кодировки ($charset): " . $this->link_id->error);
        }

        return true;
    }

    /**
     * Выполнение SQL-запроса
     */
    public function query($sql, $resultIndex = 0) {
        $this->last_sql = $sql;
        $this->last_error = '';
        
        $microtime=microtime();
        $this->start_time=substr($microtime,11).'.'.substr($microtime,2,8);

        if (!$this->link_id instanceof mysqli) {
            die("❌ Нет активного соединения с базой данных");
        }

        $res = $this->link_id->query($sql);

        if ($res === false) {
            $this->last_error = $this->link_id->error;
            error_log("MySQL Error: " . $this->last_error . " | Query: " . $sql);
            die("❌ SQL ошибка: " . htmlspecialchars($this->last_error) . "<br>📜 Запрос: " . htmlspecialchars($sql));
        }

        $microtime=microtime();
        $this->end_time=substr($microtime,11).'.'.substr($microtime,2,8);
        $this->total=$this->end_time-$this->start_time;
        $this->sql_time_count+=$this->total;
        $this->sql_count++;

        $this->results[$resultIndex] = $res;
        return $res;
    }

    /**
     * Получение одной строки результата (ассociative array)
     */
    public function fetch($resultIndex = 0) {
        if (isset($this->results[$resultIndex]) && $this->results[$resultIndex] instanceof mysqli_result) {
            return $this->results[$resultIndex]->fetch_assoc();
        }
        return null;
    }

    /**
     * Количество строк в результате
     */
    public function num_rows($resultIndex = 0) {
        if (isset($this->results[$resultIndex]) && $this->results[$resultIndex] instanceof mysqli_result) {
            return $this->results[$resultIndex]->num_rows;
        }
        return 0;
    }

    /**
     * Закрытие соединения
     */
    public function close() {
        if ($this->link_id instanceof mysqli) {
            $this->link_id->close();
            $this->link_id = null;
        }
    }
    public function error($echo = false) {
        $error = $this->last_error;

        if ($this->link_id instanceof mysqli && $this->link_id->error) {
            $error = $this->link_id->error;
        }

        if ($echo) {
            echo "❌ Ошибка SQL: " . htmlspecialchars($error);
        }

        return $error;
    }
    public function insert_id() {
        if ($this->link_id instanceof mysqli) {
            return $this->link_id->insert_id;
        }
        return 0;
    }
}
?>
