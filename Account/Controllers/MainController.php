<?php

namespace Account\Controllers;

use Account\Services\Pagination;
use Account\View\View;
use Account\Account;

class MainController
{
    /** @var View */
    private $view;
    public function __construct()
    {
        $this->view = new View('Account/templates');
    }

    /**
     * @return void
     */

    public function main()
    {
        $total = Account::count();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10; //колличество записей на странице
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $accounts = Account::findAll($start, $perpage); 
        $this->view->renderHtml('main.php', ['accounts' => $accounts, 'pagination' => $pagination] );
    }
}