<?php
namespace App\Controller;

use App\Controller\Component\ImageUploader;
use RuntimeException;

/**
 * Goodlucks Controller
 *
 * @property \App\Model\Table\GoodlucksTable $Goodlucks
 *
 * @method \App\Model\Entity\Goodluck[] paginate($object = null, array $settings = [])
 */
class GoodlucksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate['limit'] = 10;
        $goodlucks = $this->paginate($this->Goodlucks);

        $sliderNums = range(1,35);
        shuffle($sliderNums);

        $this->set(compact('goodlucks', 'sliderNums'));
    }

    /**
     * View method
     *
     * @param string|null $id Goodluck id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function message($id = null)
    {
        $goodluck = $this->Goodlucks->get($id);

        $this->set('goodluck', $goodluck);
        $this->set('_serialize', ['goodluck']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function form()
    {
        $goodluck = $this->Goodlucks->newEntity();
        if ($this->request->is('post')) {
            $mode = $this->request->getData('mode');
            switch ($mode) {
                // 確認画面へ
                case 'confirm':
                    $goodluck = $this->Goodlucks->patchEntity($goodluck, $this->request->getData());
                    // 画像アップロード
                    $goodluck = $this->setImage($this->request->getData(), $goodluck);
                    if (!$goodluck->getErrors()) {
                        $this->request->session()->write('form', $goodluck);
                        $this->set(compact('goodluck'));
                        $this->render('confirm');
                    } else {
                        $this->set(compact('goodluck'));
                        $this->render('input');
                    }
                    break;
                // 戻るボタン
                case 'return':
                    $goodluck = $this->request->session()->read('form');
                    $this->set(compact('goodluck'));
                    $this->render('input');
                    break;
                // 完了画面へ
                case 'complete':
                    $goodluck = $this->request->session()->read('form');
                    if (!$goodluck) {
                         return $this->redirect(['_name' => 'home']);
                    }
                    if ($this->Goodlucks->save($goodluck)) {
                        $this->request->session()->delete('form');
                         $this->render('complete');
                    } else {
                        $this->Flash->error(__('登録できませんでした。お手数ですがもう一度お試しください。'));
                        $this->set(compact('goodluck'));
                        $this->render('input');
                    }
                    break;
                case 'img_delete':
                    $goodluck = $this->Goodlucks->patchEntity($goodluck, $this->request->getData());
                    $goodluck = $this->setImage($this->request->getData(), $goodluck);
                    $this->set(compact('goodluck'));
                    $this->render('input');
                    break;
                default:
                    $this->set(compact('goodluck'));
                    $this->render('input');
                    break;
            }
        }
        else {
            $this->set(compact('goodluck'));
            $this->render('input');
        }
    }

    /**
     * フォームに画像をセット
     *
     * @param $request
     * @param $goodluck
     * @return mixed
     */
    private function setImage($request, $goodluck)
    {
        $imageUploader = new ImageUploader();
        // 画像取り消しボタンがクリックされたとき
        if (isset($request['mode']) && $request['mode'] == 'img_delete') {
            $delResult = $imageUploader->fileDelete($request['file_before'], SAVE_IMG_PATH);
            $goodluck['image_name'] = $delResult['file'];
            if ($delResult['error']) {
                throw new RuntimeException($delResult['error']);
            }
        } else {
            // ファイルが入力されたとき
            if ($request['image']['name']) {
                try {
                    $goodluck['image_name'] = $imageUploader->fileUpload($request['image'], SAVE_IMG_PATH, IMG_SIZE_MAX);
                    // ファイル更新の場合は古いファイルは削除
                    if (isset($request['file_before'])) {
                        // ファイル名が同じ場合は削除を実行しない
                        if ($request['file_before'] != $goodluck['image_name']) {
                            $delResult = $imageUploader->fileDelete($request['file_before'], SAVE_IMG_PATH);
                            if ($delResult['error']) {
                                $this->log("ファイル更新時に下記ファイルが削除できませんでした。", LOG_DEBUG);
                                $this->log($request['file_before'], LOG_DEBUG);
                            }
                        }
                    }
                } catch (RuntimeException $e) {
                    // アップロード失敗の時、既登録ファイルがある場合はそれを保持
                    if (isset($request['file_before'])) {
                        $goodluck['image_name'] = $request['file_before'];
                    }
                    $this->Flash->error(__('ファイルのアップロードができませんでした.'));
                    $this->Flash->error(__($e->getMessage()));
                }
            } else {
                // ファイルは入力されていないけど登録されているファイルがあるとき
                if (isset($request['file_before'])) {
                    $goodluck['image_name'] = $request['file_before'];
                }
            }
        }

        return $goodluck;
    }

}
