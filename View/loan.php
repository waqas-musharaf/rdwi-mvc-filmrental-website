<form id='loan' action='' method='post' accept-charset='UTF-8'>
    <title>Bob's Films DVD Loans</title>
    <fieldset>
        <legend><b>Loan a Film</b></legend>
        
        Reselect your Employee NIN:
            <select name="empNIN">
            <?php
            echo $_GLOBALS['EmpNIN'];
            ?>
            </select>
            </br></br>
        
        Select the Customer ID to loan a DVD to:
            <select name="loanCust">     
            <?php
            echo $_GLOBALS['LoanCust'];
            ?>
            </select>
            </br>

        Select the DVD ID of the film to loan:    
            <select name="loanDVD">     
            <?php
            echo $_GLOBALS['LoanDVD'];
            ?>
            </select>
            </br></br>

        Select the Payment Type used:
            <select name="loanPT">
            <?php
            echo $_GLOBALS['LoanPT'];
            ?>
            </select>
            </br></br>

        <button type="submit" class="green big" name="btnLoanDVD">
            <span>Confirm Loan</span>
        </button>
        <?php
            if (isset($_POST['btnLoanDVD'])) {
                $_GLOBALS['loanQueries'];
            }
        ?>

        <button type="submit" class="green big" name="btnBack">
            <span>Back to Menu</span>
        </button>
    </fieldset>
</form>