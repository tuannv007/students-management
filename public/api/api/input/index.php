<?php

echo json_encode([
    'code' => 200,
    'message' => '',
    'data' => [
        'departments' => db_get_all('departments'),
        'school_years' => db_get_all('school_years'),
        'fees' => db_get_all('fees'),
    ]
]);
