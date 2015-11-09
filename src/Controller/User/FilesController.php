<?php

namespace App\Controller\User;

use App\Controller\AppController;
use Cake\Filesystem\File;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 */
class FilesController extends UserAppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('UpManager');
        $this->loadComponent('SimpleImage');
    }

    /**
     * Index method
     *
     * @return void
     */
    public function manage($nsfw = 'all', $status = 'all')
    {
        $this->paginate = [
            'fields' => ['id', 'name', 'filename', 'sfw', 'created', 'modified', 'status', 'license_id', 'user_id'],
            'contain' => [
                'Licenses' => ['fields' => ['id', 'name']]
            ],
            'conditions' => ['user_id' => $this->Auth->user('id')],
            'order' => ['id' => 'desc'],
            'sorWhiteList' => ['name', 'created', 'modified', 'weight'],
        ];

        if ($nsfw === 'safe') {
            $this->paginate['conditions']['sfw'] = 1;
        } elseif ($nsfw === 'unsafe') {
            $this->paginate['conditions']['sfw'] = 0;
        }
        if ($status === 'locked') {
            $this->paginate['conditions']['status'] = 2;
        }

        $this->set('files', $this->paginate($this->Files));
        $this->set('filterNSFW', $nsfw);
        $this->set('filterStatus', $status);
        $this->set('_serialize', ['files']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $file = $this->Files->newEntity();
        if ($this->request->is('post')) {
            $fileInfos = $this->request->data['file'];
            $pathInfo = pathinfo($fileInfos['name']);
            $finalFileName = $this->UpManager->makeFileName($pathInfo['extension']);

            // Checking file :
            if (!$this->UpManager->checkFileType($pathInfo['extension'])) {
                $this->Flash->error(__d('files', 'This filetype is not allowed.'));
            } elseif (!$this->UpManager->checkFileSize($fileInfos['size'])) {
                $this->Flash->error(__d('files', 'File is too long. Max file size is {0}Kb', $this->UpManager->maxSize / 1024));
            } else {

                if (in_array($pathInfo['extension'], $this->UpManager->accepted['image'])) {
                    $this->UpManager->preparePath('thumb');
                    // Make some thumbs
                    $this->SimpleImage->load($fileInfos['tmp_name']);
                    $this->SimpleImage->resizeToWidth('200');
                    // Save and return errors if any
                    if (!$this->SimpleImage->save(WWW_ROOT . $this->UpManager->baseDir . DS . $this->UpManager->currentThumbPath . DS . $finalFileName)) {
                        $this->Flash->error(__d('files', 'The thumbnail could not be saved in the destination folder. Please, try again.'));
                    }
                }

                //Creates folder and return final file path
                $currentFilePath = $this->UpManager->preparePath('file') . DS . $finalFileName;
                $fileItem = [
                    'name' => $fileInfos['name'],
                    'filename' => $currentFilePath,
                    'weight' => $fileInfos['size'],
                    'mime' => $fileInfos['type'],
                    'description' => $this->request->data['description'],
                    'sfw' => $this->request->data['sfw'],
                    'user_id' => $this->Auth->user('id'),
                    'license_id' => $this->request->data['license_id'],
                    'status' => 1
                ];

                if (!move_uploaded_file($fileInfos['tmp_name'], WWW_ROOT . $this->UpManager->baseDir . $currentFilePath)) {
                    $this->Flash->error(__d('files', 'The file could not be saved in the destination folder. Please, try again.'));
                } else {
                    $file = $this->Files->patchEntity($file, $fileItem);
                    if ($this->Files->save($file)) {
                        $this->Flash->success(__d('files', 'The file has been saved.'));
                        $this->Act->add($file->id, 'add', 'Files');
                        return $this->redirect(['action' => 'manage']);
                    } else {
//                        debug($file->errors());die;
                        $this->Flash->error(__d('elabs', 'The file could not be saved. Please, try again.'));
                    }
                }
            }
        }
        $licenses = $this->Files->Licenses->find('list', ['limit' => 200]);
        $this->set(compact('file', 'licenses'));
        $this->set('_serialize', ['file']);
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $file = $this->Files->get($id, [
            'conditions' => ['user_id' => $this->Auth->user('id')],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->data);
            if ($this->Files->save($file)) {
                $this->Flash->success(__d('file', 'The file has been saved.'));
                $this->Act->add($file->id, 'edit', 'Files');
                return $this->redirect(['action' => 'manage']);
            } else {
                $this->Flash->error(__d('files', 'The file could not be saved. Please, try again.'));
                $errors = $file->errors();
                $errorMessages = [];
                array_walk_recursive($errors, function ($a) use (&$errorMessages) {
                    $errorMessages[] = $a;
                });
                $this->Flash->error(__d('elabs', 'Some errors occured. Please, try again.'), ['params' => ['errors' => $errorMessages]]);
            }
        }
        $licenses = $this->Files->Licenses->find('list', ['limit' => 200]);
        $this->set(compact('file', 'licenses'));
        $this->set('_serialize', ['file']);
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id, [
            'conditions' => [
                'user_id' => $this->Auth->user('id')
            ]
        ]);
        if ($this->Files->delete($file)) {
            //@todo Insert some logic to delete the files phisically too
            $this->Flash->success(__d('files', 'The file has been deleted.'));
            $this->Act->remove($id);
        } else {
            $this->Flash->error(__d('files', 'The file could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
