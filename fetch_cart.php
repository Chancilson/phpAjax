<?php
    //fetch_cart.php

    //This line will star session on this page
    session_start();

    //variables
    $total_price = 0;
    $total_item =0;

    $output = '
        <div class="table-responsive" id="order_table">
            <table class="table table-bordered table-striped">
                <tr>
                    <th width="40%">Product Name</th>

                    <th width="10%">Quantity</th>

                    <th width="20%">Price</th>

                    <th width="15%">Total</th>

                    <th width="5%">Action</th>
                </tr>
    ';
    //This condition will check if the $_SESSION["shopping_cart"] variable is not blank then it will execute the bloc of code  otherwise it'll execute else bloc of code
    if (!empty($_SESSION["shopping_cart"]))
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            $output .= '
                <tr>
                    <td>'.$values["product_name"].'</td>

                    <td>'.$values["product_quantity"].'</td>

                    <td align="right">$'.$values["product_price"].'</td>

                    <td align="right">$'.number_format($values["product_quantity"]*$values["product_price"],2).'</td>

                    <td>
                        <button name="delete" class ="btn btn-danger btn-xs detete" id="'.$values["product_id"].'">
                            Remove
                        </button>
                    </td>
                </tr>
            ';
            //This code will calculate total of all shopping carts
            $total_price = $total_price + ($values["product_quantity"]*$values["product_price"]);

            //This code will return number of items added into shopping card
            $total_item = $total_price + 1;

            //This line will display total of all shopping card
            $output .= '
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$'.number_format($total_price,2).'<td>
                </tr>
            ';
        }
    }else
    {
        $output .= '
            <tr>
                <td colspan="5" align="center">
                    Your Cart is Empty!
                </td>
            </tr>
        ';
    }

    $output .= '</table></div>';

    //This line will store datas in $data variable in array format
    $data = array(
        'cart_details'  =>  $output,
        'total_price'   => '$' . number_format($total_price,2),
        'total_item'    => $total_item
    );

    //This line will send these datas to Ajax request
    echo json_encode($data);//This will convert PHP array into JSON and encode it to String

?>