<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $helpers = [
			'Tanuck/Markdown.Markdown' => ['parser' => 'GithubMarkdown'],
			'Gravatar.Gravatar'
	];

	/**
	 * Initialization hook method.
	 *
	 * Use this method to add common initialization code like loading components.
	 *
	 * e.g. `$this->loadComponent('Security');`
	 *
	 * @return void
	 */
	public function initialize() {
		parent::initialize();

		$this->loadComponent('RequestHandler');
		$this->loadComponent('Act');
		$this->loadComponent('Flash');
		$this->loadComponent('Auth', [
				'authenticate' => [
						'Form' => [
								'fields' => ['username' => 'email'],
								'scope' => ['enabled' => 1, 'locked' => 0, 'deleted'=>0],
						],
				],
				'loginAction' => ['prefix' => false, 'controller' => 'Users', 'action' => 'login'],
				'authError' => 'You are not allowed to view this page.',
				'loginRedirect' => ['prefix' => false, 'controller' => 'pages', 'action' => 'display', 'home'],
				'logoutRedirect' => ['prefix' => false, 'controller' => 'pages', 'action' => 'display', 'home']
		]);
	}

	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['index', 'view']);
	}

	/**
	 * Before render callback.
	 *
	 * @param \Cake\Event\Event $event The beforeRender event.
	 * @return void
	 */
	public function beforeRender(Event $event) {
		if (!array_key_exists('_serialize', $this->viewVars) &&
						in_array($this->response->type(), ['application/json', 'application/xml'])
		) {
			$this->set('_serialize', true);
		}

		// Pass some data to the view
		$authUser = null;
		if (!is_null($this->Auth->user('id'))) {
			$authUser = $this->Auth->user();
		}
		$this->set('authUser', $authUser);
	}

}
