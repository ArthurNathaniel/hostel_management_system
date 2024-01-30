<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css" />
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <section>
        <div class="hero_all">
            <div class="hero_text" id="animatedText">
                <h1>Book your <span>Hostel </span></h1>
                <h1>Anywhere, Anytime</h1>
                <p>
                    Embark on your adventure with ease – book your hostel room anywhere, anytime, and let the journey
                    unfold
                    with comfort
                    and convenience.
                </p>
                <div class="booking_btns">
                    <button>
                        <a href="book_a_hostel_room.php">Book a hostel</a>
                    </button>
                </div>
            </div>
            <div class="hero_image">
                <img src="./images/hero.png" alt="">
            </div>
        </div>
    </section>

    <section>
        <div class="services_bg">
            <div class="services_title">
                <h2>Our Services</h2>
            </div>
            <div class="services_grid" id="animatedText">
                <div class="services_box">
                    <h1><i class="fas fa-bed"></i></h1>
                    <p>Accommodation</p>
                </div>
                <div class="services_box">
                    <h1><i class="fas fa-shield-alt"></i></h1>
                    <p>24/7 Security</p>
                </div>
                <div class="services_box">
                    <h1><i class="fas fa-wifi"></i></h1>
                    <p>Internet/Wi-Fi</p>
                </div>
                <div class="services_box" id="roooooms">
                    <h1><i class="fas fa-book"></i></h1>
                    <p>Study Areas</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="gallery_all">
            <div class="gallery_title">
                <h1>Explore Our <span>Hostel Rooms</span></h1>
            </div>
            <div class="gallery_grid">
                <div class="room">
                    <a href="./images/slide_one.jpg" data-lightbox="gallery" data-title="Hostel Rooms " download>
                        <img src="./images/slide_one.jpg" alt="">
                    </a>
                </div>
                <div class="room">
                    <a href="./images/slide_two.jpg" data-lightbox="gallery" data-title="Hostel Rooms " download>
                        <img src="./images/slide_two.jpg" alt="">
                    </a>
                </div>
                <div class="room">
                    <a href="./images/slide_three.jpg" data-lightbox="gallery" data-title="Hostel Rooms " download>
                        <img src="./images/slide_three.jpg" alt="">
                    </a>
                </div>
                <div class="room">
                    <a href="./images/slide_three.jpg" data-lightbox="gallery" data-title="Hostel Rooms " download>
                        <img src="./images/slide_three.jpg" alt="">
                    </a>
                </div>
                <div class="room">
                    <a href="./images/slide_two.jpg" data-lightbox="gallery" data-title="Hostel Rooms " download>
                        <img src="./images/slide_two.jpg" alt="">
                    </a>
                </div>
                <div class="room" id="contact__us">
                    <a href="./images/slide_three.jpg" data-lightbox="gallery" data-title="Hostel Rooms " download>
                        <img src="./images/slide_three.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="contact_all">
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126804.78769318192!2d-1.6985085189253444!3d6.690249146573474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c1e64db743ce00d%3A0x7fb7d9ac845c5d60!2sNathstack!5e0!3m2!1sen!2sgh!4v1706544977201!5m2!1sen!2sgh" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="contact_forms">
                <form action="" method="post">
                    <div class="forms">
                        <label>Name:</label>
                        <input type="text" placeholder="Enter your full name" name="name">
                    </div>
                    <div class="forms">
                        <label>Email:</label>
                        <input type="email" placeholder="Enter your email address">
                    </div>
                    <div class="forms">
                        <label>Phone Number:</label>
                        <input type="number" placeholder="Enter your phone number" name="phone_number">
                    </div>
                    <div class="forms">
                        <label>Subject:</label>
                        <input type="text" placeholder="Enter your subject" name="subject">
                    </div>
                    <div class="forms">
                        <label>Message:</label>
                        <textarea name="message" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="forms">
                        <input type="text" type="submit" value="Send your message" class="Submit">
                    </div>
                </form>

            </div>
        </div>
    </section>

    <section id="footer">
        <div class="logo_footer">
            <h2>Hostel <span>Systems</span></h2>
        </div>
        <div class="social_media">
            <h3>Connect with on all Social Media Platforms</h3>
            <div class="media_links">
                <a href="#" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
                <a href="#" target="_blank"><i class="fa-brands fa-youtube"></i></a>

            </div>
            <p>
                <a href="login.php">Login as Admin</a>
            </p>
        </div>
        <div class="copyright">
            <p>
                All Copyright &copy; Reserved
                <script>
                    document.write(new Date().getFullYear())
                </script>
                | Hostel Management System
            </p>
        </div>
    </section>
    <script src="./js/navbar.js"></script>
    <!-- Include jQuery and Lightbox scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js"></script>

    <!-- Include anime.js script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <script>
        // Use anime.js to animate the text
        anime.timeline({
                loop: false
            })
            .add({
                targets: '#animatedText h1',
                opacity: [0, 1],
                translateY: [50, 0],
                easing: 'easeInOutQuad',
                duration: 1000
            })
            .add({
                targets: '#animatedText p',
                opacity: [0, 1],
                translateY: [50, 0],
                easing: 'easeInOutQuad',
                duration: 2500
            })
            .add({
                targets: '#animatedText button',
                opacity: [0, 1],
                translateZ: [-50, 0],
                easing: 'easeInOutQuad',
                duration: 3500
            })
            .add({
                targets: '#animatedText h1',
                opacity: [0, 1],
                translateY: [50, 0],
                easing: 'easeInOutQuad',
                duration: 4500
            })
    </script>
</body>

</html>


<style>

</style>