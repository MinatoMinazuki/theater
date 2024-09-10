<?php

require_once __DIR__."/config.php";

/**
  *
  */
class connect
{
  private $dbh;

  // データベースに接続
  function __construct()
  {
    $dsn = 'mysql:host='.HOST.';dbname='.DB_NAME.';charset='.UTF;
    try{
      $this->dbh = new PDO($dsn, USER, PASS);
    } catch(Exception $e) {
      exit($e->getMessage());
    }

    $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }

  public function select($sql){
    $stmt = $this->dbh->query($sql);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $items;
  }

  public function Dsql($sql){
    try {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        return $stmt;
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
        return false;
    }
  }
}

?>