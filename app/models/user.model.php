<?php

class UserModel
{
    private $pdo;
    public $user;
    public $pass;
    public $email;

    public function __construct()
    {
        try {
            $this->pdo = Database::Conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Select($rol)
    {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM tbl_usuario 
															
															INNER JOIN tbl_rol 
															INNER JOIN tbl_estado 
															INNER JOIN tbl_tipoid 
															WHERE tbl_usuario.usu_rolid = tbl_rol.rol_id 
															AND tbl_usuario.usu_estid = tbl_estado.est_id 
															AND tbl_usuario.usu_tipid = tbl_tipoid.tip_id
															AND tbl_usuario.usu_rolid = ?
															ORDER BY tbl_usuario.usu_numdnt DESC");
            $sql->execute(array($rol));
            return $sql->fetchALL(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }    

    public function Insert(UserModel $data)
    {
        try {
            $sql = "INSERT INTO user_weather(username,password,email)
					VALUES(?,?,?)";

            $this->pdo->prepare($sql)
                ->execute(
                    array(
                        $data->user,
                        md5($data->pass),
                        $data->email
                    )
                );
        } catch (PDOException $e) {
            $usuExist = $e->getCode();
            if ($usuExist == 23000) {
                echo "EXISTS";
            } else {                
                die($e->getMessage());
            }
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

    public function Login($user, $pass)
    {
        try {
            $sql = $this->pdo->prepare("CALL LOGIN(?,?)");
            $sql->execute(array($user, $pass));
            return $sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
        }
    }


    public function Logout($id)
    {
        try {
            $sql = $this->pdo->prepare("DELETE FROM tbl_login WHERE log_usunumdnt = ?;");
            $sql->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


}
