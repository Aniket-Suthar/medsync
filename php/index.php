<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/mpage.css">
  <link rel="shortcut icon" href="../img/logo.jpeg" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>MedSync: Bridging Patients and Healthcare Providers</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#" style="font-weight: 700; font-size: 30px;">MedSync</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="aboutus.php">About Us</a>
          </li>

        </ul>
        <form class="d-flex" role="search">

          <a href="#bothcards" style="text-decoration: none;"> <button class="btn btn-outline-light" > Sign up</button></a>
        </form>
      </div>
    </div>
  </nav>


  <main>
    <section class="hero" style="display: flex;">
      <div class="container1" style="margin-top: 5%; ">

        <h1>
          <div class="typewriter">MedSync<br>Your Health, Simplified</div>
        </h1>
        <p>Your Comprehensive Digital Healthcare Solution</p>
        <a href="#bothcards"><button id="signup-btn">Explore Now</button></a>
        
      </div>
<img src="../img/Mainone.jpg" alt="" width="460px" height="460px" style="margin-left:32px ;">
    </section>

    <section id="section-2" class="white-section">
      <div class="section-content" style="display: grid; grid-template-columns: 2fr 2fr; gap: 70px;">
       
          <div class="abtimage">
            <img src="../img/AboutMed.jpg" alt="" style="width: 400px; height: 400px; text-align: right; margin-bottom: 10px;">
          </div>
          <div class="contentabt">
            <h2>About MedSync</h2>
            <p style="padding-right: 30px;">MedSync is a comprehensive digital healthcare platform designed to seamlessly connect patients with their
              healthcare providers, allowing for secure and convenient access to medical records, prescriptions, and
              health information. Our user-friendly interface ensures that you can access your healthcare information
              easily and securely.</p>
          </div>
       
        <div class="contenthowto">
        <h2>How to Use MedSync</h2>
        <p style="padding-left:30px ;">To get started, simply create an account and log in. You can then access your medical records, communicate
          with your healthcare provider, and manage your health more effectively.</p>
        </div>
          <div class="howtoimg">
             <img src="../img/Howto.jpg" alt="" style="width: 400px; height: 400px; text-align: center; margin-bottom: 10px;">
            </div>
        </div>
    </section>
    <h1 style="text-align: center;">Thanks for Believing Us</h1>
    <section class="cards-section" id="bothcards" style="display: flex; justify-content: center; align-items: center; padding: 50px 0;">
      <div class="card" style="width: 450px; height: 450px; text-align: center; margin: 20px;">
        <i class="fas fa-user" style="font-size: 118px; margin: 20px;"></i>
        <h3>User Sign Up</h3>
        <p>Join as a user and access your healthcare information.</p>
        <a href="SignUpPageUser1.php" style="text-decoration: none;"><button class="btn btn-primary" style="width: 180px; margin: 10px;">Sign Up</button></a>
      </div>
      <div class="card" style="width: 450px; height: 450px; text-align: center; margin: 20px;">
        <i class="fas fa-user-md" style="font-size: 118px; margin: 20px;"></i>
        <h3>Doctor Sign Up</h3>
        <p>Join as a doctor and manage patient records.</p>
        <a href="SignUpDoctor.php" style="text-decoration: none;"><button class="btn btn-primary" style="width: 180px; margin: 10px;">Sign Up</button></a>
      </div>
    </section>
    <footer class="bg-dark text-white text-center">
      <div class="container py-4">
        <div class="row">
          <div class="col-md-6">
            <h5>Contact Us</h5>
            <p>Email: medsync@gmail.com</p>
            <p>Phone: 8833828888</p>
          </div>
          <div class="col-md-6">
            <h5>Follow Us</h5>
            <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-white me-3"><i class="fab fa-linkedin"></i></a>
            <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="bg-primary py-2">
        <p class="mb-0">&copy; 2023 MedSync. All rights reserved.</p>
      </div>
    </footer>
    
  

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/95a02bd20d.js"></script>
</body>

</html>