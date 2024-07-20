<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>T&Nchemical's Site</title>
  <link href="./assets/css/style.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Serif:400,400italic,700,700italic%7CKanit:200,300,regular,500,600,700,800,900%7CPoppins:200,300,regular,500,600,700,700italic,800&amp;subset=latin,thai" media="all">
  <link href="./assets/css/styleCustom.css" rel="stylesheet" type="text/css">
  <link href="./assets/image/6572c324e35e8d399a18316e_logo_color32.png" rel="shortcut icon" type="image/x-icon">
  <link href="./assets/image/6572c358b629729817be1fa4_logo_color256.png" rel="apple-touch-icon">

  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">
    WebFont.load({
      google: {
        families: [
          "PT Serif:400,400italic,700,700italic",
          "Kanit:200,300,regular,500,600,700,800,900:latin,thai",
          "Poppins:200,300,regular,500,600,700,700italic,800",
        ],
      },
    });
  </script>
  <script type="text/javascript">
    !(function(o, c) {
      var n = c.documentElement,
        t = " w-mod-";
      (n.className += t + "js"),
      ("ontouchstart" in o ||
        (o.DocumentTouch && c instanceof DocumentTouch)) &&
      (n.className += t + "touch");
    })(window, document);
  </script>
  <script>
    var chekeStartPage = <?php echo json_encode($chekeStartPage); ?>;

    function clickAddBg() {
      var scrollElement = document.getElementById("scrollElement");
      scrollElement.classList.add("scrolled");
      chekeStartPage = false;
      console.log(`add BG Clicked !! ${chekeStartPage}`)
    }
  </script>
  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
      var scrollElement = document.getElementById("scrollElement");
      if (scrollElement) {
        setInterval(() => {
          if (chekeStartPage) {

            window.addEventListener("scroll", function() {
              var scrollPercentage = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
              if (scrollPercentage >= 1) {
                scrollElement.classList.add("scrolled");
              } else {
                scrollElement.classList.remove("scrolled");

              }
            });
          } else {
            scrollElement.classList.add("scrolled");
          }
        }, [500])

      } else {
        console.error("Element with id 'scrollElement' not found in the DOM.");
      }
    });
  </script>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-W0C91JSZC5"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-W0C91JSZC5');
  </script>
  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1050007002750168');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1050007002750168&ev=PageView&noscript=1"></noscript>

  <style>
    .wf-force-outline-none[tabindex="-1"]:focus {
      outline: none;
    }

    a.w-webflow-badge {
      display: none !important;
    }

    .w-dropdown-list {
      background: rgba(170, 188, 201, 0.7287289915966386) !important;
      backdrop-filter: blur(10px);
    }

    .w-dropdown-list a {
      color: white;
    }

    .tabs_content {
      position: static !important;
      height: auto !important;
    }

    .experimental-results_main {
      background-color: rgb(238, 242, 245) !important;
    }

    .w-dropdown-link:hover {
      background-color: #AABCC9;
      transition: all 0.3s;
    }

    .sec_top {
      height: auto !important;
    }

    .container.bg .tabs_main {
      padding-top: 5%;
      padding-bottom: 5%;
    }

    .fixed {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
    }

    @media screen and (max-width: 991px) {
      .w-dropdown-list.w--nav-dropdown-list-open.w--open {
        margin-left: -6% !important;
      }

      .nav_bar {
        flex-direction: column;
        align-items: flex-start;
      }

      .nav_menu {
        display: none;
        flex-direction: column;
        width: 100%;
        margin-top: 80px;
      }

      .nav_menu.show {
        display: flex;
      }

      .nav_link {
        width: 100%;
        text-align: left;
      }

      .nav-btn {
        margin-top: 10px;
      }

      .container.bg .tabs_main {
        padding-top: 10%;
        padding-bottom: 10%;
      }

      .hamburger {
        display: block;
        cursor: pointer;
        margin-top: 10px;
      }

      .hamburger .line {
        width: 25px;
        height: 3px;
        background-color: #000;
        margin: 4px 0;
        transition: all 0.3s;
      }

      .hamburger.active .line1 {
        transform: rotate(45deg) translate(5px, 5px);
      }

      .hamburger.active .line2 {
        opacity: 0;
      }

      .hamburger.active .line3 {
        transform: rotate(-45deg) translate(5px, -5px);
      }
    }

    @media screen and (min-width: 992px) {
      .hamburger {
        display: none;
      }
    }
  </style>
</head>

<body cz-shortcut-listen="true">
  <div class="fixed" data-animation="default" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease" role="banner" class="navbar w-nav" id="scrollElement">
    <div class="nav_bar w-container">
      <a href="./productRead.php" class="brand w-nav-brand">
        <div class="text_logo">Admin DB | T&N Chemical</div>
      </a>
      <nav role="navigation" class="nav_menu w-nav-menu">
        <a href="productRead.php" class="nav_link w-nav-link" style="max-width: 1440px;">ผลิตภัณฑ์</a>
        <a href="labRead.php" class="nav_link w-nav-link" style="max-width: 1440px;">ผลการทดลอง</a>
        <a href="logout.php" class="nav_link w-nav-link" style="max-width: 1440px;color:red;">ออกจากระบบ</a>

        <div class="nav-btn">
          <a href="#" class="link_logo w-inline-block">
            <img src="./assets/image/65716e6f33cc4d93c22c0c7e_logo.svg" loading="lazy" alt="" class="logo_m"></a>
        </div>
      </nav>
      <div class="hamburger" onclick="toggleMenu()">
        <div class="line line1"></div>
        <div class="line line2"></div>
        <div class="line line3"></div>
      </div>
    </div>
    <div class="w-nav-overlay" data-wf-ignore="" id="w-nav-overlay-0"></div>
  </div>

  <script>
    function toggleMenu() {
      var menu = document.querySelector('.nav_menu');
      var hamburger = document.querySelector('.hamburger');
      menu.classList.toggle('show');
      hamburger.classList.toggle('active');
    }
  </script>
</body>

</html>
