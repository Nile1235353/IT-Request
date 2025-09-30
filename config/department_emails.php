<?php

// config/department_emails.php

return [
    /* Department ကို ရှာမတွေ့ရင် ပို့မယ့် default email address */
    'default_receiver' => env('MAIL_ADMIN_ADDRESS', 'it_admin_fallback@yourdomain.com'),

    /* Department အလိုက် သက်ဆိုင်ရာ Receiver Email များကို သတ်မှတ်ခြင်း */
    'mapping' => [
        'Warehouse'     => 'warehouse.manager@rgldryport.com', // Warehouse ရဲ့ receiver
        'IT & Process'  => 'rglscanner9@gmail.com',    // IT & Process ရဲ့ receiver
        'HR'            => 'hr.manager@rgldryport.com',         // HR ရဲ့ receiver
        // သင့်မှာရှိတဲ့ Department တွေနဲ့ သက်ဆိုင်ရာ Email များကို ဒီမှာ ထပ်ထည့်နိုင်ပါသည်
    ],
];

?>