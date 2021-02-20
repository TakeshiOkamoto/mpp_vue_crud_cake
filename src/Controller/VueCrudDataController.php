<?php
namespace App\Controller;

use App\Controller\AppController;

// 追加分
use Cake\Datasource\ConnectionManager;
use Cake\Core\Exception\Exception;

class VueCrudDataController extends AppController
{
    public function initialize()
    {
        // 親クラスのinitialize()
        parent::initialize();
            
        // レイアウト
        $this->viewBuilder()->setLayout('main');

        // モデル
        $this->loadModel('VueCrudData');
    }
    
    // 初期化
    public function init()
    {
        // トランザクション
        $con = ConnectionManager::get('default');
        $con->begin();
        try{        
            $con->execute('TRUNCATE TABLE vue_crud_data;');
            $con->execute('INSERT INTO vue_crud_data SELECT * FROM vue_crud_data_bk;');
                
            // コミット
            $con->commit();
            
        // ロールバック
        } catch (Exception $e) {
            $con->rollback();
            $this->Flash->error(__('エラーが発生しました。管理者に問い合わせてください。'));
        }
        
        return $this->redirect(['action' => 'index']);       
    }
        
    public function index()
    {
        // none
    }
    
    // Ajaxは全て以下のURLでアクセスする
    // http://localhost:8765/api.json
    public function api()
    {
        $method = $this->request->getMethod();
        if(isset($method)){
          
            // ---------------------
            //  一覧の取得
            // ---------------------
            if($method == "GET"){
                $json = $this->VueCrudData->find()->order(['updated_at' => 'desc']);
                
                // GETのJSONは次のような配列形式となる
                //
                //  [
                //    {"id": 1, "name": "プチモンテ"}
                //    {"id": 2, "name": "プチラボ"  }
                //    {"id": 3, "name": "@ゲーム"   }
                //  ]  
                // ※それ以外は配列でないので注意してください。 
                
            // ---------------------
            //  データの登録
            // ---------------------  
            }else if ($method == "POST"){
                             
                $vue_crud_data = $this->VueCrudData->newEntity();
                $vue_crud_data = $this->VueCrudData->patchEntity($vue_crud_data, $this->request->getData());
               
                // 成功
                if ($this->VueCrudData->save($vue_crud_data)) {
                    $json = [
                                'msg'  => 'Ajaxによるデータの登録が成功しました。', 
                                'id'   => $vue_crud_data->id,
                                'name' => $vue_crud_data->name,
                                'comment'    => $vue_crud_data->comment,
                                'updated_at' => $vue_crud_data->updated_at,
                            ];   
                           
                // エラー時
                }else{
                    $json = [
                                'msg' => 'Ajaxによるデータの登録が失敗しました。', 
                                'id'  => 'error',
                            ];
                }

            // ---------------------
            //  データの更新
            // ---------------------
            }else if ($method == "PUT"){
                
                $vue_crud_data = $this->VueCrudData->get($this->request->getQuery('id'));
                $vue_crud_data = $this->VueCrudData->patchEntity($vue_crud_data, $this->request->getData());
                                
                // 成功
                if ($this->VueCrudData->save($vue_crud_data)) {
                    $json = [
                                'msg'  => 'Ajaxによるデータの更新が成功しました。', 
                            ];   
                // エラー時
                }else{
                    $json = [
                                'msg'  => 'Ajaxによるデータの更新が失敗しました。', 
                            ];   
                }
                      
            // ---------------------
            //  データの削除
            // ---------------------
            }else if ($method == "DELETE"){
           
                $vue_crud_data = $this->VueCrudData->get($this->request->getQuery('id'));
                                
                // 成功
                if ($this->VueCrudData->delete($vue_crud_data)) {
                    $json = [
                               'msg'  => 'Ajaxによるデータの削除が成功しました。', 
                            ];   
                // エラー時
                }else{
                    $json = [
                               'msg'  => 'Ajaxによるデータの削除が失敗しました。', 
                            ];   
                }
            }  
            
            // JSON出力
            $this->set(compact('json'));  
            $this->set('_serialize', 'json');
        }
        
        // 次のURLでアクセスした際はビューテンプレートはなし
        // http://localhost:8765/api
        $ext = $this->request->getParam('_ext');
        if(!(isset($ext) && $ext == 'json')){
            $this->autoRender = false;
        }
    }
}
