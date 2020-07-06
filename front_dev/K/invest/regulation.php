<?
	include_once $_SERVER["DOCUMENT_ROOT"] ."/lib/func_user.php";
	$PageLogCode = "INVEST_04";

	$tblname	= "fg_board_info";

	$fd->query("UPDATE ". $tblname ." SET iHitCnt = iHitCnt + 1 WHERE (cDelFlag = 'N') AND (sLang = 'KO') AND (sGubun = 'rules') AND (iGoodCnt = '1')");

	$contentInfo = $fd->getOneRecord($tblname, "sPrtDate, sTitle, sFileName, sFileSave, iFileSize, iHitCnt, sContext", "(cDelFlag = 'N') AND (sLang = 'KO') AND (sGubun = 'rules') AND (iGoodCnt = '1')");

	$s_openDate	= stripslashes(trim($contentInfo[0][0]));
	$s_title	= stripslashes(trim($contentInfo[0][1]));
	$s_fileName	= trim($contentInfo[0][2]);
	$s_fileSave	= trim($contentInfo[0][3]);
	$s_fileSize	= trim($contentInfo[0][4]);
	$s_hitCnt	= trim($contentInfo[0][5]);
	$s_context	= stripslashes(trim($contentInfo[0][6]));

	if ($s_fileSize > 0) {
		$fileIcon = $ff->fileIconGet(trim($s_fileSave));
	}
	else {
		$fileIcon = "-";
	}

	$fileInfo	= "";
	if ($s_fileSize > 0) {
		$fileInfo = "<a target=\"mainFrame\" href=\"/lib/Download.php?fd=". strtolower("ko/rules") ."&sn=". $fg->encodeURL($s_fileSave) ."&fn=". $fg->encodeURL($s_fileName) ."\" title=\"". trim($s_fileName) ."\" onfocus=\"this.blur();\">". $fileIcon . $s_fileName ."</a> ( ". $fg->convertSize($s_fileSize) ." )";
	}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KG ETS</title>
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width">
    <meta name="keywords" content="KG ETS, KG, KG ECO  TECHNOLOGY SERVICES, 친환경, 재생에너지, 신소재, 도금용 산화동, 황산동, 산업용 산화동, 탄산동, 산화텅스텐, 바이오중유, 에너지사업, 증기사업, 신소재사업, R&E사업, 바이오사업부, 열병합발전, 존경받는 기업, 자랑스런 회사, 환경, 기술, 봉사, 산업폐기물, 시약 분류 시스템, 폐시약">
    <link rel="icon" href="../../../resources/images/favicon-32.png" sizes="32x32">
    <link rel="icon" href="../../../resources/images/favicon-128.png" sizes="128x128">
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
                <span data-depth2 hidden>내부정보관리 규정</span>

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
						<?=$s_context?>
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
