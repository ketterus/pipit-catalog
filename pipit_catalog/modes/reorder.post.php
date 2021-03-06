<?php

    $Alert->set('info', $Lang->get('Drag and drop the Products to reorder them.'));

    echo $HTML->title_panel([
        'heading' => $Lang->get('Listing all Products'),
    ], $CurrentUser);

    $Smartbar = new PerchSmartbar($CurrentUser, $HTML, $Lang);

    $Smartbar->add_item([
        'active' => false,
        'title' => $Lang->get('Products'),
        'link'  => $API->app_nav(),
        'icon'  => 'ext/o-shirt',
    ]);

    $Smartbar->add_item([
        'active' => true,
        'title' => $Lang->get('Reorder'),
        'link'  => $API->app_nav().'/reorder/',
        'icon'  => 'core/menu',
        'position' => 'end',
    ]);

    echo $Smartbar->render();
    
    if (PerchUtil::count($products)) 
    {

        echo '<div class="inner">';
        echo $Form->form_start('reorder', 'reorder');
        
        echo '<ol class="reorder_list basic-sortable sortable-tree">';

        foreach($products as $Product) 
        {
            echo '<li><div>';
                echo '<input type="text" name="p-'.$Product->productID().'" value="'.$Product->productOrder().'" />';

                if(!$Settings->get('pipit_catalog_hideProductImages')->val())
		        {
                    echo $Helper->get_product_image($Product, $API, $Settings);
                }
                else
                {
                    echo PerchUI::icon('ext/o-shirt');
                }

                echo $HTML->encode($Product->title()).'</div>';
            echo '</li>';    
        }

        echo '</ol>';

        echo $Form->hidden('orders', '');
        echo $Form->submit_field('reorder', 'Save Changes', $API->app_path());

        echo $Form->form_end();
        echo '</div>';
    }