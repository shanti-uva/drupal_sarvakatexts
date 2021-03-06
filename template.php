<?php

define('SARVAKATEXTS_PATH',drupal_get_path('theme','shanti_sarvaka_texts'));

function sarvakatexts_preprocess_views_view(&$vars) {

  if (isset($vars['view']->name) && $vars['view']->name == 'all_texts') {
  
    // Grab the pieces you want and then remove them from the array    
    $header   = $vars['header'];    $vars['header']   = '';
    $filters  = $vars['exposed'];   $vars['exposed']  = '';
    $pager    = $vars['pager'];     $vars['pager']    = '';
    
    $control_box = array(
      '#type' => 'container',
      '#attributes' => array('class' => array('view-all-texts-control-box')),
      'control_box_row' => array(
        '#type' => 'container',
        '#attributes' => array('class' => array('view-all-texts-control-box-row row')),
        'header' => array(
          '#markup' => $header,
          '#prefix'  => "<div class='view-all-texts-control-box-cell-header view-all-texts-control-box-cell col-lg-3 col-md-3 col-sm-6'>",
          '#suffix' => "</div>",        
        ),
        'filters' => array(
          '#markup' => $filters,
          '#prefix'  => "<div class='view-all-texts-control-box-cell-filters view-all-texts-control-box-cell col-lg-4 col-md-5 col-sm-6'>",
          '#suffix' => "</div>",        
        ),
        'switch_list' => array(
            '#prefix'  => "<div class='view-all-texts-control-box-cell-switch view-all-texts-control-box-cell col-lg-2 col-md-4'>",
            '#suffix' => "</div>",        
            '#theme' => 'item_list',
            '#type'  => 'ul',
            '#attributes' => array('id' => 'view-all-texts-switcher'),
            '#items' => array(
              array(
                'class' => array('fat-list'),
                'data'  => "<span id='view-all-texts-fat-list' class='icon shanticon-list'></span>",
              ), 
              array(
                'class' => array('thin-list'),
                'data'  => "<span id='view-all-texts-thin-list' class='icon shanticon-list4'></span>",              
              ),
              array(
                'class' => array('grid'),
                'data'  => "<span id='view-all-texts-grid' class='icon shanticon-grid'></span>",              
              ),
            ),
          ),
        'pager' => array(
          '#markup' => $pager,
          '#prefix' => "<div class='view-all-texts-control-box-cell-pager view-all-texts-control-box-cell col-lg-3'>",
          '#suffix' => "</div>",
        ),
      ),
    );
    
    $control_box['#attached']['js'] = array(
      SHANTI_TEXTS_PATH . '/js/jquery.transit.min.js',
      SARVAKATEXTS_PATH . '/js/jquery.cookie.js',
      SARVAKATEXTS_PATH . '/js/shanti_texts_page_all_texts.js',
    );

    $control_box['#attached']['css'] = array(
      SARVAKATEXTS_PATH . '/css/shanti_texts_page_all_texts.css'    
    );

    // Attach the new element to the array
    $vars['attachment_before'] = drupal_render($control_box);
    $vars['attachment_after']  = $pager;
        
  }
  
  /*
  function sarvakatexts_whole_node_html($vars) {
		$depth    = $vars['node']->book['depth'];
		$title    = check_plain($vars['node']->title);
		$content  = $vars['node']->rendered; // THIS IS CREATED IN *_whole_node()
		$nid			= $vars['node']->nid;
		$output = '';
		$output .= "<div id=\"book-node-$nid\" class=\"book-section section-$depth\">\n";
		$output .= "<h2 class=\"book-heading\">BOO: $title</h2>\n";  
		$output .= drupal_render($vars['editmenu']) . "\n";
		$output .= $content . "\n";
		$output .= $vars['children'] . "\n";
		$output .= "</div>\n";	
		return $output;
	}
	*/
	

}
