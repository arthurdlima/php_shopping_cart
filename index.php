<?php
    //start session to store product ids
    session_start();

    require_once('./php/database.php');
    require_once('./php/component.php');
    // create instance of database class
    $database = new CreateDb("u600020894_productdb", "products","localhost","u600020894_manager",'b$X&A9q>');

    if(isset($_POST['add'])){
        //print_r($_POST['product_id']);
        if(isset($_SESSION['cart'])){
            //return the value in the "product_id" column in the _SESSION['cart'] position
            $item_array_id = array_column($_SESSION['cart'],"product_id");
            //if product is already in the session variable
            if (in_array($_POST['product_id'],$item_array_id)) {
                echo "<script>alert('Produto já está no carrinho!')</script>";
                echo "<script>window.location = 'index.php'</script>";
            } else {
                //if product is not in the session var, add

                //get the num of items in the session var
                $count = count($_SESSION['cart']);
                //create cart item with the current prod id
                $item_array = array(
                    'product_id' => $_POST['product_id']
                );
                //add to session variable in the count position
                $_SESSION['cart'][$count] = $item_array;
            }

        } else {
            $item_array = array(
                'product_id' => $_POST['product_id']
            );
            //create new session variable
            $_SESSION['cart'][0] = $item_array;
        }
    }

 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
        <title>Shopping Cart</title>
        <!-- Font Awesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php require_once("php/header.php")?>

        <div class="container">
            <div class="row text-center py-5">
                <?php
                    //component("Produto 1",599,"./upload/product1.png");

                    $result = $database->getData();

                    while ($row = mysqli_fetch_assoc($result)){
                        component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                    }
                 ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    </body>

</html>
