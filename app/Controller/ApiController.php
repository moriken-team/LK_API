<?php
/**
 * Common API Controller
 * When if you make a Controller used API, please extends this Controller
 */

App::uses('AppController', 'Controller');

class ApiController extends AppController {
    // RequestHandlerでJsonView呼び出す
    public $components = array('RequestHandler');

    // JSONで返す値を格納する配列
    protected $result = array();

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow();
        // XSS対策でAjax以外のアクセス禁止
        //if (!$this->request->is('ajax')) throw new BadRequestException('Ajax以外でのアクセスは許可していません。');

        // meta情報
        $this->result['meta'] = array(
            'url' => $this->request->here,
            'method' => $this->request->method(),
        );

        // IEのXSS対策でnosniffつけるらしい
        $this->response->header('X-Content-Type-Options', 'nosniff');
    }

    // 成功処理
    protected function success($response = array()){
        $this->result['response'] = $response;

        $this->set('meta', $this->result['meta']);
        $this->set('response', $this->result['response']);
        $this->set(array(
            '_serialize' => array('meta', 'response'),
            '_jsonp' => true, // jsonp対応
        ));
    }
    // エラー処理
    protected function error($message = '', $code){
        $this->result['error']['message'] = $message;
        $this->result['error']['code'] = $code;

        $this->response->statusCode(400);
        $this->set('meta', $this->result['meta']);
        $this->set('error', $this->result['error']);
        $this->set(array(
            '_serialize' => array('meta', 'error'),
            '_jsonp' => true, // jsonp対応
        ));
    }

    // バリデーションエラー系処理
    protected function validationError($modelName, $validationError = array()) {
        $this->result['error']['message'] = 'Validation Error';
        $this->result['error']['code'] = 400;
        $this->result['error']['validation'][$modelName] = array();
        foreach($validationError as $key => $value){
            $this->result['error']['validation'][$modelName][$key] = $value[0];
        }

        $this->response->statusCode(400);
        $this->set('meta', $this->result['meta']);
        $this->set('error', $this->result['error']);
        $this->set(array(
            '_serialize' => array('meta', 'error'),
            '_jsonp' => true, // jsonp対応 
        )); 
    }
}
?>
