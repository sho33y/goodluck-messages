<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Goodlucks Model
 *
 * @method \App\Model\Entity\Goodluck get($primaryKey, $options = [])
 * @method \App\Model\Entity\Goodluck newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Goodluck[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Goodluck|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Goodluck patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Goodluck[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Goodluck findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GoodlucksTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('goodlucks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->notEmpty('nickname', 'ニックネームを入力してください。');

        $validator
            ->notEmpty('title', 'タイトルを入力してください。');

        $validator
            ->notEmpty('message', 'メッセージを入力してください。');

        $validator
            ->allowEmpty('image_name');

        return $validator;
    }
}
