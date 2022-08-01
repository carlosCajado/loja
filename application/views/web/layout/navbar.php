
<header>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Header Bottom Menu Area -->
                    <div class="hb-menu">
                        <nav>  
                            <ul>
                                <?php 
                                    $Attribute = array(
                                        'id'=> 'search-form',
                                    );
                                ?>                   
                                <div class="search-error" style="padding-left: 50px">
                                    <?php echo form_open('busca', $Attribute);?>
                                        <input type="text" name="busca" placeholder="O que você procura?">
                                        <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                    <?php echo form_close();?>
                                </div> 
                                <li style="padding-right: 10px;">
                                    <div class="dropdown-holder">
                                        <div class="logo pb-sm-30 pb-xs-30">
                                            <a href="<?php echo base_url('/'); ?>">
                                                <img src="<?php echo base_url('public/web/images/menu/logo/logo.png'); ?>" width="50px" alt="" style="padding-bottom: 5px;>
                                            </a>
                                        </div>
                                    </div>
                                    <li class="dropdown-holder">
                                        <?php $categorias_pai = categorias_pai_navbar();?>
                                                <?php  foreach($categorias_pai as $cat_pai):?>
                                                    <?php $categorias_filhas = categorias_filhas_navbar($cat_pai->categoria_pai_id);
                                                    // print_r($cat_pai->categoria_pai_id);
                                                    // die();?>
                                        <li class="dropdown-holder"><a href="<?php echo base_url('master/'.$cat_pai->categoria_pai_meta_link)?>"><?php echo $cat_pai->categoria_pai_nome;?></a>
                                            <ul class="hb-dropdown">
                                            <?php foreach($categorias_filhas as $cat_filha):?>
                                                    <li class="active"><a href="<?php echo base_url('categoria/'.$cat_filha->categoria_meta_link)?>"> <?php  echo $cat_filha->categoria_nome;?></a></li>
                                                <?php  endforeach;?>
                                            </ul>
                                        </li>
                                        <?php  endforeach;?>
                                    </li>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Header Bottom Menu Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="container"> 
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
</header>
<!-- Header Area End Here -->