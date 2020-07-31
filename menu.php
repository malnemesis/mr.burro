<?php include 'php/head.php' ?>

<body>

    <?php include 'php/loader.php' ?>

    <?php include 'php/sidebar.php' ?>

    <div class="wrapper">


        <?php include 'php/header.php' ?>

        <div class="container">

            <div class="subtitle h6" onclick="remove_class()">
                <div class="d-inline-block">
                    <i class="material-icons">search</i> <br>
                </div>
            </div>

            <input type="text" class="form-control form-control-lg search my-3" placeholder="Buscar..." name="busqueda"
                id="busqueda">

            <div id="resultado">
            </div>



        </div>

        <?php include 'php/footer.php'?>


    </div>



    <!-- jquery, popper and bootstrap js -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap-4.3.1/js/bootstrap.min.js"></script>

    <!-- swiper js -->
    <script src="vendor/swiper/js/swiper.min.js"></script>

    <!-- nouislider js -->
    <script src="vendor/nouislider/nouislider.min.js"></script>

    <!-- chosen multiselect js -->
    <script src="vendor/chosen_v1.8.7/chosen.jquery.min.js"></script>

    <!-- template custom js -->
    <script src="js/main.js"></script>

    <!-- page level script -->
    <script>
    $(window).on('load', function() {
        var swiper = new Swiper('.small-slide', {
            slidesPerView: 'auto',
            spaceBetween: 0,
        });

        var swiper = new Swiper('.news-slide', {
            slidesPerView: 5,
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination',
            },
            breakpoints: {
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 0,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 0,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 0,
                },
                320: {
                    slidesPerView: 2,
                    spaceBetween: 0,
                }
            }
        });


        /* chosen select*/
        $(".chosen").chosen()

        /* notification view and hide */
        setTimeout(function() {
            $('.notification').addClass('active');
            setTimeout(function() {
                $('.notification').removeClass('active');
            }, 2000);
        }, 1000);
        $('.closenotification').on('click', function() {
            $(this).closest('.notification').removeClass('active')
        });


    });
    </script>
</body>



</html>