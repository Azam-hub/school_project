<?php
require "_config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="fontawesome_icon/css/all.min.css">

    <link rel="stylesheet" href="css/_utils.css">
    <link rel="stylesheet" href="css/_header-footer.css">
    <link rel="stylesheet" href="css/news-and-events.css">
    <link rel="shortcut icon" href="src/logo.png" type="image/x-icon">
    
    <link rel="stylesheet" href="tiny_slider/tiny_slider.min.css">
    <title>News and Events - Shaheen Children Academy</title>
</head>
<body>
<div class="head-main-container">
    <?php include "_header.php"; ?>
    <!-- <?php echo $msg; ?> -->
    <section>
        <div class="head-part">
            <h1 class="main-head">News and Events</h1>
            <div class="search-div">
                <label for="search">Search Event and News</label>
                <i class="icon fa-solid fa-magnifying-glass"></i>
                <input type="text" id="search" placeholder="Search...">
            </div>
        </div>
        <div class="event-link">
            
        </div>
    </section>
    <?php include "_footer.php"; ?>
</div>
</body>
<!-- Fontawesome Link -->
<script src="https://kit.fontawesome.com/0d21e1944b.js" crossorigin="anonymous"></script>
<!-- Ionicon Link -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- jQuery Link -->
<script src="jquery/jquery-3.6.1.min.js"></script>

<script src="swiper/swiper-bundle.min.js"></script>
<script>
    function load_events() {
        $.ajax({
            url: 'processor/news-and-events-fetcher.php',
            type: "POST",
            data: {
                action: 'load'
            },
            success: function (data) {
                
                if (data != 0) {
                    $('.event-link').html(data)
                    
                    // var scriptTag = document.createElement("script");
                    // scriptTag.innerHTML = script;
                    // scriptTag.addClass(script);
                    // $(".head-main-container").append(scriptTag);
                    // $('.head-main-container').append(script)

                } else {
                    $('.event-link').html("No events yet!")
                }
            }
        })
    }
    load_events()
    $('#search').keyup(function () {
        var search_query = $('#search').val()

        if (search_query == "") {
            load_events()
        } else {
            $.ajax({
                url: 'processor/news-and-events-fetcher.php',
                type: "POST",
                data: {
                    action: 'search',
                    query: search_query
                },
                success: function (data) {
                    if (data != 0) {
                        $('.event-link').html(data)
                    } else {
                        $('.event-link').html("No news or event found!")
                    }
                }
            })
        }
        
        
    })
 
    $(document).on('click', '#load-more', function (e) {

        e.preventDefault()
        var last_id = $('#load-more').data('last-id')

        $.ajax({
            url: 'processor/news-and-events-fetcher.php',
            type: "POST",
            data: {
                action: 'load-more',
                last_id: last_id
            },
            success: function (data) {
                // console.log(data);
                var new_data = JSON.parse(data)
                // console.log(new_data[0]);
                if (data != 0) {
                    $('.event-link .events').append(new_data[0])
                    $('.event-link').append(new_data[1])
                } else {
                    $('.event-link').append(`<p style="text-align: center; margin-top: 28px;">No more events yet!</p>`)
                }
            }
        })
        $(this).parent().remove()
    })

</script>

<script src="tiny_slider/tiny_slider.min.js"></script>
<script>
    var sliders = Array.from(document.querySelectorAll(".my-slider"));
    console.log(sliders);
    sliders.forEach((element) => {
        console.log(element);
        let slider = tns({
            container: element,
            autoplay : true,
            speed : 500,
            autoplayTimeout: 2000,

            // Buttons
            controls : false,
            nav : false,
            autoplayButtonOutput : false
        });
    });
</script>
</html>