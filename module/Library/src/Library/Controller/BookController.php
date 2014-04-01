<?php
namespace Library\Controller;

use Zend\View\Model\ViewModel;

use Application\Controller\BaseController;
use Library\Entity\Book;
use Library\Form\AddBookForm;

class BookController extends BaseController {

    public function addAction() {
        $em = $this->getEntityManager();

        $form = new AddBookForm($em);
        $book = new Book();
        $form->bind($book);
        

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {

                // $em->persist($book);

                // $em->flush();
                // return $this->redirect()->toRoute('core/user', array(
                //     'action' => 'applications',
                // ));
            }
        }

        return array(
            'form' => $form,
        );
    }

    public function listAction() {
        $em = $this->getEntityManager();

        $books = $em->getRepository('Library\Entity\Book')->findAll();

        return array();
    }

    
}