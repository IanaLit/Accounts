<?php

namespace Account\Controllers;

use Account\View\View;
use Account\Account;

class AccountController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View('Account/templates');
    }

    /**
     * @param int $accountId
     * @return void
     */

    public function view(int $accountId)
    {
        $account = Account::getById($accountId);
        if ($account === null) 
        {
            $this->view->renderHtml('error404.php', [], 404);
            return;
        }
        $this->view->renderHtml('show_account.php', ['account' => $account]);
    }

    /**
     * @param int $accountId
     * @return void
     */

    public function edit(int $accountId): void
    {
        $account = Account::getById($accountId);
        if ($account === null) 
        {
            throw new NotFoundException();
        }
        if (!empty($_POST)) 
        {
            try 
            {
                $account->updateFromArray($_POST);
            } 
            catch (InvalidArgumentException $e)
            {
                $this->view->renderHtml('edit.php', ['error' => $e->getMessage()]);
                return;
            }
        header('Location: /'); exit();
    }
    $this->view->renderHtml('edit.php', ['account' => $account]);
    }

    /**
     * @return void
     */

    public function add(): void
    {
        $account = new Account();   
        if (!empty($_POST)) 
        {
            try
            {
                $account = Account::createFromArray($_POST);
            } 
            catch (\Account\Exceptions\InvalidArgumentException $e) 
            {
            $this->view->renderHtml('add.php', ['error' => $e->getMessage()]);
            return;
            }
            header('Location: /'); exit();
        }
        $this->view->renderHtml('add.php');
    }

    /**
     * @param int $accountId
     * @return void
     */

     public function delete(int $accountId): void
    {
        $account = Account::getById($accountId);
        if ($account === null) 
        {
            $this->view->renderHtml('error404.php', [], 404);
            return;
        }
        $account->delete();
        header("Location:/");
    }

}