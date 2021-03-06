<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

/**
 * Component to handle simple acts action.
 *
 */
class ActComponent extends Component
{

    /**
     * Configuration array
     *
     * @var array
     */
    public $config = [
        // A list of actions and synonyms
        'actions' => [
            'update' => ['edit', 'update'],
            'add' => ['add', 'create', 'new'],
            'delete' => ['delete'],
        ]
    ];

    /**
     * Additionnal components used
     *
     * @var array
     */
    public $components = ['Auth'];

    /**
     * Constructor, basically loads the Acts Model
     *
     * @param array $config Configuration array
     *
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->Acts = TableRegistry::get('Acts');
        $this->Controller = $this->_registry->getController();
    }

    /**
     * Adds an element to the Acts table
     *
     * @param mixed $foreignKey Target foreign key
     * @param string $type Target action
     * @param string $model Target model
     * @param date $created Creation date
     *
     * @return bool
     */
    public function add($foreignKey, $type = null, $model = null, $created = null)
    {
        // Checking params
        if (is_null($model)) {
            $model = $this->Controller->request->params['controller'];
        }
        if (is_null($type)) {
            $type = $this->Controller->request->params['action'];
        }
//        $uid = $this->Auth->user('id');
        $act = $this->Acts->patchEntity($this->Acts->newEntity(), ['fkid' => $foreignKey, 'model' => $model, 'type' => $type, 'created' => $created]); //, 'user_id' => $uid]);
        if ($this->Acts->save($act)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Removes all acts with the given foreign key
     *
     * @param int $foreignKey Target foreign key
     * @param string $model Model name. If empty, current controller will be used.
     *
     * @return bool
     */
    public function remove($foreignKey, $model = null)//, $self = true)
    {
        // Creating the conditions
        $conditions = [];
        $conditions['fkid'] = $foreignKey;
        $conditions['model'] = (is_null($model)) ? $this->request->params['controller'] : $model;
//        if ($self) {
//            $conditions['user_id'] = $this->Auth->user('id');
//        }
        return $this->Acts->deleteAll($conditions);
    }

    /**
     * Removes all acts for a given user. To be used when user closes his account
     *
     * @param int $uid User ID. If null, currently logged-in user id will be used.
     *
     * @throws NotImplementedException
     *
     * @return void
     */
    public function removeAll($uid = null)
    {
//        if (is_null($uid)) {
//            $uid = $this->Auth->user('id');
//        }
//        return $this->Acts->deleteAll(['user_id' => $uid]);
        throw new \Cake\Network\Exception\NotImplementedException('This is not handled anymore...');
    }
}
