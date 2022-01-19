<?php

class API_Config {

    public function __construct()
    {
        $this->db();
    }

    /*
    =========================================================
    =================== DATABASE CONNEXION ==================
    =========================================================
    */

    protected function db($dataBase = false)
    {
        $host = 'localhost';        //myHostAdress
        $dbname = 'gcpv9290_api'; //myDataBaseName
        $dbuser = 'gcpv9290_admin';    //myUserName
        $dbpw = 'Lespaul96!';        //myPassword

        $pdoReqArg1 = "mysql:host=". $host .";dbname=". $dbname .";";
        $pdoReqArg2 = $dbuser;
        $pdoReqArg3 = $dbpw;

        try {

            $db = new \PDO($pdoReqArg1, $pdoReqArg2, $pdoReqArg3);
            $db->setAttribute(\PDO::ATTR_CASE, \PDO::CASE_LOWER);
            $db->setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);
            $db->exec("SET NAMES 'utf8'");

            return $db;

        } catch(\PDOException $e) {

            $errorMessage = $e->getMessage();
        }
    }

    public function getAllTable($table)
    {
        $db = $this->db();

        try {

            $qry = "SELECT * FROM " . $table;
            $stt = $db->prepare($qry);
            $stt->execute();
            return $stt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {

            echo json_encode(['data' => null, 'error' => $e->getMessage()]);
            exit();
        }
    }

    public function getOneFrom($table, $data)
    {
        $db = $this->db();

        try {

            $qry = ($table === 'users') ? "SELECT * FROM users WHERE id = " . $data : "SELECT * FROM articles WHERE slug = '" . $data . "'";
            $stt = $db->prepare($qry);
            $stt->execute();
            return $stt->fetch(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {

            echo json_encode(['data' => null, 'error' => $e->getMessage()]);
            exit();
        }
    }
}