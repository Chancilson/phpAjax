<?php
    //index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Ajax Shopping Cart by using Bootstrap Popover</title>
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style>
        .popover{
            width: 100%;
            max-width: 800px;
        }
    </style>
    </head>
    <body>
        <div class="container">
            <br/>
            <h3 align="center">PHP Ajax Shopping Card by using Bootstrap Popover</h3>
            <br/>
            <nav class="navbar navbar-default" role="navifation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Menu</span>
                            <span class="glyphicon glyphicon-menu-humburguer"></span>
                        </button>
                        <a href="" class="nava-brand">Weblesson</a>
                    </div>
                    
                    <div id="navbar-cart" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="#" id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart">
                                    <span class="glyphicon glyphicon-shopping-cart">
                                    </span>
                                    <span class="badge"></span>
                                    <span class="total_price">$0.00</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>
            <div id="popover_content_wrapper" style="display:none">
                <span id="cart_details"></span>
                <div align="right">
                    <a href="#" id="check_out_cart" class="btn btn-primary">
                        <span class="glyphicon glyphicon-shopping-cart"></span>Check out
                    </a>
                    <a href="#" id="clear_cart" class="btn btn-default">
                        <span class="glyphicon glyphicon-trash"></span>Clear
                    </a>
                </div>
            </div>

            <div id="display_item" class="row">

            </div>

        </div>
    </body>
</html>
<script>
    $(document).ready(function(){

        load_product();

        //When the page will be loaded, this function will be called and it'll display cart details on web page.
        load_card_data();

        function load_product()
        {
            $.ajax({
                url: "fetch_item.php",
                method: "POST",
                success:function(data)
                {
                    $('#display_item').html(data);
                }
            });
        }

        //this method will return shopping cart details on web page
        function load_card_data()
        {
            //ajax request
            $.ajax({
                //we will send request on this URL
                url: "fetch_cart.php",
                //we'll use POST method for send datas to server
                method: "POST",
                //we will receive datas in JSON format
                dataType: "json",
                //This function will be called if request is completed successfully and it will receive datas from server
                success: function(data)
                {
                    //This line wil display shopping cart details under this tag
                    $('#cart_details').html(data.cart_details);
                    //This line will display total of all cards under this tag
                    $('.total_price').text(data.total_price);
                    //This code will display total number of items witch  we've added into car
                    $('.badge').text(data.total_item);
                }
            });
        }

        //By using this method we can initialize bootstrap popover
        $('#cart-popover').popover({
            //This line alows to fill popover body by HTML code
            html: true,
            //This line alows to set container option to body
            container: 'body',
            content: function(){
                return $('#popover_content_wrapper').html();
            }
        });

    });
</script>