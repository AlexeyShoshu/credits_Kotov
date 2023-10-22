<?php

require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';
require 'phpMailer/Exception.php';

$required_inputs = ['name' => 'Имя', 'phone' => 'Телефон', 'city' => 'Почта'];
$inputs = ['name' => 'Имя', 'phone' => 'Телефон', 'city' => 'Почта', 'amount' => 'Сумма', 'months' => 'Месяцы', 'sms' => 'СМС', 'calling' => 'Звонок'];
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

        $mail = new PHPMailer\PHPMailer\PHPMailer;
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('test@test.ru', 'Иван Иванов');
        $mail->addAddress('test@ya.ru', 'Вася Петров');
        $mail->Subject = 'subject';
        $mail->Body = $mes;

        if ($mail->send())
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
        sendTelegramMessage($telegramBotToken, $telegramChatIdMinsk, $message);
    } elseif ($city == 'Брест') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdBrest, $message);
    } elseif ($city == 'Могилев') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdMogilev, $message);
    } elseif ($city == 'Мозырь') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdMozyr, $message);
    } elseif ($city == 'Гомель') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdGomel, $message);
    } elseif ($city == 'Рогачев') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdRogacev, $message);
    } elseif ($city == 'Жлобин') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdZlobin, $message);
    } elseif ($city == 'Речица') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdRecica, $message);
    } elseif ($city == 'Светлогорск') {
        sendTelegramMessage($telegramBotToken, $telegramChatIdCvetlogorsk, $message);
    }

    exit();
}



