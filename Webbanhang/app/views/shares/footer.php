<?php
$currentUrl = $_SERVER['REQUEST_URI'];
$isAuthPage = strpos($currentUrl, '/account/login') !== false 
           || strpos($currentUrl, '/account/register') !== false
           || strpos($currentUrl, '/account/forgot-password') !== false;
?>

<?php if (!$isAuthPage): ?>
</div> <!-- Đóng container -->

<!-- Script -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php endif; ?>
