<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VueCrudData Model
 *
 * @method \App\Model\Entity\VueCrudData get($primaryKey, $options = [])
 * @method \App\Model\Entity\VueCrudData newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VueCrudData[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VueCrudData|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VueCrudData saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VueCrudData patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VueCrudData[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VueCrudData findOrCreate($search, callable $callback = null, $options = [])
 */
class VueCrudDataTable extends Table
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

        $this->setTable('vue_crud_data');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        
        // --------------------------------
        //  タイムスタンプのカラム名変更
        // --------------------------------
        
        // CakePHP標準はcreated/modified
        // $this->addBehavior('Timestamp');
        
        // 以下にするとRails/Laravelと同じ
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always'
                ]
            ]
        ]);        
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('comment')
            ->maxLength('name', 1000)
            ->requirePresence('comment', 'create')
            ->notEmptyString('comment');

        return $validator;
    }
}
