<?php
namespace Packfire\Web\Admin;

use Packfire\Application\Pack\Controller as CoreController;
use Packfire\DateTime\DateTime;
use Packfire\Database\Expression;

/**
 * Controller class
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2012, Sam-Mauris Yong / mauris@hotmail.sg
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Web\Admin
 * @since 1.0
 */
class Controller extends CoreController {
    
    const INVALID_LOGIN = 'Invalid username or password entered.';
    
    protected function handleAuthorization(){
        if(substr($this->ioc['route']->name(), 0, 6) == 'admin.' 
                && !$this->ioc['security']->identity()){
            $this->redirect($this->route('adminSignIn'));
        }
        return true;
    }
    
    public function index(){
        $identity = $this->ioc['security']->identity();
        $this->state['timeOfDay'] = $this->renderTimeOfDay($identity);
        
        $this->state['types'] = $this->ioc['database']->from('contenttypes')
            ->select('ContentTypeId', 'ContentType')
            ->map(function($x){
                return array(
                    'ContentTypeId' => $x[0],
                    'ContentType' => $x[1]
                );
            })
            ->fetch();
            
        if($this->ioc['messenger']->check('postFail')){
            $this->state['fail'] = $this->ioc['messenger']->read('postFail');
        }
        if($this->ioc['messenger']->check('postSuccess')){
            $this->state['success'] = $this->ioc['messenger']->read('postSuccess');
        }
            
        $this->render();
    }
    
    public function postIndex($title, $contentType, $content){
        
        if($title && $contentType && $content){
            $identity = $this->ioc['security']->identity();
            try{
                $this->ioc['database']->table('contents')->insert(array(
                    'Author' => $identity['userId'],
                    'Title' => $title,
                    'Content' => $content,
                    'ContentType' => $contentType,
                    'Created' => new Expression('NOW()')
                ));
                $this->ioc['messenger']->send(
                        'postSuccess',
                        __CLASS__ . ':index',
                        'Content created successfully!'
                    );
            }catch(\Exception $ex){
                $this->ioc['messenger']->send(
                        'postFail',
                        __CLASS__ . ':index',
                        $ex->getMessage()
                    );
            }
        }else{
            $this->ioc['messenger']->send(
                    'postFail',
                    __CLASS__ . ':index',
                    'Fields cannot be empty.'
                );
        }
        $this->redirect($this->route('admin.home'));
    }
    
    public function signIn(){
        if($this->ioc['security']->identity()){
            $this->redirect($this->route('admin.home'));
        }else{
            if($this->ioc['messenger']->check('loginFail')){
                $this->state['fail'] = $this->ioc['messenger']->read('loginFail');
            }
            $this->render();
        }
    }
    
    public function postSignIn($username, $password){
        // this is a post request, so you can perform sign in and identity assignment
        if($username && $password){
            try{
                $users = $this->ioc['database']->from('users')
                        ->where('Username = :username AND Password = :password')
                        ->param('username', $username)
                        ->param('password', hash('sha256', $password))
                        ->model($this->model('Packfire\Web\User'))
                        ->limit(0, 1)
                        ->fetch();
                if($users->count() > 0){
                    $user = (array)$users[0];
                    $this->ioc['security']->identity($user);
                    $this->redirect($this->route('admin.home'));
                    return;
                }else{
                    $this->ioc['messenger']->send(
                            'loginFail',
                            __CLASS__ . ':signIn',
                            self::INVALID_LOGIN
                        );
                }
            }catch(\Exception $ex){
                $this->ioc['messenger']->send(
                        'loginFail',
                        __CLASS__ . ':signIn',
                        $ex->getMessage()
                    );
            }
        }else{
            $this->ioc['messenger']->send(
                    'loginFail',
                    __CLASS__ . ':signIn',
                    self::INVALID_LOGIN
                );
        }
        $this->redirect($this->route('adminSignIn'));
    }
    
    public function signOut(){
        $this->ioc['security']->deauthenticate();
        $this->redirect($this->route('home'));
    }
    
    public function changePassword(){
        $identity = $this->ioc['security']->identity();
        $this->state['timeOfDay'] = $this->renderTimeOfDay($identity);
        
        if($this->ioc['messenger']->check('changeFail')){
            $this->state['fail'] = $this->ioc['messenger']->read('changeFail');
        }
        if($this->ioc['messenger']->check('changeSuccess')){
            $this->state['success'] = $this->ioc['messenger']->read('changeSuccess');
        }
            
        $this->render();
    }
    
    public function postChangePassword($oldPassword, $newPassword, $confirmPassword){
        
        if($newPassword && $newPassword == $confirmPassword){
            $identity = $this->ioc['security']->identity();
            // check if the old password is correct
            $user = $this->ioc['database']->from('users')
                    ->where('UserId = :userId AND Password = :password')
                    ->param('userId', $identity['userId'])
                    ->param('password', hash('sha256', $oldPassword))
                    ->model($this->model('Packfire\Web\User'))
                    ->limit(0, 1)
                    ->fetch()->get(0);
            if($user){
                // now update the password since the old password is correct
                $this->ioc['database']->table('users')
                        ->update(array(
                            'UserId' => $user->userId,
                            'Password' => hash('sha256', $newPassword)
                            ));
                $this->ioc['messenger']->send(
                        'changeSuccess',
                        __CLASS__ . ':changePassword',
                        'Password changed successfully.'
                    );
            }else{
                $this->ioc['messenger']->send(
                        'changeFail',
                        __CLASS__ . ':changePassword',
                        'Your old password is invalid.'
                    );
            }
        }else{
            $this->ioc['messenger']->send(
                    'changeFail',
                    __CLASS__ . ':changePassword',
                    'Your new password is empty or it does not match with the confirmation password.'
                );
        }
        $this->redirect($this->route('admin.changePassword'));
    }
    
    private function renderTimeOfDay($user){
        $now = DateTime::now();
        $now->timezone($user['timezone']); // convert to user's timezone
        $hour = $now->time()->hour();
        $result = 'night';
        if($hour > 3 && $hour < 12){
            $result = 'morning';
        }elseif($hour < 17){
            $result = 'afternoon';
        }elseif($hour < 22){
            $result = 'evening';
        }
        return $result;
    }
    
}