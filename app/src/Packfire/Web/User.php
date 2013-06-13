<?php
namespace Packfire\Web;

use Packfire\Database\IModel;
use Packfire\IoC\BucketUser;

/**
 * User class
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2012, Sam-Mauris Yong / mauris@hotmail.sg
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package Packfire\Web
 * @since 1.0
 */
class User extends BucketUser implements IModel {
    
    public $userId;
    
    public $name;
    
    public $username;
    
    public $password;
    
    public $created;
    
    public $timezone;
    
    public function dbName(){
        return 'users';
    }
    
    public function map(){
        return array(
                'UserId' => 'userId',
                'Name' => 'name',
                'Username' => 'username',
                'password' => 'password',
                'Timezone' => 'timezone',
                'Created' => 'created'
            );
    }
    
}