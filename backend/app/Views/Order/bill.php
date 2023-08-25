<!DOCTYPE html>
<html lang="en">
<?php // print_r($order);die; 
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .customer-details {
            margin-bottom: 20px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .invoice-table th {
            background-color: #f5f5f5;
        }

        .total {
            text-align: right;
        }

        .total p {
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="header">
            <h1>Invoice</h1>
            <p><?= $order[0]->created_at; ?></p>
        </div>
        <div class="customer-details">
            <h2>Bill To:</h2>
            <p><?= $order[0]->username; ?></p>
            <p><?= $order[0]->address; ?></p>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order as $orderItem) : ?>
                    <tr>
                        <td><?= $orderItem->product_name; ?></td>
                        <td><?= $orderItem->quantity; ?></td>
                        <td><?= $orderItem->prize; ?></td>
                        <td><?= $orderItem->Qprice; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total">
            <?php
            $payment_id = $orderItem->payment_id;

            switch ($payment_id) {
                case "COD":
                    echo "<p>Payment Mode: COD</p>";
                    break;
                case "COD/Wallet":
                    echo "<p>Payment Mode: COD/Wallet</p>";
                    echo "Wallet :RS " . $orderItem->useWallet . "/- </br>";
                    $online = $order[0]->total_price - $orderItem->useWallet;
                    echo "COD :RS " . $online . "/-";
                    break;
                case "Wallet":
                    echo "<p>Payment Mode: Wallet</p>";
                    echo "Wallet :" . $orderItem->useWallet;
                    break;
                default:
                    if (strpos($payment_id, "/Wallet") !== false) {
                        echo "<p>Payment Mode: Wallet/Online</p>";
                        echo "Wallet :RS " . $orderItem->useWallet . "/- </br>";
                        $online = $order[0]->total_price - $orderItem->useWallet;
                        echo "Online :RS " . $online . "/-";
                    } else {
                        echo "<p>Payment Mode: Online</p>";
                    }
                    break;
            }
            ?>
            <p>Total Amount: RS <?= $order[0]->total_price; echo "/-";?></p>
            <?php
            date_default_timezone_set('Asia/Kolkata');
            echo "Invoice created:" . date('Y-m-d H:i:s');
            ?>
        </div>
    </div>
</body>

</html>