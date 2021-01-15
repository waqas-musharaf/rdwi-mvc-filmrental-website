<?php

include_once('Model/Model.php');

class Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        $_GLOBALS['loanQueries'] = $this->model->loanQueries();
        $_GLOBALS['returnQueries'] = $this->model->returnQueries();
        
        $loginstatus = $this->model->getLogin();
        if ($loginstatus == 'TRUE') {
            include 'View/menu.php';
            
        } else if (isset($_POST['btnLoan'])) {
            $_GLOBALS['EmpNIN'] = $this->model->getEmpNIN();
            $_GLOBALS['LoanCust'] = $this->model->getLoanCust();
            $_GLOBALS['LoanDVD'] = $this->model->getLoanDVD();
            $_GLOBALS['LoanPT'] = $this->model->getLoanPT();
            $_GLOBALS['MaxPID'] = $this->model->getMaxPID();
            include 'View/loan.php';
            
        } else if (isset($_POST['btnLoanDVD'])) {
            $_GLOBALS['msgboxLoan'] = $this->model->msgboxLoan();
            include 'View/menu.php';
            
        } else if (isset($_POST['btnReturn'])){
            $_GLOBALS['ReturnCust'] = $this->model->getReturnCust();
            $_GLOBALS['ReturnDVD'] = $this->model->getReturnDVD();
            include 'View/return.php';
            
        } else if (isset($_POST['btnReturnDVD'])) {
            $_GLOBALS['msgboxReturn'] = $this->model->msgboxReturn();
            include 'View/menu.php';
            
        } else if (isset($_POST['btnSales'])){
            $_GLOBALS['Sales'] = $this->model->getSalesFigures();
            include 'View/sales.php';
            
        } else if (isset($_POST['btnBack'])) {
            include 'View/menu.php';

        } else {
            include 'View/login.php';
        }
    }
}
?>