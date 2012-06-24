<?php
pload('app.AppView');

/**
 * HomeIndexView class
 * 
 * View for the homepage
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package app.view
 * @since 1.0
 */
class HomeIndexView extends AppView {
    
    protected function create() {
        $menu = new MenuView(0);
        $menu->copyBucket($this);
        $this->define('menu', $menu);
        
        $this->define('features', $this->state->get('features'));
        
        $this->define('link.getstarted', $this->route('getStarted'));
        $this->define('rootUrl', $this->route('home'));
    }

}