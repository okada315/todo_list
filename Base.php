<?php

class Base
{
    protected $dbh;

    const DB_NAME = 'LAA1399398-todo';

    const DB_HOST = 'mysql201.phy.lolipop.lan';

    const DB_USER = 'LAA1399398';

    const DB_PASS = 'okada315';

    public function __construct()
    {
        $dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_HOST . ';charset=utf8';

        $this->dbh = new PDO($dsn, self::DB_USER, self::DB_PASS);

        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function begin()
    {
        $this->dbh->beginTransaction();
    }

    public function commit()
    {
        $this->dbh->commit();
    }

    public function rollback()
    {
        $this->dbh->rollback();
    }
}
