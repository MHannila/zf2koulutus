<?php

namespace Library\Form;

use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\InputFilter\InputFilter;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use Library\Form\Fieldset\BookFieldset;

class EditBookForm extends Form {
	public function __construct(ObjectManager $objectManager) {
		parent::__construct('edit-book');

		$this->setAttribute('method', 'post')
             ->setHydrator(new DoctrineHydrator($objectManager, 'Library\Entity\Book'))
             ->setInputFilter(new InputFilter());

        $subdomainFieldset = new BookFieldset($objectManager);
        $subdomainFieldset->setUseAsBaseFieldset(true);
        $this->add($subdomainFieldset);

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => _('Save edit')
            )
        ));

        $this->setValidationGroup(array(
        	'book' => array(
                'title',
                'author'
        	)
        ));
	}
}