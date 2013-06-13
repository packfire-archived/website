<?php
namespace Packfire\Web;

use Packfire\Application\Pack\View;
use Packfire\Exception\HttpException;

/**
 * ExceptionView class
 */
class ExceptionView extends View {
    
    private $exception;
    
    public function __construct($exception){
        $this->exception = $exception;
        parent::__construct();
    }
    
    protected function create() {
        $this->define('rootUrl', $this->route('home'));
        $this->define('is404', $this->exception instanceof HttpException && $this->exception->getCode() == '404');
    }
    
}