<form method="POST" action="../modules/payments/process_payment.php">
    <input type="hidden" name="reservation_id" value="1"> <!-- Replace with dynamic reservation ID -->
    <label>Amount: </label>
    <input type="number" name="amount" required>
    <label>Payment Method: </label>
    <select name="method">
        <option value="GCash">GCash</option>
        <option value="PayMaya">PayMaya</option>
    </select>
    <button type="submit">Pay</button>
</form>
