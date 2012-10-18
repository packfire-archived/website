<?php
namespace Packfire\Web;

use Packfire\Application\Pack\View;

/**
 * MenuView View
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2012, Sam-Mauris Yong / mauris@hotmail.sg
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package app.view
 * @since 1.0
 */
class MenuView extends View {
    
    private $active;
    
    public function __construct($active = null){
        parent::__construct();
        $this->active = $active;
    }
    
    protected function create(){        
        $menu = array(
            array(
                'text' => 'Home',
                'link' => $this->route('home')
            ),
            array(
                'text' => 'Get Started',
                'link' => $this->route('getStarted')
            ),
            array(
                'text' => 'Downloads',
                'link' => $this->route('downloads')
            ),
            array(
                'text' => 'Screencasts',
                'link' => $this->route('screencasts')
            ),
            array(
                'text' => 'Blog',
                'link' => $this->route('blogPosts')
            )
        );
        
        if($this->active !== null){
            $menu[$this->active]['active'] = true;
        }
        
        $this->define('menu', $menu);
    }
    
}