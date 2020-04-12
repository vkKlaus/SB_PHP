<?php
$messages = [];
$user_recepient = [];
for ($i = 1; $i <= 100; $i++) {
    $sender = rand(1, 10);
    $messages[] =
        [
            'title' => $i . ' - Заголовок',
            'text' => $i . ' - Какой то очень умный текст',
            'user_id_sender' => $sender,
            'section_id' => rand(1, 10)
        ];

    $msg = [];
    for ($j = 1; $j <= rand(1, 5); $j++) {

        $rec = rand(1, 10);

        while ($sender == $rec || in_array($rec, $msg)) {
            $rec = rand(1, 10);
        }

        $msg[] = $rec;
        $user_recepient[] = [
            'message_id' => $i,
            'recipient_user_id' => $rec,
            'sender' => $sender,
        ];
    }
}
