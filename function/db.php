<?php
/**
 *
 * Created by PhpStorm.
 * User: Dron84
 * Date: 05.10.2018
 * Time: 10:01
 * AutorSite: uniquesite.ru
 *
 * connection to db
 */
class db extends mysqli
{
    private $host   = '192.168.1.2';
    private $user   = 'root';
    private $pass   = 'Pu$!k2509';
    private $sqldb  = 'polter';
    
//    private $host   = 'localhost';
//    private $user   = 'xnsevdbd_elect';
//    private $pass   = 'S+l$L-5d6O4Z';
//    private $sqldb  = 'xnsevdbd_election';


  function __construct()
  {
		$this->con = new mysqli($this->host, $this->user, $this->pass, $this->sqldb);
	/* проверка соединения */
		if ($this->con->connect_errno) {
		    printf("Соединение не удалось: %s\n", $this->con->connect_error);
		    exit();
		}
  }
  public function createDB(){
    $sql = "CREATE TABLE `users` (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            nickname VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            admin BOOLEAN NOT NULL DEFAULT FALSE,
            premission_users TEXT,
            premission_group TEXT,
            pass TEXT NOT NULL,
            reg_date TIMESTAMP);
            INSERT INTO `users` (firstname, lastname, nickname, email, admin, pass,premission_group) VALUES ('Andrey','Sharunov','Dron84','Dron84@gmail.com',TRUE,'MTIz','1');
            INSERT INTO `users` (firstname, lastname, nickname, email, admin, pass,premission_group) VALUES ('user','user','user','user@gmail.com',FALSE,'MTIz','2');
            CREATE TABLE `group`(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            users_id TEXT NOT NULL,
            group_name VARCHAR(50),
            premission TEXT,
            reg_date TIMESTAMP);
            INSERT INTO `group` (users_id, group_name, premission) VALUES ('1','Admin`s','all');
            INSERT INTO `group` (users_id, group_name, premission) VALUES ('2','users','users');
            ";
    $this->con->query($sql);
  }

}

?>
