<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'DebugKit.Toolbar', 
        'Session', 
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'logins',
                'action' => 'add',
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish',
                )
            )
        )
    );
    public $helpers = array('Session');

    public $statusCode = array(
        200 => 'OK: リクエストに成功しました。',
        201 => 'Created: 作成に成功しました。',
        400 => 'BadRequest: 未入力の項目があるか、入力内容が間違っています。',
        401 => 'AuthorizationRequired: 認証が失敗しているか、未認証の状態です。',
        403 => 'Forbidden: 権限がありません。',
        404 => 'NotFound: リソースが存在しません。',
        409 => 'Conflict: 重複しています。',
        500 => 'InternalServerError: サーバエラーです。',
        503 => 'ServiceUnavailable: メンテナンス中か、サーバがダウンしています。',
    )

    public $cToken; // TokenCheck用
    public function beforeFilter(){
        if(isset($this->data)){ // POST or GETされたとき（API叩いたとき）
            foreach($this->data as $key => $value){
                if ($key === 'token') // 一次元配列のとき
                    $cToken = $this->User->checkToken($value);
                else if(array_key_exists('token', $value)){ // 二次元配列のとき
                    $cToken = $this->User->checkToken($value['token']);
                } 
            }     
        }
    }
}
