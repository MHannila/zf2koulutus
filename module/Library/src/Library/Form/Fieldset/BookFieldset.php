<?php

namespace Library\Form\Fieldset;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use Library\Entity\Book;

class BookFieldset extends Fieldset implements InputFilterProviderInterface {
	public function __construct(ObjectManager $objectManager) {
		parent::__construct('book');

		$this->setHydrator(new DoctrineHydrator($objectManager, 'Library\Entity\Book'));
		$this->setObject(new Book());

		$this->setLabel('Book');

		$this->add(array(
			'type' => 'Zend\Form\Element\Text',
		 	'name' => 'title',
		 	'options' => array(
		 		'label' => _('Title'),
		 	),
		 	'attributes' => array(
		 	)
		));

		$this->add(array(
			'type' => 'Zend\Form\Element\Text',
		 	'name' => 'isbn',
		 	'options' => array(
		 		'label' => _('ISBN'),
		 	),
		 	'attributes' => array(
		 	),
		));

		$this->add(array(
			'type' => 'Zend\Form\Element\Text',
		 	'name' => 'author',
		 	'options' => array(
		 		'label' => _('Author'),
		 	),
		 	'attributes' => array(
		 	)
		));

	}

    public function getInputFilterSpecification() {
        return array(
            'title' => array(
                'required' => true,
            ),
            'isbn' => array(
                'required' => false,
                'validators' => array(
	                array(
	                    'name' => 'isbn',
	                ),
	            ),
            ),
            'author' => array(
                'required' => false,
            ),
        );
    }
}