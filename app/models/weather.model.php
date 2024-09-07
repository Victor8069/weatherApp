<?php

class WeatherModel
{
    private $pdo;
    public $city;
    public $desc;
    public $temp;
    public $usrid;

    public function __construct()
    {
        try {
            $this->pdo = Database::Conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Select($usrid)
    {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM weather_log 
                                        WHERE user_id = ?
                                        ORDER BY id DESC");
            $sql->execute(array($usrid));
            return $sql->fetchALL(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }    

    public function Insert(WeatherModel $data)
    {
        try {
            $sql = "INSERT INTO weather_log(city,weather_desc,temperature,date_log,user_id)
					VALUES(?,?,?,CURRENT_TIMESTAMP,?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->city,
                        $data->desc,
                        $data->temp,
                        $data->usrid
                    )
                );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function Delete($id)
    {
        try {
            $sql = "DELETE FROM tbl_usuario WHERE usu_numdnt=?";
            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $id
                    )
                );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Get($id)
    {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM tbl_usuario
																				  WHERE tbl_usuario.usu_numdnt = ?
																				");
            $sql->execute(array($id));
            return $sql->fetchALL(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



}
