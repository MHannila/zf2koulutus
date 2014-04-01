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
            $childView->setAttributes(array(
                'book' => $book,
            ));
            $childView->setTemplate('library/book/list-row');
            $view->addChild($childView, 'books', true);
        }
        $view->setTemplate('library/book/list');

        return $view;
    }

    
}