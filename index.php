<?php

include './Car.php';
$tesla = new Car();

$benzine = $km = "";
$benzine_err = $km_err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $input_name = trim($_POST["benzine"]);
    if (empty($input_name)) {
        $benzine_err = "Iltimos benzinni kiriting.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_INT)) {
        $benzine_err = "Faqat son bo'lishi kerak.";
    } else {
        $benzine = $input_name;
    }

    $input_address = trim($_POST["km"]);
    if (empty($input_address)) {
        $km_err = "Iltimos km'ni kiriting.";
    } elseif (!filter_var($input_address, FILTER_VALIDATE_INT)) {
        $km_err = "Faqat son bo'lishi kerak.";
    } else {
        $km = $input_address;
    }

    if (!empty($benzine && $km)) {
        $data = [
            'benzine' => $tesla->addBenzine((int)$benzine),
            'km'      => $km,
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Benzin quyish</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container content">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Benzin quyish</h2>
                <p>Iltimos formani to'ldiring.</p>
                <form method="post">
                    <div class="form-group">
                        <label for="benzine">Benzin</label>
                        <input type="number" name="benzine" placeholder="<?= $benzine_err ?>"
                               class="form-control <?= (!empty($benzine_err)) ? 'is-invalid' : '' ?>"
                               value="<?= $benzine ?>" id="benzine" min="0" max="200">
                        <span class="invalid-feedback"><?= $benzine_err ?></span>
                    </div>
                    <div class="form-group">
                        <label for="km">Km</label>
                        <input type="number" name="km" placeholder="<?= $km_err ?>"
                               class="form-control <?= (!empty($km_err)) ? 'is-invalid' : '' ?>"
                               value="<?= $km ?>" id="km" min="0" max="500">
                        <span class="invalid-feedback"><?= $km_err ?></span>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Tayyor</button>
                    <a href="/" class="btn btn-outline-secondary">Bekor qilish</a>
                </form>
                <br>
                <div content="col-md-10">
                    <?php
                    if (isset($data)) {
                        if ($data['km'] > 0 && $data['benzine'] > 0) {
                            echo 'Siz mashinaga ' . $data['benzine'] . 'litr quydingiz. Endi siz ' . $data['benzine'] * $tesla::DEFAULT_BENZINE . 'km yura olasiz.<br>
                               ' . $data['km'] . ' km kiritdingiz<br>';
                            $tesla->drive($data['km']);
                            echo "<br>" . $tesla->showBenzine();
                        } else {
                            echo 'Manfiy son mumkin emas!';
                        }
                        exit();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
