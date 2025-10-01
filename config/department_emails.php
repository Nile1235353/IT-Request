<?php

// config/department_emails.php

return [
    /* Department ကို ရှာမတွေ့ရင် ပို့မယ့် default email address */
    'default_receiver' => env('MAIL_ADMIN_ADDRESS', 'programmermyanmar9960@gmail.com'),

    /* Department အလိုက် သက်ဆိုင်ရာ Receiver Email များကို သတ်မှတ်ခြင်း */
    /* Yangon */
    'mapping' => [
        'AHR'              => 'mmon@rgldryport.com', // AHR ရဲ့ receiver
        'BD'               => 'yphyoe@rgldryport.com',    // BD ရဲ့ receiver
        'Brand'            => 'zehtet@rgldryport.com', // Brand ရဲ့ receiver 
        'CCA'              => 'kmpaing@rgldryport.com', // CCA ရဲ့ receiver
        'Commercial'       => 'hwycho@rgldryport.com', // Commercial ရဲ့ receiver
        'Coporate'         => 'kslinn@rgldryport.com', // Coporate ရဲ့ receiver
        'CS'               => 'khzaw@rgldryport.com', // CS ရဲ့ receiver
        'Finance'          => 'nnhtut@rgldryport.com', // F&A ရဲ့ receiver
        'ICD'              => 'kkko@rgldryport.com', // ICD ရဲ့ receiver
        'IT'               => 'ppnyein@rgldryport.com', // IT ရဲ့ receiver
        'IT & Process'     => 'ytg.datacenter1@rgldryport.com', // IT & Process ရဲ့ receiver
        'Data Center'      => 'ytg.datacenter1@rgldryport.com', // Data Center ရဲ့ receiver
        'M&E'              => 'MnE@rgldryport.com', // M&E ရဲ့ receiver
        'M&R'              => 'MnR@rgldryport.com', // M&R ရဲ့ receiver
        'Operation'        => 'equipmentsupervisor@rgldryport.com', // Operation ရဲ့ receiver
        'Yard & Rail'      => 'ppaung@rgldryport.com', // Yard & Rail ရဲ့ receiver
        'Process'          => 'kkkthet@rgldryport.com', // Process ရဲ့ receiver
        'QEHS'             => 'ssoo@rgldryport.com', // QEHS ရဲ့ receiver
        'Truck'            => 'atkyaw@rgldryport.com', // Truck ရဲ့ receiver
        // သင့်မှာရှိတဲ့ Department တွေနဲ့ သက်ဆိုင်ရာ Email များကို ဒီမှာ ထပ်ထည့်နိုင်ပါသည်
    ],

    /* Mandalay */
    'mandalay_mapping' => [
        'AHR'              => 'mmon@rgldryport.com', // AHR ရဲ့ receiver
        'BD'               => 'yphyoe@rgldryport.com',    // BD ရဲ့ receiver
        'Brand'            => 'zehtet@rgldryport.com', // Brand ရဲ့ receiver 
        'CCA'              => 'kmpaing@rgldryport.com', // CCA ရဲ့ receiver
        'Commercial'       => 'hwycho@rgldryport.com', // Commercial ရဲ့ receiver
        'Coporate'         => 'kslinn@rgldryport.com', // Coporate ရဲ့ receiver
        'CS'               => 'khzaw@rgldryport.com', // CS ရဲ့ receiver
        'Finance'          => 'nnhtut@rgldryport.com', // F&A ရဲ့ receiver
        'ICD'              => 'kkko@rgldryport.com', // ICD ရဲ့ receiver
        'IT'               => 'ppnyein@rgldryport.com', // IT ရဲ့ receiver
        'IT & Process'     => 'nilenilewailiberalstudies@gmail.com', // IT & Process ရဲ့ receiver
        'Data Center'      => 'ytg.datacenter1@rgldryport.com', // Data Center ရဲ့ receiver
        'M&E'              => 'MnE@rgldryport.com', // M&E ရဲ့ receiver
        'M&R'              => 'MnR@rgldryport.com', // M&R ရဲ့ receiver
        'Operation'        => 'mn.whmanagement@rgldryport.com', // Operation ရဲ့ receiver
        'Yard & Rail'      => 'mn.yardrail@rgldryport.com', // Yard & Rail ရဲ့ receiver
        'Process'          => 'kkkthet@rgldryport.com', // Process ရဲ့ receiver
        'QEHS'             => 'ssoo@rgldryport.com', // QEHS ရဲ့ receiver
        'Truck'            => 'atkyaw@rgldryport.com', // Truck ရဲ့ receiver
        // သင့်မှာရှိတဲ့ Department တွေနဲ့ သက်ဆိုင်ရာ Email များကို ဒီမှာ ထပ်ထည့်နိုင်ပါသည်
    ],
];

?>