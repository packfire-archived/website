<?php
pload('app.AppView');

/**
 * AdminSignInView View
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2012, Sam-Mauris Yong / mauris@hotmail.sg
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package app.view
 * @since 1.0
 */
class AdminSignInView extends AppView {
    
    protected function create(){
        $menu = new MenuView();
        $menu->copyBucket($this);
        $this->define('menu', $menu);
        
        $rootUrl = $this->route('home');
        $this->define('rootUrl', $rootUrl);
        
        if($this->state->get('fail')){
            $this->define('failMessage', $this->state->get('fail'));
        }
    }
    
}