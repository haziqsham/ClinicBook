<!DOCTYPE html>
<html lang="en">
<head>
    <title>Klinik Hasnida - Home</title>
    <link rel='shortcut icon' type='image/x-icon' href='Klinik.png' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .header {
            position: relative;
            background: url('backg.jpg') no-repeat center center;
            background-size: cover;
            height: 60vh;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .header h1 {
            font-size: 3em;
            z-index: 2;
        }
        .header .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 150px;
            z-index: 2;
        }
        .section-title {
            font-size: 2.5em;
            border-bottom: 2px solid #ddd;
            display: inline-block;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .about-section p {
            max-width: 800px;
            margin: 0 auto;
            font-size: 1.1em;
            line-height: 1.6;
            text-align: center;
        }
        .footer-contact p, .footer-contact a {
            margin: 0;
        }
        .footer-social-icons a {
            color: white;
            margin: 0 10px;
            font-size: 24px; 
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 20px;
        }
        .card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .team-section img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .team-section h3, .team-section p {
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="Klinik.png" alt="Clinic Logo" style="max-width: 200px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.html">Book an Appointment</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="header">
        <h1>Welcome to Klinik Hasnida Dan Rakan-Rakan</h1>
    </div>

    <div class="container">
        <section class="about-section">
            <div class="container my-5">
                <h2 class="section-title text-center pb-2 mb-4">About Our Clinic</h2>
                <p class="text-center mx-auto">
                    Klinik Hasnida holds the privilege of being Malaysia's first choice clinic. Managed by Klinik Hasnida Sdn. Bhd., it began offering healthcare services in 2013 and is 100 percent developed and owned by Bumiputera. Located in Kuala Lumpur, Klinik Hasnida is fully equipped with modern equipment to meet the needs of its customers, making it a preferred choice for healthcare services.
                </p>
            </div>
        </section>
<br>
        

        <section class="services-section">
            <div class="card">
                <img src="dalamKlinik.jpeg" class="card-img-top" alt="Clinic Interior">
                <div class="card-body">
                    <h5 class="card-title">Our Services</h5>
                    <ul class="card-text list-unstyled">
                        <li>- General Health Check-ups</li>
                        <li>- Specialist Consultations</li>
                        <li>- Diagnostic Tests</li>
                        <li>- Vaccinations</li>
                        <li>- Emergency Services</li>
                    </ul>
                    <a href="login.html" class="btn btn-danger">Book Now</a>
                </div>
            </div>
        </section>
<br>
        <section class="team-section">
            <h2 class="section-title">Meet Our Team</h2>
            <div class="row text-center">
                <div class="col-md-4">
                    <img src="https://0.academia-photos.com/893963/327504/19261924/s200_hasnida.harun.png" alt="Doctor Image" class="img-fluid rounded-circle">
                    <h3>Dr. Hasnida</h3>
                    <p>General Practitioner</p>
                </div>
                <div class="col-md-4">
                    <img src="https://tse1.mm.bing.net/th?id=OIP.nD63_r_JXImt81J0uudo2AAAAA&pid=Api&P=0&h=220" alt="Doctor Image" class="img-fluid rounded-circle">
                    <h3>Dr. Siti</h3>
                    <p>General Practitioner</p>
                </div>
            </div>
        </section>
        
        <section class="maps-section text-center">
            <h2 class="Maps-title">Come Visit Us!</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.146607414484!2d101.75594137480877!3d3.055411096920366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc34e6d3bb1529%3A0xc21769491d5cf068!2sKlinik%20Hasnida!5e0!3m2!1sen!2smy!4v1716569093742!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        
        </section>
        <br>

        <section class="covid19-section">
            <h2 class="section-title">COVID-19 Updates</h2>
            <p class="text-center">We are committed to ensuring your safety during the COVID-19 pandemic. Visit offical website for updated protocols and services related to COVID-19.</p>
            <div class="text-center">
                <a href="https://data.moh.gov.my/dashboard/covid-19" class="btn btn-info">Learn More</a>
            </div>
        </section>
        <br>
    </div>

    <footer class="bg-dark py-3">
        <div class="container text-center text-white-50">
            <small>&copy; 2024 ClinicBook. All rights reserved.</small>
            <div class="footer-contact mt-2">
                <p>No. 7, Jalan Suadamai 1/3, Tun Hussein Onn, 43200 Kuala Lumpur, Selangor, Malaysia</p>
                <p>Phone: 03-7654 1356</p>
                <p>Email: info@clinicbook.com</p>
                <p>Monday to Sunday, 9am to 5pm</p>
                <p>Emergency services available 24/7</p>
            </div>
            <div class="footer-social-icons mt-2">
                <a href="https://www.facebook.com/pages/Klinik%20Hasnida%20Bandar%20Tun%20Hussein%20Onn/1164063333731209/"><i class="fa-brands fa-facebook"></i></a>
            </div>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
