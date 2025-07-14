<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locomotif Jajar</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: white;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: black;
            font-weight: bold;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 100px 50px;
        }
        .text-content {
            max-width: 50%;
        }
        .text-content h1 {
            font-size: 32px;
        }
        .text-content .highlight {
            color: #167DD3;
        }
        .btn-chat {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #E2EAF4;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            color: black;
        }
        .info-cards {
            display: flex;
            margin-top: 30px;
            gap: 20px;
        }
        .card {
            background-color: #E2EAF4;
            padding: 20px;
            border-radius: 8px;
            width: 200px;
            text-align: center;
            font-weight: bold;
        }
        .image-box {
            width: 400px;
            height: 300px;
            background-color: grey;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo"><b>Locomotif</b></div>
        <nav>
            <a href="/">Home</a>
            <a href="#">Services</a>
            <a href="#">Blog</a>
            <a href="#">Product</a>
            <a href="#">About Us</a>
        </nav>
    </header>

    <div class="container">
        <div class="text-content">
            <h1><span class="highlight">Modifikasi</span> motor anda dengan<br>
            Aman dan Terpercaya di Bengkel<br>
            <span class="highlight">Locomotif Jajar</span>.</h1>

            <a href="https://wa.me/6281234567890" class="btn-chat" target="_blank">Mulai Mengobrol</a>

            <div class="info-cards">
                <div class="card">Aman, Cepat, dan Terpercaya sejak 2005</div>
                <div class="card">Sudah menangani 1000+ motor</div>
            </div>
        </div>

        <div class="image-box">
            <!-- Nanti di sini kamu ganti dengan <img> -->
        </div>
    </div>

</body>
</html>
