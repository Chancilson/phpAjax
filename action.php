<?php
    //action.php

    //This function will star session on this page
    session_start();

    //This line of code will verify if action varioble is set.
    if (isset($_POST["action"])) {

        if ($_POST["action"] == "add") {
            
            if (isset($_SESSION["shopping_cart"])) {
                //This variable will increase if we add the sabe product two or more times.
                $is_available = 0;


                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
                    //This condition will value a paricular product id witch we've add into car, is already added into car or not?
                    if ($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"]) {
                        //
                        $is_available++;

                        //This line of code will increase particular product quantity with value $_POST["product_quantity"] variable
                        $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shoppin_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];
                    }
                }

                if ($is_available == 0)
                {
                    $item_array = array(
                        'product_id'    =>  $_POST["product_id"],

                        'product_name'  =>  $_POST["product_name"],

                        'product_price' =>  $_POST["product_price"],

                        'product_quantity'  $_POST["product_quantity"]
                    );
                    $_SESSION["shopping"][] = $item_array;
                }
                
            } else {
                //This array will store product datas
                $item_array = array(
                    'product_id'    =>  $_POST["product_id"],
                    'product_name'  =>  $_POST["product_name"],
                    'product_price' =>  $_POST["product_price"],
                    'product_ quantity' => $_POST["product_quantity"]
                );
                //This line of code will store datas from item_array variable into the SESSION shopping_cart  variable
                $_SESSION["shopping_cart"][] = $item_array;
            }
            
        }
?>