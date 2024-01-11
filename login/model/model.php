<?php
// model for 
/*final class User{
    private $name;
    private $email;
    private $ID;
    private $password;

        
    // name
    function set_name($name)
    { $this->name = $name;}
    
    // email
    
    function set_email($email) 
    { $this->email = $email;}

    // id
    
    function set_ID($ID)
     { $this->ID = $ID;}
    
    // password
    function set_CellNumber($password) 
    { $this->password = $password;}
    

    };*/

final class Helper{ 	
    // Don't touch anything here
      public static function getUrlParam($name) {
          if (!array_key_exists($name, $_GET)) {
              throw new NotFoundException('URL parameter "' . $name . '" not found.');
          }
          return $_GET[$name];
      }
  
      public static function redirect($page, array $params = []) {
          header('Location: ' . self::createLink($page, $params));
          die();
      }
  
      public static function createLink($page, array $params = []) {
          unset($params['page']);
          return (empty($params))?$page :$page.'&'.http_build_query($params);
      }
  
      public static function capitalize($string) {
          return ucfirst(mb_strtolower($string));
      }
  
      public static function escape($string) {
          return htmlspecialchars($string, ENT_QUOTES);
      }
  };
  
?>