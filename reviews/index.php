<?php

$hash = isset($_GET['hash']) ? trim($_GET['hash']) : '';

if ($hash == '') {
    http_response_code(404);
    die('Невірне посилання');
}

?>
<!DOCTYPE html>
<html lang="uk">

<head>

    <meta charset="utf-8">

    <title>Оцініть ваше замовлення — Флорен</title>

    <meta name="description" content="Допоможіть нам стати кращими">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="./reviews_styles.css?1">

</head>

<body>

<div class="header">

    <a href="https://floren.com.ua/">
        <img src="/img/main-logo.svg" alt="Флорен" class="logo">
    </a>

</div>


<div class="form-container">

    <div class="form-container_text">

        <h1>Дякуємо за ваше замовлення!</h1>

        <p>
            Нам важливо знати, чи залишилися ви задоволені роботою команди
            «Флорен».
        </p>

        <p>
            Будь ласка, оцініть ваше замовлення — це займе менше хвилини
            та допоможе нам покращувати сервіс.
        </p>

    </div>


    <form id="review-form">

        <input
            type="hidden"
            name="hash"
            value="<?=htmlspecialchars($hash, ENT_QUOTES, 'UTF-8')?>"
        >


        <!-- MANAGER -->

        <div class="rating-block">

            <p class="rating-title">
                Оцініть роботу менеджера
            </p>

            <div class="stars">

                <input
                    type="radio"
                    id="manager-5"
                    name="manager_rating"
                    value="5"
                >
                <label for="manager-5">★</label>

                <input
                    type="radio"
                    id="manager-4"
                    name="manager_rating"
                    value="4"
                >
                <label for="manager-4">★</label>

                <input
                    type="radio"
                    id="manager-3"
                    name="manager_rating"
                    value="3"
                >
                <label for="manager-3">★</label>

                <input
                    type="radio"
                    id="manager-2"
                    name="manager_rating"
                    value="2"
                >
                <label for="manager-2">★</label>

                <input
                    type="radio"
                    id="manager-1"
                    name="manager_rating"
                    value="1"
                >
                <label for="manager-1">★</label>

            </div>

            <div class="rating-text"></div>

        </div>



        <!-- PRODUCT -->

        <div class="rating-block">

            <p class="rating-title">
                Оцініть якість товару
            </p>

            <div class="stars">

                <input
                    type="radio"
                    id="product-5"
                    name="product_rating"
                    value="5"
                >
                <label for="product-5">★</label>

                <input
                    type="radio"
                    id="product-4"
                    name="product_rating"
                    value="4"
                >
                <label for="product-4">★</label>

                <input
                    type="radio"
                    id="product-3"
                    name="product_rating"
                    value="3"
                >
                <label for="product-3">★</label>

                <input
                    type="radio"
                    id="product-2"
                    name="product_rating"
                    value="2"
                >
                <label for="product-2">★</label>

                <input
                    type="radio"
                    id="product-1"
                    name="product_rating"
                    value="1"
                >
                <label for="product-1">★</label>

            </div>

            <div class="rating-text"></div>

        </div>



        <!-- DELIVERY -->

        <div class="rating-block">

            <p class="rating-title">
                Оцініть якість доставки
            </p>

            <div class="stars">

                <input
                    type="radio"
                    id="delivery-5"
                    name="delivery_rating"
                    value="5"
                >
                <label for="delivery-5">★</label>

                <input
                    type="radio"
                    id="delivery-4"
                    name="delivery_rating"
                    value="4"
                >
                <label for="delivery-4">★</label>

                <input
                    type="radio"
                    id="delivery-3"
                    name="delivery_rating"
                    value="3"
                >
                <label for="delivery-3">★</label>

                <input
                    type="radio"
                    id="delivery-2"
                    name="delivery_rating"
                    value="2"
                >
                <label for="delivery-2">★</label>

                <input
                    type="radio"
                    id="delivery-1"
                    name="delivery_rating"
                    value="1"
                >
                <label for="delivery-1">★</label>

            </div>

            <div class="rating-text"></div>

        </div>



        <div id="form-error" class="error"></div>


        <div class="comment-block">

            <p class="rating-title">
                Бажаєте щось додати?
            </p>

            <textarea
                name="comment"
                rows="6"
                placeholder="Ваш коментар (за бажанням)"
            ></textarea>

            <input
                type="text"
                name="name"
                placeholder="Ім'я (за бажанням)"
            >

            <input
                type="tel"
                name="phone"
                placeholder="Телефон (за бажанням)"
            >

        </div>


        <button type="submit" class="fsubmit">
            Надіслати оцінку
        </button>

    </form>


    <div id="response-success">

        <div class="success-icon">
            ✓
        </div>

        <h2>Дякуємо!</h2>

        <p>
            Вашу оцінку отримано.
        </p>

        <p>
            Дякуємо, що допомагаєте нам ставати кращими.
        </p>

    </div>


    <div id="response-retry">

        <h2>Дякуємо!</h2>

        <p>
            Ви вже залишали оцінку для цього замовлення.
        </p>

    </div>

</div>


<script>

const ratingTitles = {
    1: 'Дуже погано',
    2: 'Погано',
    3: 'Нормально',
    4: 'Добре',
    5: 'Відмінно'
};


document.querySelectorAll('.rating-block').forEach(function(block) {

    const radios = block.querySelectorAll('input[type=radio]');
    const text = block.querySelector('.rating-text');

    radios.forEach(function(radio) {

        radio.addEventListener('change', function() {

            text.textContent = ratingTitles[this.value];

        });

    });

});


document
    .getElementById('review-form')
    .addEventListener('submit', function(e) {

        e.preventDefault();

        const form = this;

        const error = document.getElementById('form-error');

        error.textContent = '';


        const manager = form.querySelector(
            'input[name="manager_rating"]:checked'
        );

        const product = form.querySelector(
            'input[name="product_rating"]:checked'
        );

        const delivery = form.querySelector(
            'input[name="delivery_rating"]:checked'
        );


        if (!manager || !product || !delivery) {

            error.textContent =
                'Будь ласка, поставте всі три оцінки.';

            return;

        }


        const button = form.querySelector('.fsubmit');

        button.disabled = true;
        button.textContent = 'Надсилаємо...';


        fetch('./save.php', {

            method: 'POST',

            body: new FormData(form)

        })

        .then(function(response) {

            return response.json();

        })

        .then(function(data) {

            if (data.status === 'success') {

                form.style.display = 'none';

                document.getElementById(
                    'response-success'
                ).style.display = 'block';

                return;

            }


            if (data.status === 'already') {

                form.style.display = 'none';

                document.getElementById(
                    'response-retry'
                ).style.display = 'block';

                return;

            }


            error.textContent =
                data.message || 'Сталася помилка. Спробуйте ще раз.';

            button.disabled = false;
            button.textContent = 'Надіслати оцінку';

        })

        .catch(function() {

            error.textContent =
                'Сталася помилка. Спробуйте ще раз.';

            button.disabled = false;
            button.textContent = 'Надіслати оцінку';

        });

    });

</script>


</body>
</html>