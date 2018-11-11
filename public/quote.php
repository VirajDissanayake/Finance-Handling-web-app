<?php
    require("../includes/config.php");
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $stock = lookup($_POST["symbol"]);
        if($stock == false)
        {
            apologize("Invalid stock symbol!");
        }
        render("quote_price.php", ["stock" => $stock]);
    }
    else
    {
        render("quote_form.php", ["title" => "Quote"]);
    }
?>