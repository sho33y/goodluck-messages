<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

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
//        $this->paginate['limit'] = 1;
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
