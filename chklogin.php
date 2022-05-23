<?php
$default_acc='123';
$default_pw='321';

$acc=$_POST['acc'];
$pw=$_POST['pw'];


if ($acc!=$default_acc || $pw!=$default_pw) {    
    header("location:calenderArray.php?acc=$acc");    
}else{
    header("location:calenderLoop.php?acc=$acc");    
}


 
?>