<?php
class ORM {
	private $PDOinst = null;
	private static $instance = null;

	protected function __construct() {
		try {
			require_once 'config/database.php';
			$this->PDOinst = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$this->PDOinst->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOExeption $e) {
			echo "Connection failed:" . $e->getMessage();
		}
	}


	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new ORM();
		}
		return self::$instance;
	}

	public function createDB() {
			$this->PDOinst->exec('CREATE DATABASE camagru');
	}

	public function execDB($var = null) {
		if (!is_null($var)) {
			try {
				$this->PDOinst->exec($var);
				return true;
			} catch (PDOExeption $e) {
				return false;
			}
		}
	}

	 public function setData($table, $val, $data) {
	 	ORM::getInstance()->execDB('USE camagru');
		try {
			$tmp = $this->PDOinst->prepare('INSERT INTO ' . $table . ' (' . $data . ')' . ' VALUES (' . $val . ')');
			$tmp->execute();
			return true;
		} catch (PDOExeption $e) {
			echo $e->getMessage();
			return false;
		}
	 }

	 public function getTabinfo($table, $Where = null) {
		ORM::getInstance()->execDB('USE camagru');
		try {
			if (is_null($Where)) {
				$tmp = $this->PDOinst->prepare('SELECT * FROM ' . $table);
			} else {
				$tmp = $this->PDOinst->prepare('SELECT * FROM ' . $table . ' WHERE ' . $Where);
			}
			$tmp->execute();
			$res = $tmp->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOExeption $e) {
			echo $e->getMessage();
		}
		return $res;
	 }

	public function modData($table,  $val, $data) {
		ORM::getInstance()->execDB('USE camagru');
		try {
			$tmp = $this->PDOinst->prepare('UPDATE ' . $table . ' SET ' . $val . ' WHERE ' . $data);
			$tmp->execute();
			return true;
		} catch (PDOExeption $e) {
			return false;
		}
	}

	public function delData($table, $val) {
		try {
			$tmp = $this->PDOinst->prepare('DELETE FROM ' . $table . ' WHERE ' . $val);
			$tmp->execute();
			return true;
		} catch (PDOExeption $e) {
			return false;
		}
	}
}
?>
