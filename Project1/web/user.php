<?php
// call the class
 $user = new MyClass;

 if($_SERVER['REQUEST_METHOD'] === 'POST')
{   // fetching the input from class
    $user_name =$_POST["name"];
    $user_email =$_POST["email"];
    $user_ID =$_POST["ID"];
    $user_CellNumber =$_POST["CellNumber"];
   $user_homeAddress = $_POST["homeAddress"];

    // assigning the data into edit boxes
    $user->set_name("$user_name");
    $user->set_email("$user_email");
    $user->set_ID("$user_ID");
    $user->set_CellNumber("$user_CellNumber");
   $user->set_homeAddress("$user_homeAddress");
}

// fetching from class into outputting
if($_SERVER['REQUEST_METHOD'] === 'POST')
{ 
    echo"Name: ".$user->get_name();
    echo"<br>";
    echo"email: ".$user->get_email();
    echo"<br>";
    echo"Identity number: ".$user->get_ID();
    echo"<br>";
    echo"Cellphone: ".$user->get_CellNumber();
    echo"<br>";
    echo"Address: ".$user->get_homeAddress(); 

}


?>
  
