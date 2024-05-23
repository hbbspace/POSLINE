<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>POSLINE</title>
  <!--======== custom css link =========-->
  @vite('resources/css/landing.css')
  <!--========= google font link ========-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    
   <header class="header" data-header>
        <div class="container">
            <a href="" class="logo">
                 PosLine
            </a>

            <nav class="navbar container" data-navbar>
                <ul class="navbar-list">
                    <li>
                        <a href="#" class="navbar-link" data-nav-link>Home</a>
                    </li>
                    <li>
                        <a href="#" class="navbar-link" data-nav-link>About Us</a>
                    </li>
                    <li>
                        <a href="#article" class="navbar-link" data-nav-link>Artikel</a>
                    </li>
                    <li>
                        <a href="#" class="navbar-link" data-nav-link>Contact</a>
                    </li>
                </ul>
            </nav>

            <a href="{{ url('/login') }}" class="btn btn-secondary">Login</a>
            <button class="nav-toggle-btn" aria-label="Toggle menu" data-nav-toggler>
                <ion-icon name="menu-outline" aria-hidden="true" class="menu-icon"></ion-icon>
                <ion-icon name="close-outline" aria-hidden="trur" class="close-icon"></ion-icon>

            </button>
        </div>
   </header>

   <!--======== main =========-->
   <main>
        <article class="article">
            <section class="section hero" aria-label="hero">
                <div class="container">
                    <div class="hero-bg">
                        <div class="hero-content">
                            <h1 class="h1 hero-title">
                                Kesehatan Anak Indonesia <span class="span">Harapan</span> Kami
                            </h1>

                            <p class="hero-text">
                                Rutin Lakukan Imunisasi Untuk Kesehatan si Bayi
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section about" id="about" aria-level="about">
                <div class="container">
                    <div class="about-banner img-holder" style="--width: 600; --height: 700;">
                        <img src="img/abt-banner.jpg" width="600px" height="700px" loading="lazy" alt="" class="img-cover">
                    </div>

                    <div class="about-content">
                        <h2 class="h2 section-title">Pentingnya Imunisasi Anak </h2>
                        <p class="section-text">Imunisasi merupakan langkah krusial dalam melindungi anak-anak dari penyakit berbahaya. Posyandu menyediakan program imunisasi lengkap yang sesuai dengan jadwal imunisasi nasional, memastikan bahwa setiap anak mendapatkan vaksin yang diperlukan untuk mencegah penyakit seperti campak, polio, dan difteri. Dengan mengikuti jadwal imunisasi yang direkomendasikan, orang tua dapat membantu membangun sistem kekebalan anak dan menciptakan generasi yang lebih sehat.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </section>

            <section class="section about" id="about" aria-level="about">
                <div class="container">
                    <div class="about-content">
                        <h2 class="h2 section-title">Gizi Seimbang untuk Pertumbuhan Optimal</h2>
                        <p class="section-text">Gizi yang seimbang adalah fondasi bagi pertumbuhan dan perkembangan anak. Posyandu berperan aktif dalam memberikan edukasi kepada orang tua tentang pentingnya asupan nutrisi yang lengkap, termasuk protein, karbohidrat, lemak, vitamin, dan mineral. Melalui konseling gizi dan program pemberian makanan tambahan, Posyandu mendukung pertumbuhan anak-anak agar mereka dapat mencapai potensi maksimal mereka.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>

                    <div class="about-banner img-holder" style="--width: 600; --height: 700;">
                        <img src="img/abt-banner.jpg" width="300px" height="400px" loading="lazy" alt="" class="img-cover">
                    </div>

                </div>
            </section>
            
            <section class="section about" id="about" aria-level="about">
                <div class="container">
                    <div class="about-banner img-holder" style="--width: 600; --height: 700;">
                        <img src="img/abt-banner.jpg" width="600px" height="700px" loading="lazy" alt="" class="img-cover">
                    </div>

                    <div class="about-content">
                        <h2 class="h2 section-title">Program Stimulasi Perkembangan Anak</h2>
                        <p class="section-text">Posyandu tidak hanya fokus pada kesehatan fisik, tetapi juga perkembangan kognitif dan sosial anak. Melalui program stimulasi dini, Posyandu menyediakan aktivitas yang dirancang untuk merangsang perkembangan otak anak, seperti bermain, bernyanyi, dan belajar bersama. Kegiatan ini tidak hanya memperkuat ikatan antara orang tua dan anak, tetapi juga membantu anak-anak mempersiapkan diri untuk pendidikan formal di masa depan.</p>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </section>
            <!--========== SECTION ==========-->
            <section class="section service" id="service" aria-label="service">
                <div class="container">
                    <h2 class="section-title">How It Works</h2>
                    <p class="section-text">A great platform to buy, sell and rent your properties without any agent or commisions</p>
                    <ul class="service-list">
                        <li>
                            <div class="service-card">
                                <div class="card-icon">
                                    <ion-icon name="home-outline"></ion-icon>
                                </div>
                                <h3 class="h3 card-title">Aksesibilitas yang Lebih Baik</h3>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga suscipit neque nemo voluptatibus! Quas quis delectus sunt incidunt numquam.
                                </p>
                            </div>
                        </li>

                        <li>
                            <div class="service-card">
                                <div class="card-icon">
                                    <ion-icon name="time-outline"></ion-icon>
                                </div>
                                <h3 class="h3 card-title">Fleksibilitas Waktu</h3>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga suscipit neque nemo voluptatibus! Quas quis delectus sunt incidunt numquam.
                                </p>
                            </div>
                        </li>

                        <li>
                            <div class="service-card">
                                <div class="card-icon">
                                    <ion-icon name="watch-outline"></ion-icon>
                                </div>
                                <h3 class="h3 card-title">Pemantauan Kesehatan yang Terintegrasi </h3>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga suscipit neque nemo voluptatibus! Quas quis delectus sunt incidunt numquam.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

            <!--========= CONTACT =========-->
            <section class="section contact" id="contact" aria-label="contact">
                <div class="container">
                    <h2 class="h2 section-title">Ada Pertanyaan ? </h2>
                    <button class="btn btn-primary">
                        <ion-icon name="call-outline"></ion-icon>
                        <span class="span"><a href="mailto:codemyhobby9@gmail.com">Contact us</a></span>
                    </button>
                </div>
            </section>

            <!--======= FOOTER ========-->
            <footer class="footer">
                <div class="footer-top">
                    <div class="container">
                        <div class="footer-brand">
                            <a href="#" class="logo">
                                <ion-icon name="home-outline"></ion-icon> Posline
                            </a>
                            <p class="footer-text">
                            Memberi terbaik untuk keluarga indonesia</p>
                        </div>

                        <ul class="footer-list">
                            <li>
                                <p class="footer-list-title">Company</p>
                            </li>
                            <li>
                                <a href="#about" class="footer-link">
                                    <ion-icon name="chevron-forward"></ion-icon>
                                    <span class="span">About us</span>
                                </a>
                            </li>
                            <li>
                                <a href="#services" class="footer-link">
                                    <ion-icon name="chevron-forward"></ion-icon>
                                    <span class="span">Services</span>
                                 </a>
                            </li>
                            <li>
                                <a href="#contact" class="footer-link">
                                    <ion-icon name="chevron-forward"></ion-icon>
                                    <span class="span">Contact us</span>
                                </a>
                            </li>

                            <li>
                                <a href="#" class="footer-link">
                                    <ion-icon name="chevron-forward"></ion-icon>
                                    <span class="span">Login</span>
                                </a>
                            </li>
                        </ul>

                        <ul class="footer-list">
                            <li>
                                <p class="footer-list-title">More Links</p>
                            </li>

                            <li>
                                <a href="#contact" class="footer-link">
                                    <ion-icon name="chevron-forward"></ion-icon>
                                    <span class="span">Contact</span>
                                </a>
                            </li>
                        </ul>

                        <ul class="footer-list">
                            <li>
                                <p class="footer-list-title">Contact Details</p>
                            </li>

                            <li class="footer-item">
                                <ion-icon name="location-outline"></ion-icon>
                                <address class="address">
                                    Lowokwaru, <br>
                                    Malang, <br>
                                    Jawa Timur
                                    <a href="#" class="address-link">View on Google Maps</a>
                                </address>
                            </li>

                            <li class="footer-item">
                                <ion-icon name="mail-outline"></ion-icon>
                                <a href="mailto: codemyhobby9@gmail.com" class="footer-link">xasa@Polinema.ac.id</a>
                            </li>

                            <li class="footer-item">
                                <ion-icon name="call-outline"></ion-icon>
                                <a href="tel: 000-111-22233" class="footer-link">000-111-22233</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <p class="copyright">
                            &copy; 2024 Posline. All rights reserved by <a href="#" class="copyright-link">Kelompok 7 TI-2A</a>
                        </p>

                        <ul class="social-list">
                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-facebook"></ion-icon>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-instagram"></ion-icon>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-twitter"></ion-icon>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="social-link">
                                    <ion-icon name="logo-linkedin"></ion-icon>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>

            <!--=========== BACK-TO-TOP ==========-->
            <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
                <ion-icon name="arrow-up" aria-hidden="true"></ion-icon>
            </a>
        </article>
   </main>
    
  <!--========= custom js link =========-->
  <script src="../resources/js/landing.js" defer></script>

  <!--=========== ionicon link ==========-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>