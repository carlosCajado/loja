
            <!-- Begin Header Area -->
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
                                        <li>
                                                            <div class="dropdown-holder">
                                                <div class="logo pb-sm-30 pb-xs-30">
                                                    <a href="index.html">
                                                        <img src="<?php echo base_url('public/web/images/menu/logo/logo.png'); ?>" width="70px" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            </li>
                                            <li class="dropdown-holder"><a href="<?php echo base_url('/'); ?>">Home</a>
                                            </li>
                                            <?php $categorias_pai = categorias_pai_navbar();?>
                                                    <?php  foreach($categorias_pai as $cat_pai):?>
                                                        <?php $categorias_filhas = categorias_filhas_navbar($cat_pai->categoria_pai_id);
                                                        // print_r($cat_pai->categoria_pai_id);
                                                        // die();?>
                                            <li class="dropdown-holder"><a href="index.html"><?php echo $cat_pai->categoria_pai_nome;?></a>
                                                <ul class="hb-dropdown">
                                                <?php foreach($categorias_filhas as $cat_filha):?>
                                                            <li class="active"><a href="index.html"> <?php  echo $cat_filha->categoria_nome;?></a></li>
                                                        <?php  endforeach;?>
                                                </ul>
                                            </li>
                                            <?php  endforeach;?>
                                            <li>
                                            <a class="ht-setting-trigger"><span>Marcas</span></a>
                                            <div class="setting ht-setting">
                                                <ul class="ht-setting-list">
                                                    <?php $grande_marcas = grandes_marcas_navbar()?>
                                                    <?php  foreach($grande_marcas as $marca):?>
                                                    <li><a href="#"><?php echo $marca->marca_nome;?></a></li>
                                                    <?php  endforeach;?>
                                                </ul>
                                            </div>
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