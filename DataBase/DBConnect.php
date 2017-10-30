<?php

class DBConnect {

    public function getDB() {
        $connStr = "host=localhost port=5432 dbname=englishpractice user=postgres password=root";
        return pg_connect($connStr);
    }

}
