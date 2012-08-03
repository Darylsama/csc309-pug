<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- standard charset -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <!-- title -->
    <title><?php echo $this->page["title"] ?></title>

    <!-- Le Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="team-xyz group project">
    <meta name="author" content="xiang, yang, daryl">

    <!-- Le styles -->
    <link href="view/css/style.css" rel="stylesheet">
    
    <!-- custom css code for individual page -->
    <?php if (isset($this->page["css"])) { ?>
    <?php foreach ($this->page["css"] as $css_filename) { ?>
    <link href="<?php echo $css_filename; ?>" rel="stylesheet">
    <?php } ?>
    <?php }?>
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/jquery-ui.js"></script>
    <script src="./view/js/script.js"></script>
    
    <!-- custom javascript code for individual page -->
    <?php if (isset($this->page["js"])) {?>
    <?php foreach ($this->page["js"] as $js_filename) { ?>
    <script src="<?php echo $js_filename; ?>"></script>
    <?php } ?>
    <?php } ?>
    
    <!-- include jquery in the beginning so user page can use it -->

    <!-- ??? -->
    <meta name="document_iterator.js">
    <meta name="find_proxy.js">
    <meta name="get_html_text.js">
    <meta name="global_constants.js">
    <meta name="name_injection_builder.js">
    <meta name="number_injection_builder.js">
    <meta name="menu_injection_builder.js">
    <meta name="string_finder.js">
    <meta name="change_sink.js">

  </head>

  <body>
  
	<!-- nav bar top -->
  	<?php include "view/navbar.php"?>
    
    <!-- page content -->
    <?php include $this->page["page"]; ?>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/bootstrap-transition.js"></script>
    <script src="./assets/js/bootstrap-alert.js"></script>
    <script src="./assets/js/bootstrap-modal.js"></script>
    <script src="./assets/js/bootstrap-dropdown.js"></script>
    <script src="./assets/js/bootstrap-scrollspy.js"></script>
    <script src="./assets/js/bootstrap-tab.js"></script>
    <script src="./assets/js/bootstrap-tooltip.js"></script>
    <script src="./assets/js/bootstrap-popover.js"></script>
    <script src="./assets/js/bootstrap-button.js"></script>
    <script src="./assets/js/bootstrap-collapse.js"></script>
    <script src="./assets/js/bootstrap-carousel.js"></script>
    <script src="./assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>