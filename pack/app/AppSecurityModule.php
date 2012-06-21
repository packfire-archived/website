<?php
pload('packfire.security.pSecurityModule');

/**
 * AppSecurityModule
 * 
 * The application's security module
 * Configure by overriding the appropriate methods.
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package candice.app
 * @since 1.0-sofia
 */
class AppSecurityModule extends pSecurityModule {
    
    public function authenticate() {
        return parent::authenticate();
    }

    public function authorize($route) {
        return parent::authorize($route);
    }

    public function deauthenticate() {
        parent::deauthenticate();
    }
    
}