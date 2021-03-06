<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Situs InventarisBAK sedang dalam pengembangan">
    <title>Situs Dalam Pengembangan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'PT Sans', sans-serif;
            background-image:url("image/bg-maintenance.png");
            background-repeat:no-repeat;
            background-size:cover;
            background-position:center;
            background-attachment: fixed;
        }
        h1{
            font-weight: 700;
        }
        h4{
            font-weight: 500;
        }
        .container{
            height: 100vh;
        }
        #colbanner{
            height: 100vh;
            vertical-align: middle;
        }
        #banner{
            margin: auto;
        }
        .center {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        #banner > img {
            width: 45vw;
            min-width: 400px;
            max-width: 500px;
        }
        #banner{
            margin: 0;
            position: absolute;
            top: 50%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            text-align: center;
            width: 100%;
        }
        #teks{
            width: 450px;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        button{
            /* width: 100%; */
            margin-top: 10px;
            /* height: 40px; */
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 1px;
            background-color: #01aff3;
            border: none;
            box-shadow: 0px 4px 0px 0px #0388bd;
            color: white;
            border-radius: 25px;
            padding: 5px 30px;
            transition:transform .2s, box-shadow .2s; /* Animation */
        }
        button:hover{
            transform: scale(1.1);
        }
        button:active{
            box-shadow:none;
            transform: scale(1.1) translate(0px,4px);
        }
        @media only screen and (max-width: 768px) {
            .center {
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
                    }
            #colbanner{
                top:25%;
                height: 50vh;
            }
            #colheading{
                height: 50vh;
                display: table;
                overflow: hidden;
            }
            #banner {
                left: 50%;
                top:75%;
                position: initial;
                top: 50%;
                -ms-transform: translateY(-50%);
                transform: translateY(0);
                text-align: center;
            }
            #teks{
                width: auto;
                text-align: center;
                left:50%;
                top:50%;
                position: initial;
                top: 50%;
                -ms-transform: translateY(-50%);
                transform: translateY(0);
                display: table-cell; 
                vertical-align: middle;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
          <div class="col-md-6" id="colheading">
            <div id="teks">
                <h1><i>OOPS...</i></h1>
                <h4>Halaman Tidak Ditemukan</h4>
                <p>Sepertinya kamu tersesat...</p>
                <button onclick="location.assign('/')">Ke Halaman Utama</button>
            </div>
          </div>
          <div class="col-md-6" id="colbanner">
            <div id="banner" >
                <img src="image/bg-404.png">
            </div>
          </div>
        </div>
        </div> 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>