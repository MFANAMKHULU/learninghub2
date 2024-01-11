<?php
/**
 * Controller Class Api & access point
 * 
 * @category    Controller
 * @package     FirstTest
 * @author      RamakhanyaD <techcodehive@gmail.com>
 * @license     openSource 
 * @link        https://revtech.co.za
 */



/**
 * Exception which causes HTTP ERROR 404 (Not Found).
 */
class NotFoundException extends Exception { // first class to load and last to load
}

// where we load the page from when we run
final class Index{

  const LAYOUT_DIR = '/layout/';
  const PAGE_DIR = '/web/';
  const LAYOUT_PAGE='index.phtml';
  const DEFAULT_PAGE = 'home';
  
  // where we declare our classes along with their location
  private static $CLASS = [
    'User' => '/view/view.php', // name of class  and it's location folder then file
    'NotFoundException' => 'index.php',
    'Helper' =>'/model/model.php'
    
  ];

  
    function __construct(){
      // error reporting - all errors for development (ensure you have display_errors = On in your php.ini file)
      error_reporting(E_ALL | E_STRICT);
      mb_internal_encoding('UTF-8');
      set_exception_handler([$this, 'handleException']);
      spl_autoload_register([$this, 'loadClass']);
      // session handler setup
      try{
      
      }catch( Exception $e){
        throw $e;
      }
  }

  
  public function loadClass($name){
    if (!array_key_exists($name, self::$CLASS)) { // tell which class, where should find data
        die('Class "' . $name . '" not found.');  // remove die and throw an not found exeption
      //throw new exception("Class doesn't exist".$name);// if class doesn't exist die
    }
    require_once __DIR__.self::$CLASS[$name];
  }

  
  public function handleException($ex) {
    $extra = ['message' => $ex->getMessage()];
    if ($ex instanceof NotFoundException) {
        header('HTTP/1.0 404 Not Found');
        $this->runPage('404', $extra);
    } else {
        // TODO log exception
        header('HTTP/1.1 500 Internal Server Error');
        $this->runPage('500', $extra);
    }
  }

  
  private function runPage($page, array $extra = []) {
      
      $run = false;
      if ($this->hasScript($page)) {
        $run = true;
        require $this->getScript($page);
      }
      if ($this->hasTemplate($page)) {
        $run = true;
        
        $template = $this->getTemplate($page);
         
      
        require __DIR__.self::LAYOUT_DIR.self::LAYOUT_PAGE;
      }
      if (!$run) {
        throw new NotFoundException('Page "' . $page . '" has neither script nor template!');
      }
  }
  // difference between 404 and 500 
  // 404 resource not found
  // 500 

  /**
   * 
   */
  private function getPage() {
    $page = self::DEFAULT_PAGE;
    if (array_key_exists('page', $_GET)) {
      $page = $_GET['page'];
    }
    return $this->checkPage($page);
  }

  /**
   * 
   */
  private function checkPage($page) {
      if (!preg_match('/^[a-z0-9-]+$/i', $page)) {
      
        throw new NotFoundException('Unsafe page "' . $page . '" requested');
      }
      if (!$this->hasScript($page)
          && !$this->hasTemplate($page)) {
      
        throw new NotFoundException('Page "' . $page . '" not found');
      }
      return $page;
  }

  
  private function hasScript($page) {
    return file_exists($this->getScript($page));
  }

  
  private function getScript($page) {
    return __DIR__.self::PAGE_DIR.$page.'.php';
  }

  
  private function hasTemplate($page) {
      return file_exists($this->getTemplate($page));
  } 
  

  private function getTemplate($page) {
      return __DIR__.self::PAGE_DIR.$page.'.phtml';
  }

  
  public function run() {
      $this->runPage($this->getPage());
  }
}

$index = new Index();
$index->run();