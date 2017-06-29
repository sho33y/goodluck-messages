<?php
namespace App\Controller\Admin;

use App\Controller\Component\ImageUploader;
use RuntimeException;

/**
 * Goodlucks Controller
 *
 * @property \App\Model\Table\GoodlucksTable $Goodlucks
 *
 * @method \App\Model\Entity\Goodluck[] paginate($object = null, array $settings = [])
 */
class GoodlucksController extends AdminController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $goodlucks = $this->paginate($this->Goodlucks);

        $this->set(compact('goodlucks'));
        $this->set('_serialize', ['goodlucks']);
    }

    /**
     * View method
     *
     * @param string|null $id Goodluck id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $goodluck = $this->Goodlucks->get($id, [
            'contain' => []
        ]);

        $this->set('goodluck', $goodluck);
        $this->set('_serialize', ['goodluck']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $goodluck = $this->Goodlucks->newEntity();
        if ($this->request->is('post')) {
            $goodluck = $this->Goodlucks->patchEntity($goodluck, $this->request->getData());

            try {
                $goodluck['image_name'] = ImageUploader::fileUpload($this->request->getData('image'), SAVE_IMG_PATH, IMG_SIZE_MAX);
            } catch (RuntimeException $e){
                $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                $this->Flash->error(__($e->getMessage()));
            }

            if ($this->Goodlucks->save($goodluck)) {
                $this->Flash->success(__('The goodluck has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The goodluck could not be saved. Please, try again.'));
        }
        $this->set(compact('goodluck'));
        $this->set('_serialize', ['goodluck']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Goodluck id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $goodluck = $this->Goodlucks->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $request = $this->request->getData();
            $goodluck = $this->Goodlucks->patchEntity($goodluck, $request);
            $goodluck = $this->editImage($request, $goodluck);

            if ($this->Goodlucks->save($goodluck)) {
                $this->Flash->success(__('The goodluck has been saved.'));

                if (isset($request['file_delete'])) {
                    $this->set(compact('goodluck'));
                    return $this->redirect(['action' => 'edit', $id]);
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The goodluck could not be saved. Please, try again.'));
        }
        $this->set(compact('goodluck'));
        $this->set('_serialize', ['goodluck']);
    }

    /**
     * 画像編集処理
     *
     * @param $request
     * @param $goodluck
     * @return mixed
     */
    private function editImage($request, $goodluck)
    {
        // deleteボタンがクリックされたとき
        if (isset($request['file_delete'])) {
            $delResult = ImageUploader::fileDelete($request['file_before'], SAVE_IMG_PATH);
            $goodluck['image_name'] = $delResult['file'];
            if ($delResult['error']) {
                throw new RuntimeException($delResult['error']);
            }
        } else {
            // ファイルが入力されたとき
            if ($request['image']['name']){
                try {
                    $goodluck['image_name'] = ImageUploader::fileUpload($request['image'], SAVE_IMG_PATH, IMG_SIZE_MAX);
                    // ファイル更新の場合は古いファイルは削除
                    if (isset($request['file_before'])) {
                        // ファイル名が同じ場合は削除を実行しない
                        if ($request['file_before'] != $goodluck['image_name']) {
                            $delResult = ImageUploader::fileDelete($request['file_before'], SAVE_IMG_PATH);
                            if($delResult['error']) {
                                $this->log("ファイル更新時に下記ファイルが削除できませんでした。", LOG_DEBUG);
                                $this->log($request['file_before'], LOG_DEBUG);
                            }
                        }
                    }
                } catch (RuntimeException $e){
                    // アップロード失敗の時、既登録ファイルがある場合はそれを保持
                    if (isset($request['file_before'])){
                        $goodluck['image_name'] = $request['file_before'];
                    }
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                    $this->Flash->error(__($e->getMessage()));
                }
            } else {
                // ファイルは入力されていないけど登録されているファイルがあるとき
                if (isset($request['file_before'])){
                    $goodluck['image_name'] = $request['file_before'];
                }
            }
        }

        return $goodluck;
    }

    /**
     * Delete method
     *
     * @param string|null $id Goodluck id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $goodluck = $this->Goodlucks->get($id);
        if ($this->Goodlucks->delete($goodluck)) {
            $this->Flash->success(__('The goodluck has been deleted.'));
        } else {
            $this->Flash->error(__('The goodluck could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
