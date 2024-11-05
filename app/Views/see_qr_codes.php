<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>See QR Codes</title>
    <style>
        .qr-codes {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .qr-code {
            width: 30%; 
            margin: 10px; 
            text-align: center; 
            box-sizing: border-box;
        }
        img {
            width: 100%; 
            height: auto; 
        }
    </style>
</head>
<body>
    <h1>Table QR Codes</h1>
    <div class="qr-codes">
        <?php foreach ($tables as $table): ?>
            <div class="qr-code">
                <h4>Table <?= esc($table['table_number']) ?></h4>
                <img src="<?= esc($table['qr_code']) ?>" alt="QR Code for Table <?= esc($table['table_number']) ?>">
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

