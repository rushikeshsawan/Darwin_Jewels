<!-- orders.php -->
<?= $this->extend('main') ?>
<?= $this->section('content') ?>

<div class="container">
    <h2>My Orders</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= $order['order_id'] ?></td>
                    <td><?= $order['total_price'] ?></td>
                    <td><?= $order['status'] ?></td>
                    <td><?= $order['created_at'] ?></td>
                    <td>
                        <a href="<?= base_url('order-details/' . $order['order_id']) ?>">View Details</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
