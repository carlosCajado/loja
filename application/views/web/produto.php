<?php $this->load->view('web/layout/navbar'); ?>

<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="<?php echo base_url('/'); ?>">Início</a></li>
                <li><a href="<?php echo base_url('master/'.$produto->categoria_pai_meta_link); ?>"><?php echo $produto->categoria_pai_nome; ?></a></li>
                <li  class="active"><a href="<?php echo base_url('categoria/'.$produto->categoria_meta_link); ?>"><?php echo $produto->categoria_nome; ?></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- content-wraper start -->
<div class="content-wraper">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">
                        <?php foreach ($fotos_produtos as $foto): ?>
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="<?php echo base_url('uploads/produtos/'.$foto->foto_caminho); ?>" data-gall="myGallery">
                                    <img src="<?php echo base_url('uploads/produtos/'.$foto->foto_caminho); ?>" alt="<?php echo $produto->produto_nome; ?>">
                                </a>
                            </div>
                        <?php endforeach;?>
                    </div>
                    <div class="product-details-thumbs slider-thumbs-1">
                    <?php foreach ($fotos_produtos as $foto): ?>
                            <div class="sm-image">
                                <img src="<?php echo base_url('uploads/produtos/'.$foto->foto_caminho); ?>" alt="<?php echo $produto->produto_nome; ?>">
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content pt-60">
                    <div class="product-info">
                        <h2><?php echo $produto->produto_nome?></h2>
                        <span class="product-details-ref">Código: <?php echo $produto->produto_codigo?></span>
                        <p>
                        <span class="product-details-ref">Estoque: <?php echo ($produto->produto_quantidade_estoque >0 ? '<span class"badge badge-success">' . $produto->produto_quantidade_estoque.'</span>'  : '<span class"badge badge-danger">Indisponivel</span>')?></span>
                        </p>
                        <p>
                        <span class="product-details-ref"><a href="<?php echo base_url('marca/'.$produto->marca_meta_link); ?>"><?php echo $produto->marca_nome?></a></span>
                        </p>    
                        <!-- <div class="rating-box pt-20">
                            <ul class="rating rating-with-review-item">
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                <li class="review-item"><a href="#">Read Review</a></li>
                                <li class="review-item"><a href="#">Write Review</a></li>
                            </ul>
                        </div> -->
                        <div class="price-box pt-20">
                            <span class="new-price new-price-2"><?php echo 'R$&nbsp'.$produto->produto_valor?></span>
                            <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i> favorito</a>
                        </div>
                        <div class="product-desc">
                            <p>
                            </p>
                        </div>
                        <div class="product-variants">
                            <!-- <div class="produt-variants-size">
                                <label>Dimension</label>
                                <select class="nice-select">
                                    <option value="1" title="S" selected="selected"><?php echo $produto->produto_tamanho?></option>
                                    <option value="2" title="M">60x90cm</option>
                                    <option value="3" title="L">80x120cm</option>
                                </select>
                            </div> -->
                        </div>
                        <div class="single-add-to-cart">
                            <form action="#" class="cart-quantity">
                                <div class="quantity">
                                    <label>Calcular Entrega</label>
                                    <div class="" style="min-width:140px; float:left; margin-right: 10px; position:relative; text-align:left; ">
                                        <input  style="background-color:aliceblue" class="cart-plus-minus-box" type="text" placeholder="Informe seu CEP">
                                    </div>
                                </div>
                                <button class="add-to-cart2" type="submit"><img src="<?php echo base_url('public/web/images/entrega.png'); ?>" width="40px" alt=""></button>
                            </form>
                        </div>

                        <div class="single-add-to-cart">
                            <form action="#" class="cart-quantity">
                                <div class="quantity">
                                    <!-- <label>Quantidade</label> -->
                                    <div class="">
                                        <!-- <input class="cart-plus-minus-box" value="1" type="text">
                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div> -->
                                    </div>
                                </div>
                                <button class="add-to-cart" type="submit">Adicionar ao Carrinho</button>
                            </form>
                        </div>
                        <div class="product-additional-info pt-25">
                        <div class="product-desc">
                            <p>
                            </p>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#description"><span>Descrição</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="description" class="tab-pane active show" role="tabpanel">
                <div class="product-description">
                    <span> <?php echo $produto->produto_descricao?></span>
            </div>
        </div>
    </div>
</div>
<!-- Product Area End Here -->