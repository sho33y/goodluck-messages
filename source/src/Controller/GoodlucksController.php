<?php
namespace App\Controller;

use App\Controller\AppController;

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
            $goodluck = $this->Goodlucks->patchEntity($goodluck, $this->request->getData());
            if ($this->Goodlucks->save($goodluck)) {
                $this->Flash->success(__('登録しました。'));

                return $this->redirect(['action' => 'form']);
            }
            $this->Flash->error(__('登録できませんでした。お手数ですがもう一度お試しください。'));
        }
        $this->set(compact('goodluck'));
        $this->set('_serialize', ['goodluck']);
    }

}
