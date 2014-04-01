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

        $view = new ViewModel(array(
            'books' => $books,
        ));
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


    public function borrowAction() {
        $id = $this->params()->fromRoute('id', 0);
        $em = $this->getEntityManager();

        $book = $em->getRepository('Library\Entity\Book')->findOneBy(array('id' => $id));

        if ($book === null) {
            return $this->redirect()->toRoute('book', array(
                'action' => 'list',
            ));
        }

        $user = $this->zfcUserAuthentication()->getIdentity();
        $book->setBorrower($user);
        $user->addBorrowed($book);

        $em->flush();
        return $this->redirect()->toRoute('book', array(
            'action' => 'borrowed',
        ));
    } 


    public function borrowedAction() {
        $em = $this->getEntityManager();

        $user = $this->zfcUserAuthentication()->getIdentity();
        $books = $em->getRepository('Library\Entity\Book')->findBy(array('borrower' => $user));

        $view = new ViewModel();

        foreach ($books as $book) {
            $childView = new ViewModel();
            $childView->setVariables(array(
                'book' => $book,
            ));
            $childView->setTemplate('library/book/borrowed-list-row');
            $view->addChild($childView, 'books', true);
        }
        $view->setTemplate('library/book/borrowed-list');

        return $view;
    }


    public function returnAction() {
        $id = $this->params()->fromRoute('id', 0);
        $em = $this->getEntityManager();

        $book = $em->getRepository('Library\Entity\Book')->findOneBy(array('id' => $id));

        if ($book === null) {
            return $this->redirect()->toRoute('book', array(
                'action' => 'list',
            ));
        }

        $user = $this->zfcUserAuthentication()->getIdentity();
        $user->removeBorrowed($book);
        $book->setBorrower(null);

        $em->flush();

        return $this->redirect()->toRoute('book', array(
            'action' => 'borrowed',
        ));
    } 


}