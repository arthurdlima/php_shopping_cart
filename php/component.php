<?php
    function component($productName,$productPrice,$productImg){
        $element = "
            <div class='col-sm-6 col-md-3 my-3 my-md-0'>
                <form action='index.php' method='post'>
                    <div class='card shadow'>
                        <div>
                            <img src=$productImg alt='Image1' class='img-fluid card-img-top'>
                        </div>
                        <div class='card-body'>
                            <h5 class='card-title'>$productName</h5>
                            <h6>
                                <i class='fas fa-star'></i>
                                <i class='fas fa-star'></i>
                                <i class='fas fa-star'></i>
                                <i class='fas fa-star'></i>
                                <i class='far fa-star'></i>
                            </h6>
                            <p class='card-text'>
                                Texto exemplo para o produto 1
                            </p>
                            <h5>
                                <small><s class='text-secondary'>R$900</s></small>
                                <span class='price'>R$$productPrice</span>
                                <button class='btn btn-warning my-3' type='submit' name='add'>Adicionar ao Carrinho<i class='fas fa-shopping-cart'></i></button>
                            </h5>
                        </div>
                    </div>
                </form>
            </div>
        ";
        echo $element;
    }

 ?>
