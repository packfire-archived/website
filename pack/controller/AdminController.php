<?php
pload('app.AppController');

/**
 * AdminController Controller
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2012, Sam-Mauris Yong / mauris@hotmail.sg
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package app.controler
 * @since 1.0
 */
class AdminController extends AppController {
    
    const INVALID_LOGIN = 'Invalid username or password entered.';
    
    protected function handleAuthorization(){
        $this->redirect($this->route('adminSignIn'));
    }
    
    public function getIndex(){
        $this->state['types'] = $this->service('database')->from('contenttypes')
            ->select('ContentTypeId', 'ContentType')
            ->map(function($x){
                return array(
                    'ContentTypeId' => $x[0],
                    'ContentType' => $x[1]
                );
            })
            ->fetch();
            
        $this->render();
    }
    
    public function postIndex(){
        
    }
    
    public function getSignIn(){
        if($this->service('security')->identity()){
            $this->redirect($this->route('admin.home'));
        }else{
            if($this->service('messenger')->check('loginFail', __CLASS__ . ':signIn')){
                $this->state['fail'] = $this->service('messenger')->read('loginFail', __CLASS__ . ':signIn');
            }
            pload('view.admin.AdminSignInView');
            $this->render(new AdminSignInView());
        }
    }
    
    public function postSignIn(){
        
        // this is a post request, so you can perform sign in and identity assignment
        $username = $this->params->get('username');
        $password = $this->params->get('password');
        if($username && $password){
            try{
                $users = $this->service('database')->from('users')
                        ->where('Username = :username AND Password = :password')
                        ->param('username', $username)
                        ->param('password', hash('sha256', $password))
                        ->select('UserId', 'Username', 'Name', 'Timezone')
                        ->map(function($x){
                            return array(
                                'UserId' => $x[0],
                                'Username' => $x[1],
                                'Name' => $x[2],
                                'Timezone' => $x[3]
                            );
                        })
                        ->limit(0, 1)
                        ->fetch();
                if($users->count() > 0){
                    $user = $users[0];
                    $this->service('security')->identity($user);
                    $this->redirect($this->route('admin.home'));
                    return;
                }else{
                    $this->service('messenger')
                        ->send('loginFail', __CLASS__ . ':signIn', self::INVALID_LOGIN);
                }
            }catch(Exception $ex){
                $this->service('messenger')
                    ->send('loginFail', __CLASS__ . ':signIn', $ex->getMessage());
            }
        }else{
            $this->service('messenger')
                ->send('loginFail', __CLASS__ . ':signIn', self::INVALID_LOGIN);
        }
        $this->redirect($this->route('adminSignIn'));
    }
    
    public function doSignOut(){
        $this->service('security')->deauthenticate();
        $this->redirect($this->route('home'));
    }
    
    public function getChangePassword(){
        $this->state['types'] = $this->service('database')->from('contenttypes')
            ->select('ContentTypeId', 'ContentType')
            ->map(function($x){
                return array(
                    'ContentTypeId' => $x[0],
                    'ContentType' => $x[1]
                );
            })
            ->fetch();
            
        $this->render();
    }
    
    public function postChangePassword(){
        
    }
    
}