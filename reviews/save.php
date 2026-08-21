<?php

header('Content-Type: application/json; charset=utf-8');
require($_SERVER['DOCUMENT_ROOT'] . "/database.php");

/*
|--------------------------------------------------------------------------
| DB
|--------------------------------------------------------------------------
*/

$hash = isset($_POST['hash'])
    ? trim($_POST['hash'])
    : '';


$manager_rating = isset($_POST['manager_rating'])
    ? (int)$_POST['manager_rating']
    : 0;


$product_rating = isset($_POST['product_rating'])
    ? (int)$_POST['product_rating']
    : 0;


$delivery_rating = isset($_POST['delivery_rating'])
    ? (int)$_POST['delivery_rating']
    : 0;


$comment = isset($_POST['comment'])
    ? trim($_POST['comment'])
    : '';


$name = isset($_POST['name'])
    ? trim($_POST['name'])
    : '';


$phone = isset($_POST['phone'])
    ? trim($_POST['phone'])
    : '';



/*
|--------------------------------------------------------------------------
| VALIDATION
|--------------------------------------------------------------------------
*/

if ($hash == '') {

    echo json_encode([
        'status' => 'error',
        'message' => 'Невірне посилання'
    ]);

    exit;
}


if (
    $manager_rating < 1 ||
    $manager_rating > 5 ||

    $product_rating < 1 ||
    $product_rating > 5 ||

    $delivery_rating < 1 ||
    $delivery_rating > 5
) {

    echo json_encode([
        'status' => 'error',
        'message' => 'Необхідно поставити всі три оцінки'
    ]);

    exit;
}



/*
|--------------------------------------------------------------------------
| CHECK EXISTING REVIEW
|--------------------------------------------------------------------------
*/

$stmt = $db->prepare("
    SELECT ID
    FROM order_reviews
    WHERE hash = ?
    LIMIT 1
");


$stmt->bind_param(
    's',
    $hash
);


$stmt->execute();


$result = $stmt->get_result();


if ($result->num_rows > 0) {

    echo json_encode([
        'status' => 'already'
    ]);

    exit;
}


$stmt->close();



/*
|--------------------------------------------------------------------------
| CLIENT INFO
|--------------------------------------------------------------------------
*/

$ip = isset($_SERVER['REMOTE_ADDR'])
    ? $_SERVER['REMOTE_ADDR']
    : '';


$user_agent = isset($_SERVER['HTTP_USER_AGENT'])
    ? mb_substr($_SERVER['HTTP_USER_AGENT'], 0, 500)
    : '';



/*
|--------------------------------------------------------------------------
| ORDER ID
|--------------------------------------------------------------------------
|
| Якщо hash зберігається в таблиці замовлень,
| тут можна автоматично знайти ID замовлення.
|
| Поки ставимо NULL.
|
*/

$order_id = null;



/*
|--------------------------------------------------------------------------
| INSERT REVIEW
|--------------------------------------------------------------------------
*/

$stmt = $db->prepare("

    INSERT INTO order_reviews
    (
        order_id,
        hash,

        manager_rating,
        product_rating,
        delivery_rating,

        comment,
        name,
        phone,

        ip,
        user_agent,

        created_at
    )

    VALUES
    (
        ?,
        ?,

        ?,
        ?,
        ?,

        ?,
        ?,
        ?,

        ?,
        ?,

        NOW()
    )

");


$stmt->bind_param(
    'isiiisssss',

    $order_id,
    $hash,

    $manager_rating,
    $product_rating,
    $delivery_rating,

    $comment,
    $name,
    $phone,

    $ip,
    $user_agent
);



if (!$stmt->execute()) {

    /*
     * Duplicate hash
     */

    if ($db->errno == 1062 || $stmt->errno == 1062) {

        echo json_encode([
            'status' => 'already'
        ]);

        exit;
    }


    echo json_encode([
        'status' => 'error',
        'message' => 'Не вдалося зберегти оцінку'
    ]);

    exit;
}



echo json_encode([
    'status' => 'success'
]);