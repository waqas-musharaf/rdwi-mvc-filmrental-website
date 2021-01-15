<form id='return' action='' method='post' accept-charset='UTF-8'>
    <title>Bob's Films DVD Returns</title>
    <fieldset>
        <legend><b>Return a Film</b></legend>
        
        Select the Customer ID to accept the return from:
            <select name="returnCust">     
            <?php
            echo $_GLOBALS['ReturnCust'];
            ?>
            </select>
            </br>
    
        Select the DVD ID of the film to return:
            <select name="returnDVD">     
            <?php
            echo $_GLOBALS['ReturnDVD'];
            ?>
            </select>
            </br></br>
        
        <button type="submit" class="green big" name="btnReturnDVD">
            <span>Confirm Return</span>
        </button>
        <?php
            if (isset($_POST['btnReturnDVD'])) {
                $_GLOBALS['returnQueries'];
            }
        ?>
        
        <button type="submit" class="green big" name="btnBack">
            <span>Back to Menu</span>
        </button>
    </fieldset>
</form>