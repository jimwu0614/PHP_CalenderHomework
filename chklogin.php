<?php
$default_acc='123';
$default_pw='321';

$acc=$_POST['acc'];
$pw=$_POST['pw'];

$error="";


if ($acc!=$default_acc || $pw!=$default_pw) {    
    header("location:calender02.php?acc=$acc");    
}else{
    header("location:calender.php?acc=$acc");    
}



?>