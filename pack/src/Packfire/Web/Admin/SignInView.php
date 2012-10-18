<?php
namespace Packfire\Web\Admin;

use Packfire\Application\Pack\View;
use Packfire\Web\MenuView;

/**
 * SignInView View
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2012, Sam-Mauris Yong / mauris@hotmail.sg
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Web\Admin
 * @since 1.0
 */
class SignInView extends View {
    
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