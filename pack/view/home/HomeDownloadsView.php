<?php
pload('app.AppView');

/**
 * HomeDownloads View
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2012, Sam-Mauris Yong / mauris@hotmail.sg
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package app.view
 * @since 1.0
 */
class HomeDownloadsView extends AppView {
    
    protected function create(){
        $menu = new MenuView(2);
        $menu->copyBucket($this);
        $this->define('menu', $menu);
        
        $rootUrl = $this->route('home');
        $this->define('rootUrl', $rootUrl);
        
        $this->define('showForm', $this->state ? true : false);
        $this->define('downloads', $this->state);
    }
    
}