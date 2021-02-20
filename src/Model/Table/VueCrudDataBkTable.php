<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VueCrudDataBk Model
 *
 * @method \App\Model\Entity\VueCrudDataBk get($primaryKey, $options = [])
 * @method \App\Model\Entity\VueCrudDataBk newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\VueCrudDataBk[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VueCrudDataBk|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VueCrudDataBk saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\VueCrudDataBk patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\VueCrudDataBk[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\VueCrudDataBk findOrCreate($search, callable $callback = null, $options = [])
 */
class VueCrudDataBkTable extends Table
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

        $this->setTable('vue_crud_data_bk');
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
