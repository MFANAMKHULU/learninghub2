<?php

$user = new User;

if($_SERVER['REQUEST_METHOD'] === 'POST')
{   // fetching the input from class
   $user_name =$_POST["name"];
   $user_email =$_POST["email"];
   $user_ID =$_POST["ID"];
   $user_CellNumber =$_POST["password"];

}


  ?>