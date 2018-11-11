<?php
    require("../includes/config.php");
    if($_SERVER["REQUEST_METHOD"]=="GET")
    {
        render("buy_form.php", ["title" => "Buy"]);
    }
    else if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $stock = lookup($_POST["symbol"]);
        if($stock==false)
        {
            apologize("invalid stock!");
        }
        $cash= CS50::query("SELECT cash FROM users WHERE id=? ", $_SESSION["id"])[0]["cash"];
        if($cash<$_POST["shares"]*$stock["price"])
        {
            apologize("you don't have enough money to make this purchase");
        }
        CS50::query("UPDATE users SET cash= cash-? WHERE id=?", $_POST["shares"]*$stock["price"], $_SESSION["id"]);
        CS50::query("INSERT INTO portfolio (id, symbol, shares) VALUES(?,?,?) ON DUPLICATE KEY UPDATE shares= shares+ VALUES(shares)", $_SESSION["id"], strtoupper($_POST["symbol"]), $_POST["shares"]);
        CS50::query("INSERT INTO history (id, transaction, timestamp, symbol, shares, price) VALUES(?,?,?,?,?,?)", $_SESSION["id"], "Buy", date('Y-m-d h:i:s'), strtoupper($_POST["symbol"]), $_POST["shares"], $stock["price"]);
        redirect("/");
    }