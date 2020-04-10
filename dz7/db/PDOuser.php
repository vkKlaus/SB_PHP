<?php 
 $users = [];
 for ($i = 1; $i < 10; $i++) {
     $users[] = [
         'user' => 'us' . $i * 10,
         'email' => 'us' . $i . '@' . $i . '.dz7',
         'phone' => '' . $i . $i . $i . ' - ' . $i . $i . ' - ' . $i . $i,
         'password' => password_hash('' . $i . $i . $i, PASSWORD_BCRYPT),
         'flag_email_notification' => true,
         'flag_active' => 0,
     ];
    }