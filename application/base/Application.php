<?php
namespace app\base;
use app\base\Request;
class Application {

    public function __construct() {
        $request = new Request();
    }
    
}