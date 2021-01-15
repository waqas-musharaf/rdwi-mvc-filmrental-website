<form id='sales' action='' method='post' accept-charset='UTF-8'>
    <title>Bob's Films Sales Figures</title>
    <fieldset>
        <legend><b>View Daily Sales Figures</b></legend>
        
        Here Are Today's Sales Figures:</br></br>

        <?php
            echo "Date: ", date("Y-m-d"), "<br>";
            if ($_GLOBALS['Sales'] == NULL) {
                $_GLOBALS['Sales'] = '0.00';
            }
            echo "Today's Sales: £".$_GLOBALS['Sales'];
        ?>
        </br></br>

        <button type="submit" class="green big" name="btnBack">
            <span>Back to Menu</span>
        </button>
    </fieldset>
</form>