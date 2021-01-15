<?php

include_once('Controller/Controller.php');

class Model
{
    public function getLogin()
    {
        if (isset($_REQUEST['username'])) {
            $user = $_REQUEST['username'];
            
            require('connect.inc.php');
            $query = "SELECT `empname` FROM frs_Employee WHERE (`shopid` = 2) and (`empnin` = '$user')";
            $result = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($result)) {
                $name = $row['empname'];
                echo "<html>Hello, <b>$name!</b></html>";
            }
            
            if (mysqli_num_rows($result) != 0) {
                return 'TRUE';
            } else if (mysqli_num_rows($result) == 0) {
                echo "<html><b>Log-in failed. Please retry.</b></br></br></html>";
                return 'FALSE';
            }
        }
    }

    public function getSalesFigures()
    {
        require('connect.inc.php');
        $query = "SELECT SUM(amount) FROM frs_Payment WHERE DATE(paydatetime) = DATE(NOW())";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        return $row['SUM(amount)'];
    }
    
    public function getEmpNIN()
    {
        require('connect.inc.php');
        $query = "SELECT empnin FROM frs_Employee WHERE shopid = 2";
        $result = mysqli_query($con, $query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = "<option value=\"empNIN:\">".$row['empnin']."</option>";
        }
        return join("", $results);
    }

    public function getLoanCust()
    {
        require('connect.inc.php');
        $query = "SELECT custid FROM frs_Register WHERE shopid = 2";
        $result = mysqli_query($con, $query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = "<option value=\"loanCustID:\">".$row['custid']."</option>";
        }
        return join("", $results);
    }
    
    public function getLoanDVD()
    {
        require('connect.inc.php');
        $query = "SELECT dvdid FROM frs_DVD WHERE shopid = 2";
        $result = mysqli_query($con, $query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = "<option value=\"loanDVDID:\">".$row['dvdid']."</option>";
        }
        return join("", $results);
    }
    
    public function getLoanPT()
    {
        require('connect.inc.php');
        $query = "SELECT ptdescription FROM frs_PaymentType";
        $result = mysqli_query($con, $query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = "<option value=\"loanPT:\">".$row['ptdescription']."</option>";
        }
        return join("", $results);
    }
    
    public function getMaxPID()
    {
        require('connect.inc.php');
        $query = "SELECT MAX(payid) FROM frs_Payment";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        return $row['MAX(payid)'];
    }
    
    public function loanQueries()
    {
        require('connect.inc.php');
        $payid = $this->getMaxPID() + 1;
        $empid = $_POST['EmpNIN'];
        $custid = $_POST['LoanCust'];
        $dvdid = $_POST['LoanDVD'];
        $filmid = $dvdid - 200;
        
        $ptid;
        if ($_POST['LoanPT'] == "Cash") {
            $ptid = 1;
        } else if ($_POST['LoanPT'] == "Cheque") {
            $ptid = 2;
        } else if ($_POST['LoanPT'] == "Debit Card") {
            $ptid = 3;
        } else if ($_POST['LoanPT'] == "Credit Card") {
            $ptid = 4;
        }
        
        $Date = (new \DateTime())->format('Y-m-d');
        
        $paymQuery = "INSERT INTO `frs_Payment`(`payid`, `amount`, `paydatetime`, `empnin`, `custid`, `pstatusid`, `ptid`) VALUES ('$payid', '3.99', $Date, '$empid','$custid', '1','$ptid')";
        // echo $paymQuery;
        
        $rentQuery = "INSERT INTO `frs_FilmRental`(`dvdid`, `filmid`, `shopid`, `retdatetime`, `duedate`, `overduecharge`, `empnin`, `custid`, `rentalrate`, `payid`, `rstatusid`) VALUES ('$dvdid', '$filmid', '2', 'currentdate()', 'currentdate(), '0.00', '$empid', '$custid', '3.99', '$payid', '1')";
        // echo $rentQuery;
        
        mysqli_query($con, $paymQuery);
        mysqli_query($con, $rentQuery);
    }
    
    public function msgboxLoan()
    {
        echo '<script language="javascript">';
        echo 'alert("Loan successful.")';
        echo '</script>';
    }
    
    public function getReturnCust()
    {
        require('connect.inc.php');
        $query = "SELECT custid FROM frs_FilmRental WHERE shopid = 2 AND rstatusid != 2";
        $result = mysqli_query($con, $query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = "<option value=\"returnCustID:\">".$row['custid']."</option>";
        }
        return join("", $results);
    }
    
    public function getReturnDVD()
    {
        require('connect.inc.php');
        $query = "SELECT dvdid FROM frs_FilmRental WHERE shopid = 2 AND rstatusid != 2";
        $result = mysqli_query($con, $query);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = "<option value=\"returnDVDID:\">".$row['dvdid']."</option>";
        }
        return join("", $results);
    }
    
    public function returnQueries()
    {
        require('connect.inc.php');
        $custid = $_POST['ReturnCust'];
        $dvdid = $_POST['ReturnDVD'];
        
        require ('connect.inc.php');
        $updateQuery = "UPDATE `frs_FilmRental` SET `retdatetime` = CURRENT_TIMESTAMP, `rstatusid` = 2 WHERE `frs_FilmRental`.`custid` = '$custid' AND `frs_FilmRental`.`dvdid` = '$dvdid'";
        
        mysqli_query($con, $updateQuery);
    }
    
    public function msgboxReturn()
    {
        echo '<script language="javascript">';
        echo 'alert("Return successful.")';
        echo '</script>';
    }
}
?>