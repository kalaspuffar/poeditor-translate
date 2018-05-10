<?php
$xml = simplexml_load_file($argv[1]);
$outfile = $argv[2];

$data = "";
$data .= "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
$data .= "<resources>\n";

foreach ($xml as $res) {
    $data .= "<string name=\"" . $res->attributes()->name->__toString() . "\">";
    $fixedString = $res->__toString();
    $fixedString = substr($fixedString, 1, strlen($fixedString) - 2);
    $fixedString = html_entity_decode($fixedString);
    $fixedString = str_replace("'", "\'", $fixedString);
    $data .= $fixedString;
    $data .= "</string>\n";
}
$data .= "</resources>\n";

file_put_contents($outfile, $data);