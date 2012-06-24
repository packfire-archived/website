<?php
pload('app.AppController');

/**
 * HomeController class
 * 
 * Handles interaction for home
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package candice.controller
 * @since 1.0-sofia
 */
class HomeController extends AppController {
    
    public function doIndex(){
        $this->state['features'] = array(
            array(
                'title' => 'Truly Object-Oriented',
                'text' => 'Packfire is a full OO framework that helps you to design your application to be clear and highly reusable. If you are a C#, Java or any OO language developer, you will love PHP using Packfire. '
            ),
            array(
                'title' => 'MVC Designed',
                'text' => 'Designed with the well-proven Model-View-Controller (MVC) architecture, Packfire allows you develop with Separation of Concerns (SoC) for ease of testing and writing code.'
            ),
            array(
                'title' => 'Easily Extensible',
                'text' => 'Due to Packfire\'s OO nature, you can easily extend and re-implement any part of the framework for your application without modifying the framework source code directly.'
            ),
            array(
                'title' => 'Secured and Hardened',
                'text' => 'When set for production, the framework is automatically hardened to the highest security. Input validation, injection prevention measures and sniffing deterrence give hackers no chance of entry.'
            ),
            array(
                'title' => 'Test and Debug',
                'text' => 'Packfire provides a toolbox full of testing support and debugging utilities. You can write your code knowing that they are are well tested and bug-free.'
            ),
            array(
                'title' => 'Modern technologies',
                'text' => 'Emerging server-side technologies and concepts such as JSON, YAML, Mustache, LINQ and IoC are incorporated into Packfire for great development efficiency with gentle learning curve.'
            )
        );
        $this->render();
    }
    
    public function doScreencasts(){
        $screencasts = $this->service('database')->from('contents')
                ->where('ContentType = 1')->select('Title', 'Content')
                ->map(function($x){
                    return array(
                            'title' => $x[0],
                            'videoId' => $x[1]
                        );
                })->fetch();
        if($screencasts->count() > 0){
            $this->state = $screencasts;
        }else{
            $this->state = false;
        }
        $this->render();
    }
    
}