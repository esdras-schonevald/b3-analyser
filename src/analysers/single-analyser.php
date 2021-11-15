<?php

$config = yaml_parse_file (
    __DIR__ . "/../config/config.yaml"
);

$data = json_decode(
    file_get_contents($config['stock']['list']['server']['url']), 1
);

$subsetores = $config['subsectors']['buy'];

$dataExpiracao  =   date('Ymd', strtotime('-5 months'));

foreach ($data['ativos'] as $key => $stock) {
    $data[$key]['Pontos'] = 0;
    $pontos = 0;
    $dataUltCot     =   DateTime::createFromFormat('d/m/Y', $stock['Data últ cot']);

    if (!$dataUltCot || intval($dataUltCot->format('Ymd')) < intval($dataExpiracao)) {
        continue;
    }

    $setor          =   (in_array($stock['Subsetor'], $subsetores))? 1 : 0;
    $pl             =   strtofloat($stock['P/L']);
    $evebitda       =   strtofloat($stock['EV / EBITDA']);
    $margliquida    =   strtofloat($stock['Marg. Líquida']);
    $cresrec5a      =   strtofloat($stock['Cres. Rec (5a)']);
    $lpa            =   strtofloat($stock['LPA']);
    $vpa            =   strtofloat($stock['VPA']);
    $liquidezcorr   =   strtofloat($stock['Liquidez Corr']);
    $divbrpatrim    =   strtofloat($stock['Div Br/ Patrim']);
    $divyield       =   strtofloat($stock['Div. Yield']);
    $cotacao        =   strtofloat($stock['Cotação']);

    $pontos         +=  $setor  * 100;
    if ($pl <> 0)            $pontos +=  90  / $pl;
    if ($evebitda <> 0)      $pontos +=  80  / $evebitda;
    if ($margliquida > 0 && $margliquida < 100)   $pontos +=  1.70  * $margliquida;
    if ($cresrec5a > 0 && $cresrec5a < 100)     $pontos +=  1.60  * $cresrec5a;
    if ($lpa <> 0)           $pontos +=  50  / ($cotacao / $lpa);
    //if ($vpa <> 0)           $pontos +=  40  / ($cotacao / $vpa);
    if ($liquidezcorr > 0)   $pontos +=  1.30  * $liquidezcorr;
    if ($divbrpatrim > 0)   $pontos +=  20  / $divbrpatrim;
    if ($divyield > 0 && $divyield < 100)      $pontos +=  1.10  * $divyield;

    $data['ativos'][$key]['Pontos']   =   $pontos;
}

usort($data['ativos'], fn ($a, $b) => $a['Pontos'] < $b['Pontos']);

$radar = [];
foreach (array_chunk($data['ativos'], 50)[0] as $stock) {
    $radar["compra"][]   =   [
        "tiker"         => $stock["Papel"],
        "pontos"        => $stock["Pontos"],
        "cotacao"       => $stock["Cotação"],
        "pl"            => $stock["P/L"],
        "evebitda"      => $stock["EV / EBITDA"],
        "margliquida"   => $stock['Marg. Líquida'],
        "cresrec5a"     => $stock['Cres. Rec (5a)'],
        "lpa"           => $stock['LPA'],
        "vpa"           => $stock['VPA'],
        "liquidezcorr"  => $stock['Liquidez Corr'],
        "divbrpatrim"   => $stock['Div Br/ Patrim'],
        "divyield"      => $stock['Div. Yield']
    ];
}

foreach (array_chunk(array_reverse($data['ativos']), 50)[0] as $stock) {
    $radar["venda"][]   =   [
        "tiker"         => $stock["Papel"],
        "pontos"        => $stock["Pontos"],
        "cotacao"       => $stock["Cotação"],
        "pl"            => $stock["P/L"],
        "evebitda"      => $stock["EV / EBITDA"],
        "margliquida"   => $stock['Marg. Líquida'],
        "cresrec5a"     => $stock['Cres. Rec (5a)'],
        "lpa"           => $stock['LPA'],
        "vpa"           => $stock['VPA'],
        "liquidezcorr"  => $stock['Liquidez Corr'],
        "divbrpatrim"   => $stock['Div Br/ Patrim'],
        "divyield"      => $stock['Div. Yield']
    ];
}

header("Content-Type: Application/JSON");
echo json_encode($radar);

function strtofloat (string $value): float {
    return floatval(str_replace(['.', ','], ['', '.'], $value));
}