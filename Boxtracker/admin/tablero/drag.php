<?php 
include_once("../../BACKEND/model/Usuario.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Drag</title>
	<?php include_once "header.php";?>

<!-- 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/gridstack.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.0/lodash.min.js"></script> -->

</head>
<body class="nav-md">
<?php include_once "menu.php";?>
<div class="right_col" role="main">

  <div class="page-title">

        <div class="title_left">

            <h3>Tableros </h3>

        </div>

    </div>

  <div class="clearfix"></div>

  <div class="row">

      <div class="col-md-12">

        <div class="x_panel">
          <div class="x_content">
            <!-- <div class="gridly">
              <div class="brick small"></div>
              <div class="brick small"></div>
              <div class="brick small"></div>
              <div class="brick small"></div>
            </div> -->
            	<div>
                <a class="btn btn-default" id="add-new-widget" href="#">Add Widget</a>
              </div>
            	<div class="grid-stack" style="width: 80%;"></div>
          </div>

        </div>

      </div>

    </div>

</div>



 <?php include_once "footer.php";?>
 <!--
<script src="js/jquery.gridly.js" type="text/javascript"></script>
<link href="css/jquery.gridly.css" rel="stylesheet" type="text/css"/> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.0/lodash.min.js"></script>

<script src="js/gridstack.js" type="text/javascript"></script>
<link href="css/gridstack.css" rel="stylesheet" type="text/css"/> 

     <style type="text/css">
        .grid-stack {
            background: lightgoldenrodyellow;
        }

        .grid-stack-item-content {
            color: #2c3e50;
            text-align: center;
            background-color: #18bc9c;
        }
    </style>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/gridstack.js/0.4.0/gridstack.min.css" />
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/gridstack.js/0.4.0/gridstack.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/gridstack.js/0.4.0/gridstack.jQueryUI.min.js"></script> -->
<script src="js/gridstack.js"></script>
<script src="js/gridstack.jQueryUI.js"></script>
<script type="text/javascript">
 $(function(){
    // $('.gridly').gridly({
    //   columns: 6
    // });
  	
  	// var options = {
   //      cellHeight: 80,
   //      verticalMargin: 10
   //  };
    //$('.grid-stack').gridstack(options);
  	// $('.grid-stack').gridstack();
  });
</script>

<script type="text/javascript">
        $(function () {
            var options = {
                float: true
            };
            $('.grid-stack').gridstack(options);

            new function () {
                this.items = [
                    {x: 0, y: 0, width: 2, height: 2},
                    {x: 3, y: 1, width: 1, height: 2},
                    {x: 4, y: 1, width: 1, height: 1},
                    {x: 2, y: 3, width: 3, height: 1},
//                    {x: 1, y: 4, width: 1, height: 1},
//                    {x: 1, y: 3, width: 1, height: 1},
//                    {x: 2, y: 4, width: 1, height: 1},
                    {x: 2, y: 5, width: 1, height: 1}
                ];

                this.grid = $('.grid-stack').data('gridstack');

                this.addNewWidget = function () {
                    var node = this.items.pop() || {
                                x: 12 * Math.random(),
                                y: 5 * Math.random(),
                                width: 1 + 3 * Math.random(),
                                height: 1 + 3 * Math.random()
                            };
                    this.grid.addWidget($('<div><div class="grid-stack-item-content" /><div/>'),
                        node.x, node.y, node.width, node.height);
                    return false;
                }.bind(this);

                $('#add-new-widget').click(this.addNewWidget);
            };
        });
    </script>
</body>
</html>