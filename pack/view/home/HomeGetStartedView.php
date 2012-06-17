<?php
pload('app.AppView');
pload('view.MenuView');

/**
 * HomeGetStartedView class
 * 
 * The view handler for get started page
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package candice.controller
 * @since 1.0-sofia
 */
class HomeGetStartedView extends AppView {
    
    protected function create() {
        $menu = new MenuView(1);
        $menu->copyBucket($this);
        $this->define('menu', $menu);
        
        $rootUrl = $this->route('home');
        $this->define('rootUrl', $rootUrl);
    }
    
}