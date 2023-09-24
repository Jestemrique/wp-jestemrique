<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo( 'name' ); ?></title>
    <?php wp_head() ?>
</head>


<div class="container-fluid shadow  mb-5">




  <div class="row epr-header-bg">
    <div class="col text-center">
    <a  href="<?php echo home_url(); ?>">
       <h1 class="display-2 mt-4"><?php bloginfo( 'name' ); ?></h1>
    </a>
    <?php //bloginfo( 'description' ); ?>
    </div><!-- End col -->
  </div><!-- End row -->



</div> <!-- end container -->

<div class="container">
  <div class="row">


    <div class="col">
      <nav class="navbar fixed-bottom navbar-expand-lg border-top" style="background-color: #ffffff;">
        <div class="container">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> 
            <i class="bi bi-list"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <?php
              // Select our menu
              $menu = my_menu_builder('main-menu');
            
              foreach ($menu as $item) :
                //Set class names if the menu item is active
                //$menu_item_active_class = get_the_ID() == $item['ID'] ? "epr-active " : "nav-link";
                //$sub_menu_item_active_class = get_the_ID() == $item['ID'] ? "epr-active" : "nav-link";
                
                
                // $menu_item_active_class = (get_the_ID() == $item['ID']) || (get_option( 'page_for_posts') == $item['ID']) ? "epr-active " : "nav-link";
                // if ($item['ID'] == get_option( 'page_for_posts')) {
                //   $menu_item_active_class = "epr-active";
                // } 
                
                $menu_item_active_class = "";
                if ( is_home()){
                  if (get_option( 'page_for_posts') == $item['ID']) {
                    $menu_item_active_class = "epr-active";
                  }
                } else {

                  $menu_item_active_class = get_the_ID() == $item['ID'] ? "epr-active " : "nav-link";
                }



                //my_console_log('title -> id: ' . $item['ID']);
                //my_console_log('get_the_ID(): ' .get_the_ID());
                //my_console_log('Es el blog?: ' . is_home());
                //my_console_log('title: '. $item['title']);
                //my_console_log($menu_item_active_class);
                
                //Menu item has children
                if (isset($item['children'])) : ?>
                  <!-- <li class="nav-item dropdown"> -->
                  <li class="nav-item dropup">
                    <a  class="nav-link dropdown-toggle <?php echo ($menu_item_active_class) ?>" href="<?= $item['url'] ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      </i>   <?= $item['title']; ?>
                    </a>
                    <ul class="dropdown-menu">
                      <?php foreach ($item['children'] as $child) : ?>
                        <li><a class="dropdown-item <?php echo ($menu_item_active_class) ?>" href='<?= $child['url'] ?>'><?= $child['title'] ?></a></li>
                      <?php endforeach; ?>
                    </ul>
                  </li>

                <?php else: ?>
                  <li class="nav-item">
                    <!-- <a class="nav-link" href='<?= $item['url'] ?>'><?= $item['title']; ?></a> -->
                    
                    <a class="nav-link <?php echo ($menu_item_active_class) ?>" href='<?= $item['url'] ?>'><?= $item['title']; ?></a>
                </li>
                <?php endif; ?>
              <?php endforeach;?>
            </ul>
          </div>
        </div>
      </nav>
  </div><!-- End column menu panel -->
  <div class="col-sm-12">

