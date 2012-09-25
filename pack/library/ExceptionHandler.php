<?php
pload('packfire.exception.handler.pHttpExceptionHandler');
pload('view.ExceptionView');

/**
 * ExceptionHandler class
 */
class ExceptionHandler extends pHttpExceptionHandler {
    
    /**
     * Handle exception
     * @param Exception $exception
     */
    public function handle($exception) {
        $view = new ExceptionView($exception);
        $view->copyBucket($this);
        echo $view->render();
    }
    
}