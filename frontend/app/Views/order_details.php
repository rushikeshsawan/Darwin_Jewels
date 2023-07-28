  

<div class="container">
    <h2>My Orders</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Created At</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= $order['order_id'] ?></td>
                    <td><?= $order['total_price'] ?></td>
                    <td><?= $order['status'] ?></td>
                    <td><?= $order['created_at'] ?></td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

 