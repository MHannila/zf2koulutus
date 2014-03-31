<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Doctrine\ORM\EntityManager;

class BaseController extends AbstractActionController {
    /**
	 * @var EntityManager
	 */
	protected $entityManager;

	/**
	 * Sets the EntityManager
	 * @param EntityManager $em
	 * @access protected
	 * @return PostController
	 */
	protected function setEntityManager(EntityManager $em) {
		$this->entityManager = $em;
		return $this;
	}

	/**
	 * Returns the EntityManager
	 * Fetches the EntityManager from ServiceLocator if it has not been initiated
	 * and then returns it
	 * @access protected
	 * @return EntityManager
	 */
	protected function getEntityManager() {
		if (null === $this->entityManager) {
			$this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
			return $this->entityManager;
		}
	}
}
