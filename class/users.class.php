<?php

class Users {

    private static $instancia;
    private $dbh;

    /*
     * metoodo que realizara la conexion a la base de datos
     * si la conexion es correcta no pasara nada pero si falla
     * nos mostrara el error 
     */

    private function __construct() {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=crud_pdo', 'root', '');
            $this->dbh->exec("SET CHARACTER SET utf8");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    /*
     * se hace uso del patron Singleton, se realiza un return de instancia
     * le cual nos permitira hacer uso de esta donde deseemos 
     */

    public static function singleton() {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    /*
     * Devuelve todos los datos de la tabla users
     */

    public function get_usuarios() {
        try {
            $query = $this->dbh->prepare('SELECT * FROM users'); // se realiza la consulta
            $query->execute(); // se ejecuta
            return $query->fetchAll(); // se devuelve el resultado en forma de array
            $this->dbh = null; // cerramos conexion 
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function delete_usuario($id) {
        try {
            $query = $this->dbh->prepare('delete from users where id = ?');
            $query->bindParam(1, $id);
            $query->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function insert_usuario($nombre, $email, $registro) {
        try {
            $query = $this->dbh->prepare('INSERT INTO users VALUES(null,?,?,?)');
            $query->bindParam(1, $nombre);  
            $query->bindParam(2, $email);
            $query->bindParam(3, $registro);
            $query->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function update_usuario($id, $nombre, $email, $fecha) {
        try {
            $query = $this->dbh->prepare('update users SET nombre = ?, email = ?, registro = ? WHERE id = ?');
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $email);
            $query->bindParam(3, $fecha);
            $query->bindParam(4, $id);
            $query->execute();
            $this->dbh = null;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function __clone() {
        trigger_error('La clonacion no es perimitida!.', E_USER_ERROR);
    }

}

?>
