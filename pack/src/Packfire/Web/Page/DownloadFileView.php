<?php
namespace Packfire\Web\Page;

use Packfire\Application\Pack\View;
use Packfire\Web\MenuView;

/**
 * DownloadFileView class
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Web\Page
 */
class DownloadFileView extends View {
    
    protected function create(){
        $menu = new MenuView(2);
        $menu->copyBucket($this);
        $this->define('menu', $menu);
        
        $rootUrl = $this->route('home');
        $this->define('rootUrl', $rootUrl);
        
        $this->define('file', $this->state);
    }
    
}