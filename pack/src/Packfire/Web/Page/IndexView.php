<?php
namespace Packfire\Web\Page;

use Packfire\Application\Pack\View;
use Packfire\Web\MenuView;

/**
 * IndexView class
 * 
 * View for the homepage
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Web\Page
 */
class IndexView extends View {
    
    protected function create() {
        $menu = new MenuView(0);
        $menu->copyBucket($this);
        $this->define('menu', $menu);
        
        $this->define('features', $this->state->get('features'));
        
        $this->define('link.getstarted', $this->route('getStarted'));
        $this->define('rootUrl', $this->route('home'));
    }

}