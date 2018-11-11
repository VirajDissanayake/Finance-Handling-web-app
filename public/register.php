<?php
    require("../includes/config.php");
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("register_form.php", ["title" => "Register"]);
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($_POST["username"] == NULL)
        {
            apologize("Please Enter the usename!");
        }
        else if($_POST["password"] == NULL)
        {
            apologize("Please Enter the password!");
        }
        else if($_POST["confirmation"] == NULL)
        {
            apologize("Please confirm your password!");
        }
        else if($_POST["password"] != $_POST["confirmation"])
        {
            apologize("check your password again!");
        }
        if(CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT))== false)
        {
            apologize("This username already exists");
        }
        else
        {
            $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;
            redirect("index.php");
        }
    }
    else
    {
        render("register_form.php", ["title" => "Register"]);
    }
?>