<?php

include './Car.php';
$tesla = new Car();
//$tesla->addBenzine(3);
//$tesla->drive(30,100);
//echo $tesla->policeDanger();
//echo "<hr><br>";
//echo $tesla->showBenzine();
//exit();

$benzin = $km = $tezlik = "";
$benzin_err = $km_err = $tezlik_err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $input_name = trim($_POST["benzine"]);
    if (empty($input_name)) {
        $benzin_err = "Iltimos benzinni kiriting.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_INT)) {
        $benzin_err = "Faqat son bo'lishi kerak.";
    } else {
        $benzin = $input_name;
    }

    $input_address = trim($_POST["km"]);
    if (empty($input_address)) {
        $km_err = "Iltimos km'ni kiriting.";
    } elseif (!filter_var($input_address, FILTER_VALIDATE_INT)) {
        $km_err = "Faqat son bo'lishi kerak.";
    } else {
        $km = $input_address;
    }

    $input_salary = trim($_POST["speed"]);
    if (empty($input_salary)) {
        $tezlik_err = "Iltimos tezlikni kiriting.";
    } elseif (!filter_var($input_salary, FILTER_VALIDATE_INT)) {
        $tezlik_err = "Faqat son bo'lishi kerak.";
    } else {
        $tezlik = $input_salary;
    }

    if (!empty($benzin && $km && $tezlik)) {
        $data = [
            'benzin' => $tesla->addBenzine((int)$benzin),
            'km' => $km,
            'tezlik' => $tezlik
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
                        <input type="text" name="benzine" placeholder="<?= $benzin_err ?>"
                               class="form-control <?= (!empty($benzin_err)) ? 'is-invalid' : '' ?>"
                               value="<?= $benzin ?>" id="benzine">
                        <span class="invalid-feedback"><?= $benzin_err ?></span>
                    </div>
                    <div class="form-group">
                        <label for="km">Km</label>
                        <input type="text" name="km" placeholder="<?= $km_err ?>"
                               class="form-control <?= (!empty($km_err)) ? 'is-invalid' : '' ?>"
                               value="<?= $km ?>" id="km">
                        <span class="invalid-feedback"><?= $km_err ?></span>
                    </div>
                    <div class="form-group">
                        <label for="speed">Tezlik</label>
                        <input type="text" name="speed" placeholder="<?= $tezlik_err ?>"
                               class="form-control <?= (!empty($tezlik_err)) ? 'is-invalid' : '' ?>"
                               value="<?= $tezlik ?>" id="speed">
                        <span class="invalid-feedback"><?= $tezlik_err ?></span>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Tayyor</button>
                    <a href="javascript:history.back()" class="btn btn-outline-secondary">Bekor qilish</a>
                </form>
                <br>
                <div content="col-md-10">
                    <?php
                    if (isset($data)) {
                        echo 'Siz mashinaga ' . $data['benzin'] . 'litr quydingiz. Endi siz ' . $data['benzin'] * $tesla::DEFAULT_BENZINE .'km yura olasiz.<br>
                               '.$data['km'].' km kiritdingiz va ' . $data['tezlik']. 'km/s tezlikda yurishni kirtingiz<br>';
                        echo $tesla->drive((int)$data['km'],(int)$data['tezlik']);
                        echo "<br>". $tesla->showBenzine();

                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
