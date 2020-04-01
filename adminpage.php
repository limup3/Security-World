<?php

	$db = new mysqli("localhost","sw","P@ssw0rd","sw");

	if($db->connect_error) {

		die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');

	}

	$db->set_charset('utf8');


  $sql = 'select * from sign_info'; // 총 유저수 쿼리문

  $sign_cnt = $db->query($sql);

  $sign_count = mysqli_num_rows($sign_cnt);


  $sql2 = 'select * from board_free'; // 총 게시글 수 쿼리문

  $board_cnt = $db->query($sql2);

  $board_count = mysqli_num_rows($board_cnt);


  		// 오늘 방문자수
    	$currdt = date("Y-m-d H:i:s");

  		$query = "select count(*) as count from tb_stat_visit where DATE(regdate) = DATE('$currdt')";

  		$data = $db->query($query)->fetch_array();

  		$today_visit_count = $data['count'];



  		// 전체 방문자수

  		$query = "select count(*) as count from tb_stat_visit";

  		$data = $db->query($query)->fetch_array();

  		$total_visit_count = $data['count'];

  //     // 아이피 접근
  //     $possible_ip = '192.168.233.1'; // 아이피 입력
	//
  //     if ($_SERVER['REMOTE_ADDR'] != $possible_ip) {
	//
  //       ?>      <script>
  //               alert('권한 없음.');
  //               location.replace("/index.php");
  //               </script>
   <?php
  //     }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>admin page</title>


    <!-- Bootstrap Core CSS -->
    <link href="/SW/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="/SW/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/SW/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->


        <div >
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">관리자 페이지</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $sign_count ?></div>
                                    <div>Total User!</div>
                                </div>
                            </div>
                        </div>
                        <a href="/SW/admin_info.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-clipboard fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $board_count ?></div>
                                    <div>Total board!</div>
                                </div>
                            </div>
                        </div>
                        <a href="/SW/board/index.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-clock-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $today_visit_count ?></div>
                                    <div>Day Visitant!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-history fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $total_visit_count ?></div>
                                    <div>Total Visitant!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->


                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> 이전 페이지 경로 Top 5
                        </div>
                        <!-- /.panel-heading -->


                        <div class="panel-body">
                            <div class="list-group">
                              <?php
                              $sql = "select * from ref_page order by hit desc limit 5";

                              $result = $db->query($sql);

                              while($row = $result->fetch_assoc())

                                      {
                              ?>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-google fa-fw"></i>
                                    <?php
                                      if($row['domain'] != "")
                                      {
                                        echo $row['domain'];
                                      }
                                      else
                                      {
                                          echo "URL 접근";
                                      }?>
                                    <span class="pull-right text-muted small"><em><?php echo $row['hit']?></em>
                                    </span>
                                </a>
                                <?php

                                  }
                                  ?>
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <a href="#" class="btn btn-default btn-block">View Details</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/SW/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/SW/bootstrap/js/bootstrap.min.js"></script>


    <!-- Morris Charts JavaScript -->
    <script src="/SW/js/raphael.min.js"></script>
    <script src="/SW/js/morris.min.js"></script>
    <script src="/SW/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/SW/js/sb-admin-2.js"></script>

</body>

</html>
