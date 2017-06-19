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
        $goodlucks = $this->paginate($this->Goodlucks);

        $this->set(compact('goodlucks'));
        $this->set('_serialize', ['goodlucks']);
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
            if ($this->Goodlucks->save($goodluck)) {
                $this->Flash->success(__('The goodluck has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The goodluck could not be saved. Please, try again.'));
        }
        $this->set(compact('goodluck'));
        $this->set('_serialize', ['goodluck']);
    }

}
