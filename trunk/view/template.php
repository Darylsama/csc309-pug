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
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

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
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">

        <div class="container">

          <!-- title -->
          <a class="brand" href="profile.php">Pick-up Games</a>

          <!-- logout -->
          <ul class="nav pull-right">
            <?php if (get_loggedin_user() != null) { ?>
            <li>
              <a href="logout.php">Logout</a>
            </li>
            <?php } ?>
          </ul>
        </div>

      </div>
    </div>

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