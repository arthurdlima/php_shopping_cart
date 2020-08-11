<?php
    function component($productName,$productPrice,$productImg,$productId){
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
                                Texto exemplo para o produto $productId.
                            </p>
                            <h5>
                                <small><s class='text-secondary'>R$900</s></small>
                                <span class='price'>R$$productPrice</span>
                            </h5>
                            <button class='btn btn-warning my-3' type='submit' name='add'>Adicionar ao Carrinho<i class='fas fa-shopping-cart'></i></button>
                            <input type='hidden' name='product_id' value='$productId'>
                        </div>
                    </div>
                </form>
            </div>
        ";
        echo $element;
    }

    function cartElement($productImg, $productName, $productPrice, $productId, $item_quantity) {
        $element = "
            <form class='cart-items' action='cart.php?action=remove&id=$productId' method='post'>
                <div class='border rounded'>
                    <div class='row bg-white d-flex align-items-center'>
                        <div class='col-md-3'>
                            <img src=$productImg alt='image1' class='img-fluid'>
                        </div>
                        <div class='col-md-6 d-flex justify-content-center'>
                            <div>
                                <h5 class='pt-2'>$productName</h5>
                                <small class='text-secondary'>vendedor: Amazon</small>
                                <h5 class='pt-2'>R$$productPrice</h5>
                                <!--<button type='submit' class='btn btn-warning'>Salvar para depois</button>-->
                                <button type='submit' class='btn btn-danger mx-2' name='remove'>remover</button>
                            </div>
                        </div>
                        <div class='col-md-3 py-2 d-flex align-items-center justify-content-center'>
                            <div>
                                <button type='submit' class='btn bg-light border rounded-circle' name='minus'>
                                    <i class='fas fa-minus'></i>
                                </button>
                                <input type='text' class='form-control d-inline' name='inputvalue' value='$item_quantity' style='width:3.5rem;'>
                                <input type='hidden' name='itemId' value='$productId'>
                                <button type='submit' class='btn bg-light border rounded-circle' name='plus'>
                                    <i class='fas fa-plus'></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        ";
        echo $element;
    }

 ?>
