<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Acts Controller
 *
 * @property \App\Model\Table\ActsTable $Acts
 */
class ActsController extends AppController
{
    /**
     * Config value, like strings and model names.
     * Filled in initialize();
     * @var array
     */
    public $config = [
        'strings' => [],
        'models' => [],
    ];

    /**
     * Options used in queries for cards (add content)
     * @var array
     */
    public $findCardOptions = [
        'Posts' => [
            'fields' => ['id', 'title', 'excerpt', 'sfw', 'publication_date', 'modified', 'license_id'],
            'conditions' => [
                'status' => 1,
            ],
            'contain' => ['Licenses' => ['fields' => ['id', 'name', 'icon']]],
        ],
        'Projects' => [
            'fields' => ['id', 'name', 'sfw', 'created', 'modified', 'short_description', 'license_id'],
            'conditions' => [
                'status' => 1,
            ],
            'contain' => ['Licenses' => ['fields' => ['id', 'name', 'icon']]],
        ],
        'Files' => [
            'fields' => ['id', 'name', 'sfw', 'filename', 'description', 'created', 'modified', 'license_id', 'mime'],
            'conditions' => [
                'status' => 1,
            ],
            'contain' => ['Licenses' => ['fields' => ['id', 'name', 'icon']]],
        ]
    ];

    /**
     * List of option used in queries for tiles (update/delete content)
     * @var array
     */
    public $findTileOptions = [
        'Posts' => [
            'fields' => ['id', 'title', 'modified'],
            'conditions' => [
                'status' => 1,
            ],
        ],
        'Projects' => [
            'fields' => ['id', 'title' => 'name', 'modified'],
            'conditions' => [
                'status' => 1,
            ],
        ],
        'Files' => [
            'fields' => ['id', 'title' => 'name', 'modified'],
            'conditions' => [
                'status' => 1,
            ],
        ]
    ];

    /**
     * Loads additionnal models and create the configuration array
     * 
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        // Create config strings
        $this->config = [
            'strings' => [
                'edit' => __d('acts', 'has been updated'),
                'delete' => __d('acts', 'has been removed'),
            ],
            'models' => [
                'Files' => __d('files', 'File'),
                'Posts' => __d('posts', 'Article'),
                'Projects' => __d('projects', 'Project'),
            ]
        ];

        // Load models
        foreach ($this->config['models'] as $model => $item) {
            $this->$model = TableRegistry::get($model);
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $conditions = null;
        if (!$this->request->session()->read('see_nsfw')) {
            $conditions['sfw'] = false;
        }

        // Get the list of items
        $this->paginate = [
            'contain' => ['Users'],
            'fields' => ['id', 'type', 'fkid', 'model', 'Users.id', 'Users.username'],
            'limit' => 30,
            'order' => [
                'id' => 'desc'
            ]
        ];
        $acts = $this->paginate($this->Acts);

        // SFW state
//        $sfw = false;
//        if (!$this->request->session()->read('see_nsfw')) {
//            $sfw = true;
//        }
        // Get items content
        $itemsContent = [];
        foreach ($this->paginate() as $item) {
            if ($item['type'] === 'add') {
                // Get full content for new items
                $options = $this->findCardOptions[$item['model']];
            } else {
                // Get partial content for update/delete
                $options = $this->findTileOptions[$item['model']];
            }
            // Additionnal conditions
            $options['conditions'][$item['model'] . '.id'] = $item['fkid'];
            //Sfw option:
//            if($sfw){
//                $options['conditions']['sfw']=true;
//            }
            $itemsContent[$item['id']] = $this->$item['model']->find('all', $options)->first();
        }

        // Pass variables to view
        $this->set('acts', $acts);
        $this->set('items', $itemsContent);
        $this->set('config', $this->config);
        $this->set('_serialize', ['acts']);
    }
}
