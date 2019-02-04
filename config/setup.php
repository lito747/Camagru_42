<?php

function checkDB($ins) {
	try {
		$ret = $ins->exec('CREATE DATABASE camagru');
	} catch (PDOExeption $e){
		return 0;
	} finally {
		if ($ret == "")
			return 0;
		file_put_contents("log", $ret);
	}
	return 1;
}

try {
	$DB_DSN = 'mysql:3306';
    $DB_USER = 'root';
    $DB_PASSWORD = '123456';
	$PDOinst = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$PDOinst->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOExeption $e) {
		echo "Connection failed:" . $e->getMessage();
}
if (checkDB($PDOinst)) {
	$PDOinst->exec('USE camagru');
	$PDOinst->exec('CREATE TABLE Users (
    								ID int NOT NULL AUTO_INCREMENT,
    								Login varchar(100) NOT NULL,
    								Pass varchar(128) NOT NULL,
    								Token varchar(128),
    								Email varchar(100) NOT NULL,
    								is_auto bit DEFAULT 0,
    								is_notif bit DEFAULT 1,
									UNIQUE (ID, Login, Pass, Email)
									)');
	$PDOinst->exec('CREATE TABLE Likes (
									ID int NOT NULL AUTO_INCREMENT,
									PIC_ID int NOT NULL,
									USR_ID int NOT NULL,
									UNIQUE (ID))');
	$PDOinst->exec('CREATE TABLE Picture (
										ID int NOT NULL AUTO_INCREMENT,
										Pic_Path varchar(1024),
										USR_ID int NOT NULL,
										UNIQUE (ID))');
	$PDOinst->exec('CREATE TABLE Chat (
									USR_Login varchar(255) NOT NULL,
											USR_Masage varchar(1024) NOT NULL,
											USR_ID int NOT NULL,
											PIC_ID int NOT NULL)');
				$PDOinst->exec('INSERT INTO Picture(Pic_Path, USR_ID)
											VALUES("/img/user_pic/228582906-fantasy-images.jpg", 1)');
				$PDOinst->exec('INSERT INTO Picture (Pic_Path, USR_ID)
											VALUES("/img/user_pic/CMS_Creative_164657191_Kingfisher.jpg",1)');
				$PDOinst->exec('INSERT INTO Picture (Pic_Path, USR_ID)
											VALUES("/img/user_pic/fondos-globales-de-internet-y-de-las-comunicaciones-32553090.jpg", 1)');
				$PDOinst->exec('INSERT INTO Picture (Pic_Path, USR_ID)
											VALUES("/img/user_pic/images.jpeg", 1)');
				$PDOinst->exec('INSERT INTO Picture (Pic_Path, USR_ID)
											VALUES("/img/user_pic/mac.jpg", 1)');
				$PDOinst->exec('INSERT INTO Picture (Pic_Path, USR_ID)
											VALUES("/img/user_pic/pic_trulli.jpg", 1)');
				$PDOinst->exec('INSERT INTO Picture (Pic_Path, USR_ID)
											VALUES("/img/user_pic/soap-bubble-1958650_960_720.jpg", 1)');
				$PDOinst->exec('INSERT INTO Picture (Pic_Path, USR_ID)
											VALUES("/img/user_pic/teddy-day-images-pexels-650_650x400_61518152570.jpg", 1)');
				$PDOinst = null;
}
