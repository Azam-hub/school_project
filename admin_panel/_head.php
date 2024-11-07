<div class="head">
    <div class="menu">
        <!-- <div class="inner-menu"> -->
            <span class="lines first-line"></span>
            <span class="lines second-line"></span>
            <span class="lines third-line"></span>
        <!-- </div> -->
    </div>
    <div class="left">
        <img src="src/static_images/logo.png" alt="Logo">
        <h2>Shaheen Children Academy</h2>
    </div>
    <div class="right">
        <a href="logout.php">Logout</a>
    </div>
</div>

<script src="jquery/jquery-3.6.1.min.js"></script>
<script>
    $('.menu').click(function () {
        $('.sidebar').toggle()
    })

    $('.sidebar i').click(function () {
        $('.sidebar').hide()
    })
</script>