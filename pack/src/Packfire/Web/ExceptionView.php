<?php
pload('app.AppView');
pload('packfire.exception.pHttpException');

/**
 * ExceptionView class
 */
class ExceptionView extends AppView {
    
    private $exception;
    
    public function __construct($exception){
        $this->exception = $exception;
        parent::__construct();
    }
    
    protected function create() {
        $this->define('rootUrl', $this->route('home'));
        $this->define('is404', $this->exception instanceof pHttpException && $this->exception->getCode() == '404');
    }
    
}