<?php
namespace Library\Controller;

use Zend\View\Model\ViewModel;

use Application\Controller\BaseController;
use Library\Entity\Book;
use Library\Form\AddBookForm;
use Library\Form\EditBookForm;

class BookController extends BaseController {
    public function indexAction() {
        return array();
    }

    public function addAction() {
        $em = $this->getEntityManager();

        $form = new AddBookForm($em);
        $book = new Book();
        $form->bind($book);
        

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $em->persist($book);
                $em->flush();
                return $this->redirect()->toRoute('book', array(
                    'action' => 'list',
                ));
            }
        }

        return array(
            'form' => $form,
        );
    }

    public function listAction() {
        $em = $this->getEntityManager();

        $books = $em->getRepository('Library\Entity\Book')->findAll();

        $view = new ViewModel();

        foreach ($books as $book) {
            $childView = new ViewModel();
            $childView->setVariables(array(
                'book' => $book,
            ));
            $childView->setTemplate('library/book/list-row');
            $view->addChild($childView, 'books', true);
        }
        $view->setTemplate('library/book/list');

        return $view;
    }

    public function editAction() {
        $id = $this->params()->fromRoute('id', 0);
        $em = $this->getEntityManager();

        $book = $em->getRepository('Library\Entity\Book')->findOneBy(array('id' => $id));

        if ($book === null) {
            return $this->redirect()->toRoute('book', array(
                'action' => 'list',
            ));
        }

        $form = new EditBookForm($em);
        $form->bind($book);

        if ($this->request->isPost()) {
            $form->setData($this->request->getPost());

            if ($form->isValid()) {
                $em->flush();
                return $this->redirect()->toRoute('book', array(
                    'action' => 'list',
                ));
            }
        }

        return array(
            'form' => $form,
            'book' => $book,
        );
    }    


}