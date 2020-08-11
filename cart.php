<?php
    session_start();
    //$_SESSION = array();
    require_once('./php/database.php');
    require_once('./php/component.php');

    // create instance of database class
    $db = new CreateDb("u600020894_productdb", "products","localhost","u600020894_manager",'b$X&A9q>');

    if(isset($_POST['remove'])){
        if($_GET['action'] == 'remove'){
            foreach($_SESSION['cart'] as $key => $value) {
                if ($value['product_id'] == $_GET['id']) {
                    unset($_SESSION['cart'][$key]);
                    //rebase session variable keys
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    echo "<script>alert('Produto removido!')</script>";
                    //to refresh the page
                    echo "<script>window.location='cart.php'</script>";
                }
            }
        }
    }

 ?>

<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
        <title>Carrinho</title>
        <!-- Font Awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <!-- JQuery for Bootstrap (moved to top for code) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="bg-light">
        <?php require_once('php/header.php') ?>

        <div class="container-fluid">

            <div class="row px-4 mb-5">
                <div class="col-md-9">
                    <div class="shopping-cart">
                        <h6>Meu Carrinho</h6>
                        <hr>
                        <?php
                            // total price in cart
                            $total = 0;

                            // update cart value (+)

                            if(isset($_POST['minus'])){
                                //id of item that will be incremented
                                $decItemId = $_POST['itemId'];

                                foreach($_SESSION['cart'] as $key => $cartItem) {

                                    if($cartItem['product_id'] == $decItemId){

                                        //getting current item count value from position and + 1
                                        $currentItemCount = (int)$cartItem['item_count'];

                                        // if item count is 1, then remove the item from the cart
                                        if($currentItemCount === 1){
                                            unset($_SESSION['cart'][$key]);
                                            //rebase session variable keys
                                            $_SESSION['cart'] = array_values($_SESSION['cart']);

                                            echo "<script>alert('Produto removido!')</script>";
                                            //refresh the page
                                            echo "<script>window.location='cart.php'</script>";
                                        } else {
                                            $currentItemCount = $currentItemCount - 1;
                                            //updating current item array
                                            $item_array = array(
                                                'product_id' => $_POST['itemId'],
                                                'item_count' => $currentItemCount
                                            );

                                            //add to session variable in the key position
                                            $_SESSION['cart'][$key] = $item_array;

                                        }
                                    }
                                }

                            }

                            // update cart value (+)

                            if(isset($_POST['plus'])){

                                //id of item that will be incremented
                                $incItemId = $_POST['itemId'];

                                foreach($_SESSION['cart'] as $key => $cartItem) {

                                    if($cartItem['product_id'] == $incItemId){

                                        //getting current item count value from position and + 1
                                        $currentItemCount = (int)$cartItem['item_count'] + 1;

                                        //updating current item array
                                        $item_array = array(
                                            'product_id' => $_POST['itemId'],
                                            'item_count' => $currentItemCount
                                        );

                                        //add to session variable in the key position
                                        $_SESSION['cart'][$key] = $item_array;

                                    }
                                }

                            }


                            if(isset($_SESSION['cart'])){
                                //array of product ids
                                $product_id = array_column($_SESSION['cart'],'product_id');
                                //array of item quantity
                                $item_quantity = array_column($_SESSION['cart'],'item_count');
                                //print_r($item_quantity);

                                $result = $db->getData();
                                while($row=mysqli_fetch_assoc($result)){

                                    foreach($product_id as $key => $id) {
                                        if($row['id'] == $id){
                                            cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id'], $item_quantity[$key]);

                                            $itemTotal = $item_quantity[$key] * (int)$row['product_price'];
                                            $total = $total + $itemTotal;
                                        }
                                    }
                                }

                            } else {
                                echo "<h5>Carrinho está vazio</h5>";
                            }
                         ?>
                    </div>
                </div>
                <div class="col-md-2 offset-md-1 border rounded mt-5 bg-white h-25">
                    <div class="pt-4">
                        <h6>Detalhes</h6>
                        <hr>
                        <div class="row price-details">
                            <div class="col-xl-6">
                                <?php
                                    if(isset($_SESSION['cart'])){
                                        $count = count($_SESSION['cart']);
                                        echo "<h6>Preço</h6>";
                                        echo "<h6>quant.($count)</h6>";
                                    } else {
                                        echo "<h6>Preço(0 itens)</h6>";
                                    }
                                 ?>
                                 <h6>Frete</h6>
                                 <hr>
                                 <h6>total</h6>
                            </div>
                            <div class="col-xl-6">
                                <h6><?php echo 'R$'.$total; ?></h6>
                                <h6></br></h6>
                                <h6 class="text-success">GRÁTIS</h6>
                                <hr>
                                <h6> <?php echo 'R$'.$total; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    </body>
</html>
