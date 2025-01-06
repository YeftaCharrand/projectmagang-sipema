<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEMA</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background: linear-gradient(135deg, #f0f8ff 0%, #e6f2ff 100%);
        }

        header {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 3%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 2.75rem;
            margin-right: 1rem;
        }

        .logo span {
            font-size: 1.2rem;
            font-weight: 700;
            color: #292a2b;
        }

        main {
            padding-top: 5rem;
        }

        .hero {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem 5%;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .hero-content {
            flex: 1;
            min-width: 300px;
            margin-right: 2rem;
        }

        .hero-image {
            flex: 1;
            min-width: 200px;
            max-width: 450px;
        }

        .hero-image img {
            width: 85%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .hero-image img:hover {
            transform: scale(1.05);
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: #153558;
        }

        p {
            margin-bottom: 1.2rem;
            color: #333;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #0056b3;
            color: white;
        }

        .btn-secondary {
            background-color: #ffffff;
            color: #0056b3;
            border: 2px solid #0056b3;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
            }

            .hero-content, .hero-image {
                min-width: 100%;
                margin-right: 0;
                margin-bottom: 2rem;
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="img/PNC.jpg" alt="PNC Logo">
                <span>POLITEKNIK NEGERI CILACAP</span>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>SIPEMA<br>Sistem Informasi Pendataan Mahasiswa</h1>
                <p>
                    SIPEMA adalah platform web untuk mempermudah pengolahan dan manajemen data mahasiswa di Politeknik Negeri Cilacap. 
                    Dengan antarmuka yang user-friendly dan teknologi terkini, SIPEMA bertujuan meningkatkan efisiensi dan akurasi dalam pengelolaan data mahasiswa serta memberikan pengalaman yang lebih baik bagi penggunanya.
                </p>
                <div class="cta-buttons">
                    <button onclick="window.location='{{ route('login') }}'" class="btn btn-primary">Login</button>
                    {{-- <button onclick="window.location='{{ route('register') }}'" class="btn btn-secondary">Register</button> --}}
                </div>
            </div>
            <div class="hero-image">
                <img src="img/mahasiswa.jpg" alt="hero image">
            </div>
        </section>
    </main>

    <script>
        // Tambahkan animasi sederhana saat scroll
        window.addEventListener('scroll', function() {
            const heroContent = document.querySelector('.hero-content');
            const heroImage = document.querySelector('.hero-image');
            const scrollPosition = window.scrollY;

            if (scrollPosition > 100) {
                heroContent.style.opacity = '0.8';
                heroImage.style.opacity = '0.8';
            } else {
                heroContent.style.opacity = '1';
                heroImage.style.opacity = '1';
            }
        });
    </script>
</body>

</html>