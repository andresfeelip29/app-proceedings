<?php
require_once('../app/config/config.php');

class ActivatedAccountViews
{
    public static function ActivationSuccess()
    {
        echo '<!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Document</title>
                <link
                    href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap"
                    rel="stylesheet"
                />
        
                <link
                    rel="stylesheet"
                    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
                />
                <link rel="stylesheet" href="../assets/css/style.css" />
            </head>
            <body>
                <div class="container-fluid bg-light h-75">
                    <div class="container mt-5 shadow-lg p-3 mb-5 bg-body rounded">
                        <div class="d-flex justify-content-center">
                            <img src="../assets/img/confim1.jpg" alt="confirmacio_img" />
                        </div>
                        <div class="d-flex justify-content-center">
                            <h5>Usuario activado con exito!</h5>
                        </div>
                    </div>
                </div>
                <script>
                    setTimeout(function () {
                        window.location.href =' . URL . '"index.php";
                    }, 4000);
                </script>
            </body>
        </html>';
    }

    public static function ActivationeError()
    {
        echo '<!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <title>Document</title>
                <link
                    href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap"
                    rel="stylesheet"
                />
        
                <link
                    rel="stylesheet"
                    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
                />
                <link rel="stylesheet" href="../assets/css/style.css" />
            </head>
            <body>
                <div class="container-fluid bg-light h-75">
                    <div class="container mt-5 shadow-lg p-3 mb-5 bg-body rounded">
                        <div class="d-flex justify-content-center">
                            <img src="../assets/img/error1.jpg" alt="confirmacio_img" />
                        </div>
                        <div class="d-flex justify-content-center">
                            <h5>No se pudo activar usuario!</h5>
                        </div>
                    </div>
                </div>
                <script>
                    setTimeout(function () {
                        window.location.href =' . URL . '"index.php";
                    }, 4000);
                </script>
            </body>
        </html>';
    }
}
