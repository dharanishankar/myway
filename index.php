<?php
include 'conn.php';
session_start();
if(isset($_POST['submit']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phonenumber=$_POST['phonenumber'];
    $quotation=$_POST['quotation'];
    $address=$_POST['address'];
    $sql = "insert into msg(name,address,email,phonenumber,des) value('$name','$address','$email','$phonenumber','$quotation');";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('sent successfully!!');
window.location.href='index.php';
</script>";
  
    }
    else{
        
   echo "<script>
alert('invalid data');
window.location.href='index.php';
</script>";
    }
}
$check="select * from image";
$result = mysqli_query($conn,$check);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="indexstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@675&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" />
    <title>My Way Constructions</title>
</head>
<body>
    <div class="move">
        <a href="#first">Home</a>
    </div>
    <div id="first">
        <div class="inner">
            
            <div class="heading">
                <img class="cross" src="./images/cross.png" width="15px" height="15px" alt="">
            </div>
            <ul class="lists" data-aos="flip-right" data-aos-duration="3000">
                <li><a href="#Philosophy">Philosophy</a></li>
                <li><a href="#Mission">Mission</a></li>
                <li><a href="#About">About</a></li>
                <li><a href="#Projects">Projects</a></li>
                <li><a href="#features">Key features</a></li>
            </ul>
            <div class="sign">
                <img class="logo" style="margin-left: 50px;position: absolute;" src="logo.png" width="65px" height="65px" alt="">
                <button class="admin" style="margin-bottom: 50px; margin-left:150px ">Admin login</button>
            </div>
            <div class="slogans">
                <h1 class="names">MY WAY CONSTRUCTIONS</h1>
                <p>presenting future through building innovative homes</p>
            </div>
            <div class="adminform" data-aos="zoom-up" data-aos-duration="3000">
                <h2>Admin Login</h2>
                <p class="close">X</p>
                <form class="adminforms" action="postlogin.php" method="POST">
                    <input class="" type="text" placeholder="User Name" name="username" autocomplete="off"><br>
                    <input type="password" name="password"  placeholder="Password"><br>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
    <section id="Philosophy" >
        <div class="philcont" data-aos="flip-up" data-aos-duration="2000">
            <h2>OUR PHILOSOPHY</h2>
            <br>
            <div>
                To deliver projects with high quality, on time, at affordable budget with impeccable safety record. The integrated work culture in company is built on hard work, honesty, Planning and involvement.
            </div>
        </div>
        <div class="phil" data-aos="zoom-in" data-aos-duration="2000">
            <img src="./images/phil.jpg" alt="">
        </div>
    </section>
    <hr>
    <section id="Mission">
        <div class="missi" data-aos="zoom-up" data-aos-duration="2000">
            <img src="./images/missi.jpg" alt="">
        </div>
        <div class="missicont" data-aos="zoom-in" data-aos-duration="2000">
            <h2>MISSION</h2><br>
            <div>
                To maintain steady, profitable growth to ensure the long-term vitality of their company in providing constructive contributions to society and sustaining a safe, dynamic and rewarding work environment for loyal team members. To achieve flexibility and ability to keep in pace with the ever-changing market
            </div>
        </div>
    </section>
    <hr>
    <section id="About">
        <div class="foundercnt">
            <div class="cnt" data-aos="flip-up" data-aos-duration="2000">
                <div>
                    Er.R.Ramakrishnan, the Founder and Managing Director of My Way Constructions is a Young Civil Engineer. He ventured into this construction field with right gear and a cautious riding style and is now the managing director of My Way Constructions.
                </div>
            </div>    
            <div class="founder" data-aos="zoom-up" data-aos-offset="100" data-aos-easing="ease-in-sine">
                <img src="./images/foun1.jpeg" alt="">
            </div>
        </div>
        <div class="company" data-aos="fade-up"
        data-aos-offset="300"
        data-aos-easing="ease-in-sine">
            <div class="companycnt">
                    My Way Constructions started their journey in the year 2018, They have constructed artistic homes & shopes. New technology, modern machinery, innovation and the quest for growth are the inimitable hallmarks of the company.
            </div>
        </div>
    </section>
    <section style="background-color: antiquewhite;"  id="Projects">
        <div class="prohead">
            <h2>
                OUR PROJECT'S
            </h2> 
            </div>
            <div class="grids">
                <div class="one" data-aos="zoom-up"
                data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div style="background-image: url(./images/one.jpeg);" class="illust"></div>
                    <p class="one">AVADI</p>
                </div>
                <div class="two" data-aos="zoom-up"
                data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div style="background-image: url(./images/two.jpeg);" class="illust"></div>
                    <p class="two">MINJUR</p>
                </div>
                <div class="three" data-aos="zoom-up"
                data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div style="background-image: url(./images/three.jpeg);" class="illust"></div>
                    <p class="three">PONNERI</p>
                </div>
                <div class="four" data-aos="zoom-up"
                data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div style="background-image: url(./images/four.jpeg);" class="illust"></div>
                    <p class="four">CHEMBARAMBAKKAM</p>
                </div>
            </div>
    </section>
    <section style="background-color: rgba(189, 182, 182,0.4);" id="site">
        <h2>OUR GALLERY</h3>
        <div class="owl-carousel">
            <?php while ($row = mysqli_fetch_assoc($result)):?> 
                <img src="<?php echo 'img/'.$row['file']?>" alt=""> 
            <?php endwhile?>
                 <img src="./images/gallery1.jpeg" alt=""> 
                 <img src="./images/gallery2.jpeg" alt=""> 
                 <img src="./images/gallery3.jpeg" alt=""> 
                 <img src="./images/gallery7.jpeg" alt=""> 
                 <img src="./images/gallery4.jpeg" alt=""> 
                 <img src="./images/gallery5.jpeg" alt=""> 
                 <img src="./images/gallery.jpeg" alt=""> 
                 <img src="./images/gallery0.jpeg" alt=""> 
                 <img src="./images/gallery9.jpeg" alt=""> 
                 <img src="./images/gallery10.jpeg" alt=""> 
                 <img src="./images/gallery11.jpeg" alt=""> 
        </div>
    </section>
    <div>
        <h2 style="background-color: rgba(233, 161, 233, 0.3); text-align: center;">KEY FEATURES</h2>
        <section id="features">
        <div class="quality">
            <div>
                <div style="background-image: url(./images/quality.jpg);" class="illus">
                </div>
                <div class="words">
                    <h3>Quality Building</h3>
                </div>
            </div>
        </div>
        <div class="proper">
            <div>
                <div style="background-image: url(./images/proper.jpg);" class="illus">
                </div>
                <div  class="words">
                    <h3>Proper Management</h3>
                </div>
            </div>
        </div>
        <div class="design">
            <div>
                <div style="background-image: url(./images/design.jpg);" class="illus">
                </div>
                <div  class="words">
                    <h3>Standard Design</h3>
                </div>
            </div>
        </div>
        <div class="develop">
            <div>
                <div style="background-image: url(./images/devlop.jpg);" class="illus">
                </div>
                <div  class="words">
                    <h3>Development and construction of residential building in a proper manner</h3>
                </div>
            </div>
        </div>
    </section>
    </div>
    <section id="quotation">
        <p>Email : build@mywayconstructions.com</p><br>
        <p>Request a quotation</p>
        <form class="quo" method="post">
            <input type="text" placeholder="Your name" name="name" required><br>
            <input type="text" placeholder="Your address" name="address" required><br>
            <input type="email" name="email" placeholder="Your email" required>
            <br>
            <input type="number" placeholder="Phone Number" name="phonenumber" required><br>
            <input type="text" placeholder="Type your quotation" name="quotation" required><br>
            <button name="submit" type="submit">Send</button>
        </form>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous"></script>
    <script src="index.js"></script>
</body>
</html>