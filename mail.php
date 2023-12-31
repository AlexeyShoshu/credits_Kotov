<?php

$required_inputs = ['name' => 'Имя', 'phone' => 'Телефон', 'city' => 'Город'];
$inputs = ['name' => 'Имя', 'phone' => 'Телефон', 'city' => 'Город', 'amount' => 'Сумма', 'months' => 'Месяцы', 'sms' => 'СМС', 'calling' => 'Звонок'];
if (!empty($required_inputs)):

    $response = [];
    $required_inputs_errors = '';

    foreach ($required_inputs as $key => $val) {
        if (empty($_POST[$key])) {
            $required_inputs_errors .= $val . ', ';
        }
    }

    if ($required_inputs_errors) {
        $response[] .= "Ошибки в заполнении полей: " . trim($required_inputs_errors, ' , ');
    }

    if (empty($response)):
        $mes = '';
        foreach ($inputs as $key => $val) {
            if (!empty($_POST[$key])) {
                $mes .= $val . ": " . $_POST[$key] . "\n";
            }
        }

        $to = 'sendermail2281@gmail.com';
        $subject = 'Отправка данных';
        $headers = 'From: sendermail2281@gmail.com' . "\r\n" .
            'Reply-To: sendermail2281@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $mailSent = mail($to, $subject, $mes, $headers);

        if ($mailSent)
            echo json_encode(['status' => 'success', 'message' => "Сообщение успешно отправлено!"]);
        else
            echo json_encode(['status' => 'error', 'message' => "Ошибка, сообщение не отправлено! Возможно, проблемы на сервере"]);
    else:
        $arr['status'] = 'error';
        $arr['message'] = implode("\n", $response);
        echo json_encode($arr);
    endif;
endif;

$myaddres = "fast.zayavka@gmail.com";
$telegramBotToken = '6344190088:AAFtCK9YccuxyfJDjs961E30tUS-tJJfd_A';
$telegramChatIdMinsk = '-1001677962777';
$telegramChatIdBrest = '-1001965709834';
$telegramChatIdMogilev = '-1001975325401';
$telegramChatIdMozyr = '-1001749333342';
$telegramChatIdGomel = '-1001608423025';
$telegramChatIdRogacev = '-1001804229323';
$telegramChatIdZlobin = '-1001803277170';
$telegramChatIdRecica = '-1001821816777';
$telegramChatIdCvetlogorsk = '-1001898888152';

function sendTelegramMessage($token, $chatId, $message)
{
    $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chatId&text=" . urlencode($message);
    file_get_contents($url);
}

if (empty($name)) {
} else {
    $email = 'creditbel.info';

    if ($city == 'Минск') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdMinsk, $mes);
    } elseif ($city == 'Брест') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdBrest, $mes);
    } elseif ($city == 'Могилев') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdMogilev, $mes);
    } elseif ($city == 'Мозырь') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdMozyr, $mes);
    } elseif ($city == 'Гомель') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdGomel, $mes);
    } elseif ($city == 'Рогачев') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdRogacev, $mes);
    } elseif ($city == 'Жлобин') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdZlobin, $mes);
    } elseif ($city == 'Речица') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdRecica, $mes);
    } elseif ($city == 'Светлогорск') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdCvetlogorsk, $mes);
    }

    exit();
}



