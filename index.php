<?php
include 'assets/webpages/db-connect.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$bookdata = "SELECT * FROM book ORDER BY id DESC LIMIT 8";
$result = mysqli_query($con, $bookdata);
?>

<?php
if (isset($_POST['contact'])) {
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
  $message = mysqli_real_escape_string($con, $_POST['message']);

  if ($name == "") {
    $error['name'] = "Name should not be empty";
  } else if (!preg_match("/^[a-zA-Z\s]*$/", $name)) {
    $error['name'] = "Only alphabets are allowed";
  }
  if ($email == "") {
    $error['email'] = "Please Enter Email Address";
  } else if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
    $error['email'] = "Please Enter Valid Email Address";
  }
  if ($mobile == "") {
    $error['mobile'] = "Please Enter Mobile Number";
  } else if (!preg_match("/^[0-9]{10}+$/", $mobile)) {
    $error['mobile'] = "Please Enter Valid Mobile Number";
  }
  if ($message == "") {
    $error['message'] = "Message should not be empty";
  } else if (!preg_match("/^[a-zA-Z0-9.,\s]*$/", $message)) {
    $error['message'] = "Only alphabets are allowed";
  } else {
    if (!isset($error)) {
      $insertdata = "INSERT INTO contacttable(name,email,mobile,message) VALUES('$name','$email','$mobile','$message')";
      $runquery = mysqli_query($con, $insertdata);
      if ($runquery) {
        $reciever_email = $email;
        $subject = "Thank you for reaching out | Library Management System";
        $body = "Hi " . $name . ",

        Thank you for reaching out to us. We have received your query Related to Library.
        We will process your query and will get back to you soon.
        
        You can also reach out to us or share your queries  directly to admin of website at librarymanagementwebsite@gmail.com.
        
        Explore our Books on our website: Library Management System
        
        Regards,
         Admin Of Library Management System";
        $sender = "From: librarymanagementwebsite@gmail.com";
        if (mail($reciever_email, $subject, $body, $sender)) {
          echo '<div class="modal" id="popup">
          <div class="modal-main">
            <div class="modal-content">
              <div class="modal-header">
                <span><i class="bx bx-x" id="close-btn"></i></span>
              </div>
              <div class="modal-body">
                <figure>
                  <img src="https://www.skoolbeep.com/blog/wp-content/uploads/2020/12/WHAT-IS-THE-PURPOSE-OF-A-LIBRARY-MANAGEMENT-SYSTEM-min.png" alt="Library Management System Illustration png">
                </figure>
                <h5>Form Submitted Successfully</h5>
                <p>Thank You for Contacting Us. We will contact you soon.</p>
              </div>
            </div>
          </div>
        </div>';
          ?>
          <script>
            document.getElementById("popup").style.display = "flex";
            let btn = document.getElementById("close-btn");
            

            btn.addEventListener("click", () => {
              document.getElementById("popup").style.display = "none";
            })
            
          </script>
          <?php
        } else {
          echo "error while contacting us";
        }
      } else {
        echo "error while running the query";
      }
    }
  }
}

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Library Management System(L.M.S) is simple Library system that is used by librarian for manageing records of books and perform some operations on it.">
  <meta name="keywords" content="LMS,lms,library management system,library software,library management" />
  <title>Library Management System || Make Easy to Manage Records of Books</title>
  <link rel="stylesheet" href="assets/css/index.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!--- google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <!-- Fontawesome Link for Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />

  <style>
 :root {
  --background-color: #ffffff;
  --text-color: #000000;
}

.dark-mode {
  --background-color: #121212;
  --text-color: #e0e0e0;
}

body {
  background-color: var(--background-color);
  color: var(--text-color);
  color: #000; /* لون النص الأساسي للوضع الفاتح */
  background-color: #fff; /* خلفية الوضع الفاتح */
  transition: background-color 0.3s, color 0.3s; /* حركة سلسة عند التغيير */
}

h1, h2, h3,h4,h5,h6 p, li, a {
  transition: color 0.3s ease-in-out; /* حركة سلسة عند تغيير اللون */
}


body.dark-mode * {
  color: #ffffff !important; /* إجبار جميع النصوص الجديدة على الظهور باللون الفاتح */
}

button {
  background-color: #fff;
  color: #000;
  transition: background-color 0.3s, color 0.3s;
}

body.dark-mode button {
  background-color: #333;
  color: #fff;
}


body.dark-mode a:hover {
  color: #ffcc00; /* لون مختلف عند التحويم على الروابط */
}

body.dark-mode {
  color: #fff; /* لون النص للوضع الداكن */
  background-color: #121212; /* خلفية الوضع الداكن */
}

#theme-toggle {
  background-color: transparent;
  border: none;
  cursor: pointer;
}

#theme-toggle img {
  width: 40px;
  height: 40px;
  width: 40px;
  height: 40px;
    transition: filter 0.3s ease-in-out;
}

#theme-toggle:hover img {
  transform: rotate(360deg) scale(1.1); /* دوران مع تكبير */
  opacity: 0.8; /* تقليل الشفافية قليلاً */
}

.dark-mode #theme-toggle img {
  filter: drop-shadow(0 0 5px #ffffff); /* ظل أبيض حول الرمز */
}

  </style>

</head>

<body onload="preloader()">
  <?php include 'assets/loader/loader.php' ?>
  <header>
    <nav class="navbar">
    <button id="theme-toggle" aria-label="Switch Theme">
    <img id="theme-icon" src="assets/images/Dark or light mode.png" alt="Theme Toggle" height="30px" width="30px" />
  </button>
      <div class="logo">
        <div class="icon">
          <!-- <i class='bx bx-book-reader'></i> -->
          <img src="assets/images/lib.png" alt="Library Management System Logo">
        </div>
        <div class="logo-details">
          <h5>Library Management System</h5>
        </div>
      </div>
      <ul class="nav-list">
        <div class="logo">
          <div class="title">
            <div class="icon">
            <img src="assets/images/lib.png" alt="Library Management System Logo">
            </div>
            <div class="logo-header">
              <h4>L.M.S</h4>
              <small>Library System</small>
            </div>
          </div>
          <button class="close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <li><a href="">Home</a></li>
        <li><a href="#book">Books</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">contact</a></li>
        <div class="login">
          <?php
          if (isset($_SESSION['loggedin'])) {
          ?>
            <a href="assets/panel/admin/dashboard.php" type="button" class="loginbtn">Dashboard</a>
          <?php
          } else if (isset($_SESSION['stdloggedin'])) {
          ?>
            <a href="assets/panel/student/std-dashboard.php">Dashboard</a>

          <?php
          } else {
          ?>
            <a href="assets/webpages/login-type.php" type="button" class="loginbtn">Log In</a>
          <?php
          }
          ?>
        </div>
      </ul>
      <div class="hamburger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>
    </nav>
  </header>

  <section class="home">
    <div class="title">
      <h2>Welcome To <span>Online Library Management System</span></h2>
      <p>Explore and Borrow Books Through Online</p>
      <div class="btns">
        <?php
        if (isset($_SESSION['loggedin'])) {
        ?>
          <button><a href="assets/panel/admin/dashboard.php">Dashboard</a></button>
        <?php
        } else if (isset($_SESSION['stdloggedin'])) {
        ?>
          <button><a href="assets/panel/student/std-dashboard.php">Dashboard</a></button>

        <?php
        } else {
        ?>
          <button><a href="assets/webpages/login-type.php">Log In</a></button>

        <?php
        }
        ?>

        <button><a href="#book">Browse Books</a></button>
      </div>
    </div>
  </section>

  <section class="books-showcase" id="book">
    <div class="title">
      <h4>Our Books</h4>
    </div>
    <div class="books-container">
      <?php
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
      ?>
          <div class="book">
            <div class="img">
              <img src="assets/panel/img-store/book-images/<?php echo $row['cover'] ?>" alt="Book Cover Image">
            </div>
            <div class="book-detail">
              <h5><?php echo $row['title'] ?></h5>
              <small><?php echo $row['author'] ?></small>
              <div class="footer-btn">
                <button><a href="assets/webpages/book-details.php?id=<?php echo $row['id'] ?>">Get Book</a></button>
              </div>
            </div>
          </div>
      <?php
        }
      }
      ?>

    </div>
  </section>

  <section class="about-us" id="about">
    <div class="main">
      <div class="img">
        <img src="https://i.pinimg.com/originals/a7/4e/56/a74e56ce6107f0367195ea16e60bdd78.png" alt="About Us Image">
      </div>
      <div class="about-content">
        <h4>About Us</h4>
        <p>Library Management System is carefully developed for easy management of any type of library. It’s actually a virtual version of a real library. It?s a web based system where you can manage books of different categories, manage users & manage issue/return of books easily.Issuing a book to a member is just a matter of a click.LMS will be an efficient and intelligent companion for managing your library.</p>
      </div>
    </div>
  </section>
  <section class="contact" id="contact">
    <h3>Contact Us</h3>
    <div class="main">
      <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1798.855955855807!2d6.862003741996982!3d33.39637215949603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x125911db07b95a05%3A0xf8568bc8aabc96ba!2z2YPZhNmK2Kkg2KfZhNi52YTZiNmFINin2YTYr9mC2YrZgtipINio2KzYp9mF2LnYqSDYp9mE2LTZh9mK2K8g2K3ZhdmHINmE2K7Yttix!5e0!3m2!1sar!2sdz!4v1737296933065!5m2!1sar!2sdz" height="70" style="width: 100%; border: none; border-radius: 5px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="contact-form">
        <h4>Contact Us</h4>
        <p>Get in touch with us</p>
        <form class="input-form" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
          <div class="input-field">
            <label for="name">Full Name *</label>
            <input type="text" name="name" id="name" placeholder="Full Name" />
            <?php
            if (isset($error['name'])) {
            ?>
              <p class="error-msg">
                <?php echo $error['name']; ?>
              </p>
            <?php
            }
            ?>
          </div>
          <div class="input-field">
            <label for="email">E-mail *</label>
            <input type="email" name="email" id="email" placeholder="Email Address" />
            <?php
            if (isset($error['email'])) {
            ?>
              <p class="error-msg">
                <?php echo $error['email']; ?>
              </p>
            <?php
            }
            ?>
          </div>
          <div class="input-field">
            <label for="phone">Phone No. *</label>
            <input type="text" name="mobile" id="phone" placeholder="Phone Number" />
            <?php
            if (isset($error['mobile'])) {
            ?>
              <p class="error-msg">
                <?php echo $error['mobile']; ?>
              </p>
            <?php
            }
            ?>
          </div>
          <div class="message">
            <label for="message">Message *</label>
            <textarea placeholder="Message" name="message" id="message"></textarea>
            <?php
            if (isset($error['message'])) {
            ?>
              <p class="error-msg">
                <?php echo $error['message']; ?>
              </p>
            <?php
            }
            ?>
          </div>
          <input type="submit" name="contact" value="SUBMIT">
          <!-- <button name="contact">SUBMIT</button> -->
        </form>
      </div>
      
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="logo-description">
        <div class="logo">
          <div class="img">
            <i class='bx bx-book-reader'></i>
          </div>
          <div class="title">
            <h4>L.M.S</h4>
          </div>
        </div>
        <div class="logo-body">
          <p>
            Library Management System is carefully developed for easy management of any type of library. It’s actually a virtual version of a real library.
          </p>
        </div>
        <div class="social-links">
          <h4>Follow Us</h4>
          <ul class="links">
            <li>
              <a href=""><i class="fa-brands fa-facebook-f"></i></a>
            </li>
            <li>
              <a href=""><i class="fa-brands fa-youtube"></i></a>
            </li>
            <li>
              <a href=""><i class="fa-brands fa-twitter"></i></a>
            </li>
            <li>
              <a href=""><i class="fa-brands fa-linkedin"></i></a>
            </li>
            <li>
              <a href=""><i class="fa-brands fa-instagram"></i></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="categories list">
        <h4>Book Categories</h4>
        <ul>
          <li><a href="#">Computer Science</a></li>
          <li><a href="#">Programming</a></li>
          <li><a href="#">Philosophy</a></li>
          <li><a href="#">Social Science</a></li>
          <li><a href="#">Fiction</a></li>
          <li><a href="#">Fantasy</a></li>
        </ul>
      </div>
      <div class="quick-links list">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="#contact">Contact Us</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="assets/webpages/login-type.php">Login</a></li>
          <li><a href="#book">Find Books</a></li>
        </ul>
      </div>
      <div class="our-store list">
        <h4>Our Library</h4>
        <div class="map" style="margin-top: 1rem">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1798.855955855807!2d6.862003741996982!3d33.39637215949603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x125911db07b95a05%3A0xf8568bc8aabc96ba!2z2YPZhNmK2Kkg2KfZhNi52YTZiNmFINin2YTYr9mC2YrZgtipINio2KzYp9mF2LnYqSDYp9mE2LTZh9mK2K8g2K3ZhdmHINmE2K7Yttix!5e0!3m2!1sar!2sdz!4v1737296933065!5m2!1sar!2sdz" height="70" style="width: 100%; border: none; border-radius: 5px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <ul>
          <li>
            <a href=""><i class="fa-solid fa-location-dot"></i>39 Hamma Lakhder ,El Oued ,Algeria</a>
          </li>
          <li>
            <a href=""><i class="fa-solid fa-phone"></i>+213 32 00 00 00 00</a>
          </li>
          <li>
            <a href=""><i class="fa-solid fa-envelope"></i>support@bookoe.id</a>
          </li>
        </ul>
      </div>
    </div>
  </footer>

  <script>
    let hamburgerbtn = document.querySelector(".hamburger");
    let nav_list = document.querySelector(".nav-list");
    let closebtn = document.querySelector(".close");
    hamburgerbtn.addEventListener("click", () => {
      nav_list.classList.add("active");
    });
    closebtn.addEventListener("click", () => {
      nav_list.classList.remove("active");
    });
  </script>

<script>
  const themeToggle = document.getElementById("theme-toggle");
const themeIcon = document.getElementById("theme-icon");

themeToggle.addEventListener("click", () => {
  // تبديل الثيم بين الوضع الداكن والفاتح
  document.body.classList.toggle("dark-mode");


  // تغيير الصورة بناءً على الثيم
  if (document.body.classList.contains("dark-mode")) {
    themeIcon.src = "assets/images/moon.svg"; // صورة الوضع الداكن
    localStorage.setItem("theme", "dark"); // حفظ الثيم في localStorage
  } else {
    themeIcon.src = "assets/images/sun.svg"; // صورة الوضع الفاتح
    localStorage.setItem("theme", "light");
  }
});

// استعادة الثيم المحفوظ عند تحميل الصفحة
window.addEventListener("load", () => {
  const savedTheme = localStorage.getItem("theme");
  if (savedTheme === "dark") {
    document.body.classList.add("dark-mode");
    themeIcon.src = "assets/images/moon.svg";
  } else {
    themeIcon.src = "assets/images/sun.svg";
  }
});

</script>
  
</body>

</html>