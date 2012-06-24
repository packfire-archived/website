<?php
pload('packfire.controller.pController');
pload('packfire.exception.pMissingDependencyException');
pload('packfire.text.pInflector');

/**
 * AppController class
 * 
 * The generic application controller class
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package candice.app
 * @since 1.0-sofia
 */
abstract class AppController extends pController {
    
    public function render($view = null) {
        if(func_num_args() == 0){
            $dbt = debug_backtrace();
            $func = $dbt[1]['function'];
            $firstUpper = pInflector::firstUpperCase($func);
            if($firstUpper !== false){
                $func = substr($func, $firstUpper);
            }
            $name = get_class($this);
            if(substr($name, -10) == 'Controller'){
                $name = substr($name, 0, strlen($name) - 10);
            }
            $class = $name . $func . 'View';
            try{
                pload('view.' . strtolower($name) . '.' . $class);
            }catch(pMissingDependencyException $ex){
                try{
                    pload('view.' . $class);
                }catch(pMissingDependencyException $ex){
                    
                }
            }
            if(class_exists($class)){
                $view = new $class();
            }
        }
        if($view){
            parent::render($view);
        }else{
            throw new pMissingDependencyException('View not rendered because not found.');
        }
    }
    
}