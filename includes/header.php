<?php

include 'connection.php';

$description = isset($description) ? $description : "Welcome to The Keys Car Rental. We offer a wide selection of vehicles for rent. Book your car today!";

$base_title = "The Keys Car Rental";

$title = isset($title_suffix) ? $base_title .= " | " . $title_suffix : $title;

$page_lookup = [
    "about" => "../",
    "book-now" => "../",
    "confirmation" => "../",
    "contact" => "../",
    "faq" => "../",
];
$swal_load_lookup = [
    "index" => 1,
    "book-now" => 1,
    "contact" => 1,
];
$flatpick_load_lookup = [
    "index" => 1,
    "book-now" => 1,
];

$style_prefix = $page_lookup[$page] ?? "";
$canonical_dir = $page === "index" ? "" : $page . "/";
$canonical_url = "https://www.keyscarrentalantigua.com/{$canonical_dir}";
$load_swal = !!$swal_load_lookup[$page];
$load_flatpick = !!$flatpick_load_lookup[$page];

?>

<!DOCTYPE html>
<html>

<head>
    <?php if ($prod) { ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-E980Y9SHKD"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-E980Y9SHKD');
        </script>
        <!-- Google Tag Manager -->
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-KKX5JN65');
        </script>
        <!-- End Google Tag Manager -->
    <?php } ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">

    <!-- SEO BEGIN -->
    <meta name="keywords" content="antigua car rental, affordable car rentals, car hire, vehicle rental, antigua rent a car, rent a car, car rental near me, airport car rental, luxury car hire, cheap car rental, car booking, st. john's, online car rental, city car rental, car rental services, weekend car rental, business car hire, caribbean rentals, antigua, antigua and barbuda, antigua rentals">
    <meta name="description" content="<?php echo $description ?>">
    <meta property="og:title" content="<?php echo $base_title ?>">
    <meta property="og:description" content="<?php echo $description; ?>">
    <meta property="og:type" content="Website">
    <meta property="og:image" content="https://www.keyscarrentalantigua.com/assets/images/logo.avif">
    <meta property="og:url" content="<?php echo $canonical_url; ?>">
    <link rel="canonical" href="<?php echo $canonical_url; ?>" />
    <!-- SEO END -->

    <!-- favicon begin -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/images/favicon/site.webmanifest">
    <!-- favicon end -->
    <title><?php echo $title ?></title>
    <link type="text/css" rel="stylesheet" href="/styles/min/main.min.css">
    <?php if (isset($page) && file_exists("{$style_prefix}styles/min/{$page}.min.css")) { ?>
        <link type="text/css" rel="stylesheet" href="/styles/min/<?php echo $page ?>.min.css">
    <?php }
    if (isset($extra_css)) { ?>
        <link type="text/css" rel="stylesheet" href="/styles/min/<?php echo $extra_css ?>.min.css">
    <?php } ?>

    <!-- BEGIN FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- END PLUGINS -->

    <!-- BEGIN PLUGINS -->
    <script src="/plugins/jquery/jquery-3.7.1.min.js" defer></script>
    <?php if ($load_swal) { ?>
        <link type="text/css" rel="stylesheet" href="/plugins/sweetalert2/styles/sweetalert2.min.css">
        <script src="/plugins/sweetalert2/js/sweetalert2.all.min.js" defer></script>
    <?php } ?>
    <?php if ($load_flatpick) { ?>
        <link type="text/css" rel="stylesheet" href="/plugins/flatpickr/styles/flatpickr.min.css">
        <link type="text/css" rel="stylesheet" href="/plugins/flatpickr/styles/theme.min.css">
        <script src="/plugins/flatpickr/js/flatpickr.v4.6.13.min.js" defer></script>
    <?php } ?>
    <!-- END PLUGINS -->

    <script src="/js/main.min.js" defer></script>
</head>

<body id="<?php echo $page ?>-page">

    <?php if ($prod) { ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KKX5JN65" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    <?php } ?>

    <div class="overlay"></div>

    <header>
        <div class="inner">

            <a href="/">
                <img src="/assets/images/logo.avif" alt="Website logo">
            </a>

            <nav>
                <a href="/">Home</a>
                <a href="/book-now/">Book Now</a>
                <a href="/about/">About</a>
                <a href="/faq/">FAQ</a>
                <a href="/contact/">Contact</a>
            </nav>

            <div id="hamburger-button">
                <div id="hamburger-icon">
                    <div class="hamburger-line"></div>
                    <div class="hamburger-line"></div>
                    <div class="hamburger-line"></div>
                </div>
            </div>

            <div id="hamburger-nav">
                <svg id="close-hamburger" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
                <nav>
                    <a href="/">Home</a>
                    <a href="/book-now/">Book Now</a>
                    <a href="/about/">About</a>
                    <a href="/faq/">FAQ</a>
                    <a href="/contact/">Contact</a>
                </nav>
            </div>

        </div>
    </header>