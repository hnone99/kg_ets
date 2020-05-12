<?php
	include_once $_SERVER["DOCUMENT_ROOT"] ."/lib/func_user.php";
	$PageLogCode = "INVEST_03";

    $url = "http://asp1.krx.co.kr/servlet/krx.asp.DisList4MainServlet?code=151860&gubun=K";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

    $resp = curl_exec($ch);
    curl_close($ch);

    $obj = simplexml_load_string(trim($resp));
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KG ETS</title>
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="keywords" content="KG ETS, KG, KG ECO  TECHNOLOGY SERVICES, 친환경, 재생에너지, 신소재, 도금용 산화동, 황산동, 산업용 산화동, 탄산동, 산화텅스텐, 바이오중유, 에너지사업, 증기사업, 신소재사업, R&E사업, 바이오사업부, 열병합발전, 존경받는 기업, 자랑스런 회사, 환경, 기술, 봉사, 산업폐기물, 시약 분류 시스템, 폐시약">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/K/resources/css/reset.css">
    <link rel="stylesheet" href="/K/resources/css/bootstrap.css">
    <link rel="stylesheet" href="/K/resources/plugins/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/K/resources/plugins/swiper-4.4.6/css/swiper.min.css">
    <link rel="stylesheet" href="/K/resources/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/K/resources/css/style.css">
    <!-- jquery -->
    <script src="/K/resources/plugins/jquery/jquery.min.js"></script>
    <!-- jquery -->
    <script src="/K/resources/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- bootstrap -->
    <script src="/K/resources/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- swiper -->
    <script src="/K/resources/plugins/swiper-4.4.6/js/swiper.min.js"></script>
    <!-- ui 관련 -->
    <script src="/K/resources/js/ui.js"></script>
</head>

<body>
    <div id="wrap">
        <div id="header-block">
            <!-- header include -->
            <? include_once $_SERVER["DOCUMENT_ROOT"] ."/K/common/header.php"; ?>
        </div>

        <div id="content-block">
            <div id="content">

                <span data-depth1 hidden data-menu="invest">투자정보</span>
                <span data-depth2 hidden>공시정보</span>

                <div id="visual" class="invest">
                    <div class="container">
                        <h2>IR</h2>
                        <p>투자정보현황을 확인하실 수 있습니다.</p>
                    </div>
                </div>

                <div id="nav-block">
                    <!-- nav include -->
                    <? include_once $_SERVER["DOCUMENT_ROOT"] ."/K/common/nav.php"; ?>
                </div>

                <div id="view">
                    <div class="container">
                        <!-- 실 컨텐츠 -->
                        <div class="title-wrap">
                            <h3 class="title">공시정보</h3>
                        </div>
                        <article>

						<div class="table-responsive">
                            <table class="table table-center" summary="번호, 제목, 기관명, 날짜 정보 제공">
                                <caption>공시정보</caption>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>제목</th>
                                        <th>기관명</th>
                                        <th>날짜</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 1;

                                    foreach($obj->children() as $child) {
                                ?>
                                <tr align="center">
                                    <td><?= $i ?></td>
                                    <td class="text-left"><a href="http://kind.krx.co.kr/common/disclsviewer.do?method=search&acptno=<?= $child["disAcpt_no"] ?>" target="_blank"><?= $child["disTitle"] ?></a></td>
                                    <td><?= $child["submitOblgNm"] ?></td>
                                    <td><?= substr($child["distime"], 0, 4) .".". substr($child["distime"], 4, 2) .".". substr($child["distime"], 6, 2) ?></td>
                                </tr>
                                <?php
                                        $i++;
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        </article>
                        <!-- //실 컨텐츠 -->
                    </div>
                </div>
            </div>
        </div>

        <div id="footer-block">
            <!-- footer include -->
            <? include_once $_SERVER["DOCUMENT_ROOT"] ."/K/common/footer.php"; ?>
        </div>
    </div>

</body>

</html>
