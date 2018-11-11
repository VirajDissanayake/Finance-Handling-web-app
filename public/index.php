<?php

    // configuration
    require("../includes/config.php"); 
    
    $rows = CS50::query("SELECT * FROM portfolio WHERE id = ?", $_SESSION["id"]);
    $positions=[];
    $worth = 0.0;
    foreach($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if($stock !== false)
        {
            $positions[] = [
                "mame" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"]
                ];
        $worth = $worth + $row["shares"] * $stock["price"];
        }
    }
    $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"])[0]["cash"];
    $worth = $worth + $cash;
    render("portfolio.php", ["title" => "portfolio", "positions" => $positions, "cash" => $cash, "worth" => $worth]);
?>
