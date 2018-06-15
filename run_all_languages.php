<?php
$languages = array(
    'ar' => 'Arabic',
    'nl' => 'Dutch',
    'en' => 'English',
    'de' => 'German',
    'he' => 'Hebrew',
    'no' => 'Norwegian',
    'sv' => 'Swedish',
);


foreach ($languages as $k => $v) {
    $filename = 'Secure_Quick_Reliable_Login_' . $v . '.xml';
    $contents = file($filename);

    $newFileContent = "";
    foreach($contents as $line) {
        if(substr($line, 0, 4) === '----') continue;
        $newFileContent .= $line;
    }

    file_put_contents('tmp.xml', $newFileContent);

    if($k === 'en') {
        @mkdir('values', 0777, true);
        system('php translate.php tmp.xml values/strings.xml');
    } else {
        @mkdir('values-' . $k, 0777, true);
        system('php translate.php tmp.xml values-' . $k . '/strings.xml');
    }
    @unlink('tmp.xml');
}
