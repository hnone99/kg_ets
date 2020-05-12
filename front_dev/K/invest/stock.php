<?
	include_once $_SERVER["DOCUMENT_ROOT"] ."/lib/func_user.php";
	$PageLogCode = "INVEST_01";

    $url = "http://asp1.krx.co.kr/servlet/krx.asp.XMLSise?code=". $G_STOCK_CODE;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

    $resp = curl_exec($ch);
    curl_close($ch);

    $obj = simplexml_load_string(trim($resp));

	$Hoga = array();
	$Hoga["mesuHap"]		= (int)str_replace(",", "", trim($obj->TBL_Hoga["mesuJan0"])) + (int)str_replace(",", "", trim($obj->TBL_Hoga["mesuJan1"])) + (int)str_replace(",", "", trim($obj->TBL_Hoga["mesuJan2"])) + (int)str_replace(",", "", trim($obj->TBL_Hoga["mesuJan3"])) + (int)str_replace(",", "", trim($obj->TBL_Hoga["mesuJan4"]));
	$Hoga["medoHap"]		= (int)str_replace(",", "", trim($obj->TBL_Hoga["medoHoka0"])) + (int)str_replace(",", "", trim($obj->TBL_Hoga["medoHoka1"])) + (int)str_replace(",", "", trim($obj->TBL_Hoga["medoHoka2"])) + (int)str_replace(",", "", trim($obj->TBL_Hoga["medoHoka3"])) + (int)str_replace(",", "", trim($obj->TBL_Hoga["medoHoka"]));
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
	<script src="http://asp1.krx.co.kr/inc/js/asp_chart.js"></script>
	<script>
		$(document).ready(function(){
			/* 차트 */
			onChart('100%', '300', '<?=$G_STOCK_CODE?>');
		});
	</script>
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
                <span data-depth2 hidden>주가정보</span>

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
                            <h3 class="title">주가정보 : <?=trim($obj->stockInfo["myNowTime"]) ?> 기준(<?=trim($obj->stockInfo["myJangGubun"]) ?>)</h3>
                        </div>
                        <article>
							<div class="d-none d-md-block">
								<h4 class="subtitle">주가 그래프</h4>
								<div id="gpDisp" class="pb-3"></div>
							</div>

							<h4 class="subtitle mt-4">주가 정보</h4>
							<div class="row">
								<div class="col-12 col-md-4">
									<table class="table table-center" summary="년도별 금액, 구성비, 증감율 정보 제공">
									<caption>주가정보</caption>
									<tr>
										<th colspan="2">A<?=$G_STOCK_CODE ?>&nbsp;&nbsp;<?=trim($obj->TBL_StockInfo["JongName"]) ?></th>
									</tr>
									<tr>
										<td><span class="badge badge-danger badge-lg">현 재 가</span></td>
										<td class="text-right"><strong class="text-danger"><?=trim($obj->TBL_StockInfo["CurJuka"]) ?></strong></td>
									</tr>
									<tr>
										<td><span class="badge badge-blue badge-lg">전일대비</span></td>
										<td class="text-right"><?=getIRAscending(trim($obj->TBL_StockInfo["DungRak"]), trim($obj->TBL_StockInfo["Debi"]), "IR") ?> ( <?=getIRAscendingPer(trim($obj->TBL_StockInfo["DungRak"]), trim($obj->TBL_StockInfo["CurJuka"]), trim($obj->TBL_StockInfo["Debi"]))?> )</td>
									</tr>
									<tr>
										<td><span class="badge badge-blue badge-lg">거 래 량</span></td>
										<td class="text-right"><?=trim($obj->TBL_StockInfo["Volume"]) ?></td>
									</tr>
									<tr>
										<td><span class="badge badge-blue badge-lg">거래대금</span></td>
										<td class="text-right"><?=trim($obj->TBL_StockInfo["Money"]) ?></td>
									</tr>
									</table>
								</div>
								<div class="col-12 col-md-4">
									<table class="table table-center" summary="년도별 금액, 구성비, 증감율 정보 제공">
									<caption>시가정보</caption>
									<tr>
										<th>시 가</th>
										<td class="text-right"><?=trim($obj->TBL_StockInfo["StartJuka"]) ?></td>
									</tr>
									<tr>
										<th>고 가</th>
										<td class="text-right"><?=trim($obj->TBL_StockInfo["HighJuka"]) ?></td>
									</tr>
									<tr>
										<th>저 가</th>
										<td class="text-right"><?=trim($obj->TBL_StockInfo["LowJuka"]) ?></td>
									</tr>
									<tr>
										<th>P E R</th>
										<td class="text-right"><?=trim($obj->TBL_StockInfo["Per"]) ?></td>
									</tr>
									<tr>
										<th>상장주식수</th>
										<td class="text-right"><?=trim($obj->TBL_StockInfo["Amount"]) ?></td>
									</tr>
									</table>
								</div>
								<div class="col-12 col-md-4">
									<table class="table table-center" summary="년도별 금액, 구성비, 증감율 정보 제공">
									<caption>상하한가 정보</caption>
									<tr>
										<th>상한가</th>
										<td colspan="2" class="text-right"><?=trim($obj->TBL_StockInfo["UpJuka"]) ?></td>
									</tr>
									<tr>
										<th>하한가</th>
										<td colspan="2" class="text-right"><?=trim($obj->TBL_StockInfo["DownJuka"]) ?></td>
									</tr>
									<tr>
										<th>액면가</th>
										<td colspan="2" class="text-right"><?=trim($obj->TBL_StockInfo["FaceJuka"]) ?></td>
									</tr>
									<tr>
										<th rowspan="2">52주<br />(종가기준)</th>
										<th>최고</th>
										<td class="text-right"><?=trim($obj->TBL_StockInfo["High52"]) ?></td>
									</tr>
									<tr>
										<th>최저</th>
										<td class="text-right"><?=trim($obj->TBL_StockInfo["Low52"]) ?></td>
									</tr>
									</table>
								</div>
							</div>

							<h4 class="subtitle mt-4">항목별 정보 조회</h4>
							<div class="tab">
                                <ul class="nav" role="tablist">
                                    <li><a href="#t1" class="nav-link active" role="tab" data-toggle="tab" aria-controls="t1" aria-selected="true">호가</a></li>
                                    <li><a href="#t2" class="nav-link" role="tab" data-toggle="tab" aria-controls="t2" aria-selected="true">시간대별 체결가</a></li>
                                    <li><a href="#t3" class="nav-link" role="tab" data-toggle="tab" aria-controls="t3" aria-selected="true">회원사별 거래</a></li>
                                    <li><a href="#t4" class="nav-link" role="tab" data-toggle="tab" aria-controls="t4" aria-selected="true">일자별 시세</a></li>
                                </ul>
                            </div>

							<div class="tab-content">
								<div id="t1" class="tab-pane fade show active" role="tabpanel">
									<div class="table-responsive">
										<table class="table table-center" summary="년도별 금액, 구성비, 증감율 정보 제공">
										<caption>호가 정보</caption>
										<thead>
										<tr>
											<th>매도잔량</th>
											<th>호가</th>
											<th>매수잔량</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td><?=trim($obj->TBL_Hoga["mesuJan0"])?></td>
											<td><?=trim($obj->TBL_Hoga["mesuHoka0"])?></td>
											<td></td>
										</tr>
										<tr>
											<td><?=trim($obj->TBL_Hoga["mesuJan1"])?></td>
											<td><?=trim($obj->TBL_Hoga["mesuHoka1"])?></td>
											<td></td>
										</tr>
										<tr>
											<td><?=trim($obj->TBL_Hoga["mesuJan2"])?></td>
											<td><?=trim($obj->TBL_Hoga["mesuHoka2"])?></td>
											<td></td>
										</tr>
										<tr>
											<td><?=trim($obj->TBL_Hoga["mesuJan3"])?></td>
											<td><?=trim($obj->TBL_Hoga["mesuHoka3"])?></td>
											<td></td>
										</tr>
										<tr>
											<td><?=trim($obj->TBL_Hoga["mesuJan4"])?></td>
											<td><?=trim($obj->TBL_Hoga["mesuHoka4"])?></td>
											<td></td>
										</tr>
										<tr>
											<td></td>
											<td><?=trim($obj->TBL_Hoga["medoJan0"])?></td>
											<td><?=trim($obj->TBL_Hoga["medoHoka0"])?></td>
										</tr>
										<tr>
											<td></td>
											<td><?=trim($obj->TBL_Hoga["medoJan1"])?></td>
											<td><?=trim($obj->TBL_Hoga["medoHoka1"])?></td>
										</tr>
										<tr>
											<td></td>
											<td><?=trim($obj->TBL_Hoga["medoJan2"])?></td>
											<td><?=trim($obj->TBL_Hoga["medoHoka2"])?></td>
										</tr>
										<tr>
											<td></td>
											<td><?=trim($obj->TBL_Hoga["medoJan3"])?></td>
											<td><?=trim($obj->TBL_Hoga["medoHoka3"])?></td>
										</tr>
										<tr>
											<td></td>
											<td><?=trim($obj->TBL_Hoga["medoJan4"])?></td>
											<td><?=trim($obj->TBL_Hoga["medoHoka4"])?></td>
										</tr>
										<tr>
											<th><?=number_format($Hoga["mesuHap"], 0)?></th>
											<th>잔량합계</th>
											<th><?=number_format($Hoga["medoHap"], 0)?></th>
										</tr>
										</table>
									</div>
								</div>

								<div id="t2" class="tab-pane fade" role="tabpanel">
									<div class="table-responsive">
										<table class="table table-center" summary="시간, 체결가, 전일대비, 매도호가, 매수호가, 매수잔량 정보 제공">
										<caption>시간대별 체결가 정보</caption>
										<thead>
										<tr>
											<th>시간</th>
											<th>체결가</th>
											<th>전일대비</th>
											<th>매도호가</th>
											<th>매수호가</th>
											<th>매수잔량</th>
										</tr>
										</thead>
										<tbody>
										<?php
											foreach ($obj->TBL_TimeConclude->children() AS $timeconclude) {
												$timeDungrak = $timeconclude["Dungrak"];

												if ($timeDungrak == "1" || $timeDungrak == "2") {
													$timeArrow = $up;
												}
												else if ($timeDungrak == "3") {
													$timeArrow = $bohab;
												}
												else if ($timeDungrak == "4" || $timeDungrak == "5") {
													$timeArrow = $down;
												}
										?>
										<tr>
											<td><?=$timeconclude["time"] ?></td>
											<td><?=$fg->isNull($timeconclude["negoprice"], "-") ?></td>
											<td><?=getIRAscending($timeconclude["Dungrak"], $fg->isNull($timeconclude["Debi"], "0"), "IR")?></td>
											<td><?=$fg->isNull($timeconclude["sellprice"], "-") ?></td>
											<td><?=$fg->isNull($timeconclude["buyprice"], "-") ?></td>
											<td><?=$fg->isNull($timeconclude["amount"], "-") ?></td>
										</tr>
										<?php
											}
										?>
										</tbody>
										</table>
									</div>
								</div>

								<div id="t3" class="tab-pane fade" role="tabpanel">
									<div class="table-responsive">
										<table class="table table-center" summary="회원사별 매도/매수 증권사, 거래량 정보 제공">
										<caption>회원사별 거래 정보</caption>
										<thead>
										<tr>
											<th colspan="2">매도상위</th>
											<th colspan="2">매수상위</th>
										</tr>
										<tr>
											<th>증권사</th>
											<th>거래량</th>
											<th>증권사</th>
											<th>거래량</th>
										</tr>
										</thead>
										<tbody>
										<?php
											foreach ($obj->TBL_AskPrice->children() AS $askPrice) {
										?>
										<tr>
											<td><?=$fg->isNull($askPrice["member_memdoMem"], "-") ?></td>
											<td><?=$fg->isNull($askPrice["member_memdoVol"], "-") ?></td>
											<td><?=$fg->isNull($askPrice["member_memsoMem"], "-") ?></td>
											<td><?=$fg->isNull($askPrice["member_mesuoVol"], "-") ?></td>
										</tr>
										<?php
											}
										?>
										</tbody>
										</table>
									</div>
								</div>

								<div id="t4" class="tab-pane fade" role="tabpanel">
									<div class="table-responsive">
										<table class="table table-center" summary="일자, 종가, 전일대비, 시가, 고가, 저가, 거래창 거래대금 정보">
										<caption>일자별 시세 정보</caption>
										<thead>
										<tr>
											<th>일자</th>
											<th>종가</th>
											<th>전일대비</th>
											<th>시가</th>
											<th>고가</th>
											<th>저가</th>
											<th>거래량</th>
											<th>거래대금</th>
										</tr>
										</thead>
										<tbody>
										<?php
											foreach ($obj->TBL_DailyStock->children() AS $dayStock) {
												$dailyDungrak = $dayStock["day_Dungrak"];

												if ($dailyDungrak == "1" || $dailyDungrak == "2") {
													$timeArrow = $up;
												}
												else if ($dailyDungrak == "3") {
													$timeArrow = $bohab;
												}
												else if ($dailyDungrak == "4" || $dailyDungrak == "5") {
													$timeArrow = $down;
												}
										?>
										<tr>
											<td><?=$fg->isNull($dayStock["day_Date"], "-") ?></td>
											<td><?=$fg->isNull($dayStock["day_EndPrice"], "-") ?></td>
											<td><?=getIRAscending($dayStock["day_Dungrak"], $fg->isNull($dayStock["day_getDebi"], "0"), "IR")?></td>
											<td><?=$fg->isNull($dayStock["day_Start"], "-") ?></td>
											<td><?=$fg->isNull($dayStock["day_High"], "-") ?></td>
											<td><?=$fg->isNull($dayStock["day_Low"], "-") ?></td>
											<td><?=$fg->isNull($dayStock["day_Volume"], "-") ?></td>
											<td><?=$fg->isNull($dayStock["day_getAmount"], "-") ?></td>
										</tr>
										<?php
											}
										?>
										</tbody>
										</table>
									</div>
								</div>
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
