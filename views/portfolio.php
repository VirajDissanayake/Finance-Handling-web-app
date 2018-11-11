<div class="title">
    Cash: $<?=$cash?>
</div>
<div>
    <table class="table table-striped">
        <tr>
            <th class="text-center">Symbol</th>
            <th class="text-center">Shares</th>
            <th class="text-center">Price</th>
        </tr>
        <?php foreach($positions as $position): ?>
          <tr>
            <td><?= $position["symbol"]?></td>
            <td><?= $position["shares"]?></td>
            <td><?= $position["price"]?></td>
          </tr>
        <?php endforeach?>
    </table>
</div>
<div>
    Total: $<?=$worth?><br>
    <a href="logout.php">Log Out</a>
</div>