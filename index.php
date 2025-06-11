<?php 
include('includes/dbconnection.php');
session_start();
error_reporting(0);
include('includes/dbconnection.php');
 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BPMS||Home Page</title>
        
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM0sOxobLNlbNE3T4NUz5/6Jv8iFxvAgS3G7Wjz" crossorigin="anonymous">
  </head>
  <style>
     
      
  /* Existing styles... */

  
  .servicess {
        background-color: #fff; /* Initial background color */
        padding: 60px 0;
        color: #fff;
        transition: background-color 0.3s ease; /* Smooth transition */
    }

    .servicess:hover {
        background-color: #8f354b; /* Background color on hover */
    }

    .servicess {
    position: relative; /* Ensure proper positioning */
    transition: background-color 0.3s ease; /* Optional: smooth background transition */
}

.servicess:hover .subheading,
.servicess:hover h2 {
    color: #ffffff; /* Change text to white on section hover */
}

.servicess .subheading,
 {
    color: #8f354b; /* Default color for text */
    transition: color 0.3s ease; /* Smooth transition for text color */
}



    /* Optional: Adjust card styles if needed for contrast */
    .service-card {
        background-color: #fff;
    }
  /* Optional: Adjust card styles if needed for contrast */
  .service-card {
    background-color: #fff;
  }

  /* ...Remaining styles */
 

 /* Promo Heading Styles */
.promo-heading {
    font-size: 2.5em;
    font-family: 'Pacifico', cursive;
    color: #b84c64;
    background-color: rgba(184, 76, 100, 0.1);
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    margin-bottom: 40px;
    transition: color 0.3s ease;
}

.promo-heading:hover {
    color: #8f354b;
}

/* Card Container Styles */
.service-card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
    margin: 20px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease-in-out;
    position: relative;
    background-color: #fff;
}

.service-card:hover {
    transform: scale(1.05);
}

/* Card Image Styles */
.service-card img {
    width: 100%;
    height: auto;
    border-radius: 10px 10px 0 0;
    transition: opacity 0.3s ease-in-out;
}

.service-card:hover img {
    opacity: 0.85;
}

/* Card Body Styles */
.service-card .card-body {
    padding: 20px;
    text-align: center;
    background-color: #fff;
}

/* Card Title and Text */
.service-card .card-title {
    font-weight: bold;
    margin-bottom: 10px;
    font-size: 1.25em;
}

.service-card .card-text {
    color: #555;
    font-size: 0.95em;
}

/* Discount Badge Styles */
.discount-badge {
    background-color: #b84c64;
    color: #fff;
    padding: 8px 12px;
    border-radius: 8px;
    position: absolute;
    top: 15px;
    left: 15px;
    font-size: 0.85em;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
}

/* Button Styles */
.service-card .btn-details {
    background-color: #b84c64;
    color: white;
    margin-top: 15px;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease-in-out;
}

.service-card .btn-details:hover {
    background-color: #8f354b;
}

.testimonial {
    background-color: #ffd4d4; /* Light gray background for the section */
    padding: 40px 0; /* Add some padding to the top and bottom */
    }

    .testimonial-item {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 20px;
    align-items: center; /* Align items vertically center */
}

.testimonial-item h4 {
    margin-top: 15px; /* Space between image and heading */
    font-weight: bold;
}

.testimonial-item p {
    margin-top: 5px; /* Space between heading and paragraph */
}



.text-left {
    text-align: left;
}

.text-right {
    text-align: right;
}

.emoji {
    font-size: 100px; /* Size of the emoji */
    line-height: 1; /* Align emoji vertically with text */
}

.card {
    background-color: #fff; /* White background for the card */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
    padding: 20px; /* Space inside the card */
    margin: 10px; /* Space between cards */
    transition: transform 0.3s, box-shadow 0.3s; /* Smooth transition for hover effect */
}

.card:hover {
    transform: translateY(-5px); /* Slight lift effect on hover */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
}

h4 {
    margin-top: 10px; /* Space above the heading */
    margin-bottom: 10px; /* Space below the heading */
}

p {
    color: #555; /* Dark gray text for readability */
}


  /* About Services Section */
 /* About Services Section */
.about-services {
  background-color: #ffffff;
  padding: 60px 0;
}

.about-services .container {
  display: flex;
  max-width: 1200px; /* Increase width */
  margin: 0 auto;
  gap: 40px; /* Increase spacing between text and image sections */
}

.about-services .text-section {
  flex: 2; /* Increase the size of the text section */
  padding-right: 20px; /* Add padding on the right */
}

.about-services .subheading {
  color: #8f354b;
  font-size: 20px; /* Slightly larger font */
  
}

.about-services .heading {
  color: #1f1f36;
  font-size: 42px; /* Larger heading */
  font-weight: bold;
  margin-bottom: 20px;
}

.about-services .description {
  color: #555;
  font-size: 18px; /* Larger description text */
  line-height: 1.8;
  margin-bottom: 30px;
}

.about-services .btn {
  padding: 14px 28px; /* Larger button */
  background-color: #8f354b;
  color: #ffffff;
  font-size: 18px;
  text-decoration: none;
  border-radius: 5px;
  display: inline-block;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s ease;
}

.about-services .btn:hover {
  background-color: #333;
}

/* Image Section with Play Button Overlay */
.about-services .image-section {
  flex: 1;
  position: relative;
  background-image: url('./images/bc1.jpg'); /* Replace with your image URL */
  background-size: cover;
  background-position: center;
  height: 400px; /* Increase image section height */
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.about-services .image-section2 {
  flex: 1;
  position: relative;
  background-image: url('./images/bc2.jpg');
  background-size: cover; /* Ensures the image covers the entire div */
  background-position: center; /* Centers the image */
  height: 400px; /* Adjust height as needed */
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin
}

.about-services .image-section3 {
  flex: 1;
  position: relative;
  background-image: url('./images/bc12.jpg');
  background-size: cover; /* Ensures the image covers the entire div */
  background-position: center; /* Centers the image */
  height: 400px; /* Adjust height as needed */
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin
}


/* Play Button Overlay */
.about-services .play-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 50%;
  width: 80px; /* Larger play button */
  height: 80px;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.about-services .play-button::before {
  content: '';
  width: 0;
  height: 0;
  border-left: 20px solid #1f1f36; /* Play button color */
  border-top: 12px solid transparent;
  border-bottom: 12px solid transparent;
}

/* Responsive Design */
@media (max-width: 768px) {
  .about-services .container {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .about-services .text-section {
    padding-right: 0;
    margin-bottom: 20px;
  }

  .about-services .image-section {
    width: 100%;
    height: 250px;
  }
}


/* Responsive Design */
@media (max-width: 768px) {
  .about-services .container {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }

  .about-services .image-section {
    width: 100%;
    height: 200px;
  }
}



.service-section {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 40px;
  max-width: 1200px;
  margin: auto;
}

.service-section.right-image {
  flex-direction: row-reverse;
}

.text-section {
  flex: 1;
  padding: 20px;
}

.image-section {
  flex: 1;
  padding: 20px;
}

.image-section img {
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.subheading {
  color: #ff8474;
  font-size: 1.2rem;
  
}

.heading {
  font-size: 2.5rem;
  color: #333;
  margin: 10px 0;
}

.description {
  color: #555;
  font-size: 1.1rem;
  margin-bottom: 20px;
  align-items: flex-end;
  justify-content: flex-end
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: #1e1e64;
  color: white;
  border-radius: 5px;
  text-decoration: none;
  font-weight: bold;
}

.unique-text-section {
    display: flex;
    flex-direction: column; /* Stack items vertically */
    justify-content: flex-end; /* Align items at the end */
    align-items: flex-end; /* Align items to the start of the cross-axis (left side) */
    height: 100%; /* Ensure the container has a height */
    padding: 20px; /* Optional: add padding for spacing */
}

.description-container {
    align-self: flex-end; /* Aligns paragraph to the right end horizontally */
    text-align: right; /* Ensures text inside is aligned to the right */
    margin-bottom: 10px;

}

 /* Section styling */
  /* Import Pacifico font */
@import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');

/* Section styling */
.massage-section {
    text-align: center;
    padding: 80px 20px;
    font-family: Arial, sans-serif;
    max-width: 1400px;
    margin: 0 auto;
}

.massage-section .massage-subheading {
    font-family: 'Pacifico', cursive;
    font-size: 24px;
    color: #8f354b;
    margin-bottom: 20px;
}

.massage-section .massage-heading {
    font-family: 'Pacifico', cursive;
    font-size: 60px;
    color: #2a2a72;
    margin-bottom: 50px;
}

/* Service container */
.massage-section .massage-services {
    display: flex;
    justify-content: center;
    gap: 60px;
    flex-wrap: wrap;
}

.massage-section .massage-service {
    width: 350px;
    text-align: center;
    padding: 30px;
    box-sizing: border-box;
}

.massage-section .massage-icon-circle {
    width: 100px;
    height: 100px;
    background-color: #8f354b;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    color: #ff8a80;
    font-size: 40px;
}

.massage-section .massage-service h3 {
    font-family: 'Pacifico', cursive;
    font-size: 28px;
    color: #2a2a72;
    margin-bottom: 20px;
}

.massage-section .massage-service p {
    font-size: 18px;
    color: #7a7a7a;
    line-height: 1.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .massage-section .massage-services {
        flex-direction: column;
        gap: 40px;
    }

    .massage-section .massage-heading {
        font-size: 48px;
    }

    .massage-section .massage-service {
        width: 100%;
        padding: 20px;
    }

    .massage-section .massage-icon-circle {
        width: 80px;
        height: 80px;
        font-size: 32px;
    }
}


/* Responsive Design */
@media (max-width: 768px) {
    .massage-section .massage-services {
        flex-direction: column;
        gap: 40px;
    }

    .massage-section .massage-heading {
        font-size: 48px;
    }

    .massage-section .massage-service {
        width: 100%;
        padding: 20px;
    }

    .massage-section .massage-icon-circle {
        width: 80px;
        height: 80px;
        font-size: 32px;
    }
}


/* Responsive Design */
@media (max-width: 768px) {
    .massage-section .massage-services {
        flex-direction: column;
        gap: 30px;
    }
}




/* Responsive Styles */
@media (max-width: 768px) {
    .promo-heading {
        font-size: 1.8em;
    }
}
.customer-reviews {
    background-color: #f9f9f9;
    padding: 60px 0;
}

.review-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin: 15px 0;
    transition: transform 0.3s;
    position: relative;
    overflow: hidden; /* For adding a decorative effect */
}

.review-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 128, 128, 0.1); /* Light teal overlay */
    z-index: 1;
    border-radius: 10px;
    transition: transform 0.3s;
    transform: scale(1.1);
    opacity: 0.5;
}

.review-card:hover::before {
    transform: scale(1.2);
}

.review-content {
    font-style: italic;
    color: #555;
    margin-bottom: 10px;
    position: relative; /* For stacking context */
    z-index: 2; /* Position above the overlay */
}

.reviewer-info {
    text-align: right;
    position: relative; /* For stacking context */
    z-index: 2; /* Position above the overlay */
}

.reviewer-info h5 {
    margin: 0;
    font-weight: bold;
}

.reviewer-info p {
    margin: 0;
    font-size: 1.2em;
    color: #FFA500; /* Gold color for stars */
} 



</style>

 
  <body>
	  <?php include_once('includes/header.php');?>
    <!-- END nav -->

    <section id="home-section" class="hero" style="background-image: url(images/bg.jpg);" data-stellar-background-ratio="0.5">
		  <div class="home-slider owl-carousel">
	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-md-flex no-gutters slider-text align-items-end justify-content-end" data-scrollax-parent="true">
	          	<img class="one-third align-self-end order-md-last img-fluid" src="images/bg_1.png" alt="">
		          <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text mt-5">
		          		<span class="subheading">Beckcare Aesthetic Lounge</span>
			            <h1 class="mb-4">Get Pretty Look</h1>
			            <p class="mb-4">We pride ourselves on our high quality work and attention to detail. The products we use are of top quality branded products.</p>
			            
			           
		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>

	      <div class="slider-item js-fullheight">
	      	<div class="overlay"></div>
	        <div class="container-fluid p-0">
	          <div class="row d-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
	          	<img class="one-third align-self-end order-md-last img-fluid" src="images/bg_2.png" alt="">
		          <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
		          	<div class="text mt-5">
		          		<span class="subheading">Beckcare Aesthetic Lounge</span>
			            <h1 class="mb-4">Beauty Salon</h1>
			            
			            
			           
		            </div>
		          </div>
	        	</div>
	        </div>
	      </div>
	    </div>
    </section>


 
    <section class="servicess">
    <div class="container">
        <div class="row justify-content-center pb-3">
            <div class="col-md-10 heading-section text-center ftco-animate">
                <span class="subheading">PROMO DISCOUNTS</span>
                <h2 class="mb-4">PROMO FOR THIS MONTH</h2>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="service-card position-relative">
                        <img src="./images/image4.jpeg" alt="Service 1">
                        <div class="discount-badge">20% OFF</div>
                        <div class="card-body">
                            <h5 class="card-title">Warts Removal</h5>
                            <p class="card-text">Revitalize your skin with our rejuvenating facial treatments.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card position-relative">
                        <img src="./images/image1.jpeg" alt="Service 2">
                        <div class="discount-badge">15% OFF</div>
                        <div class="card-body">
                            <h5 class="card-title">Facial Treatments</h5>
                            <p class="card-text">Revitalize your skin with our rejuvenating facial treatments.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card position-relative">
                        <img src="./images/image01.jpeg" alt="Service 3">
                        <div class="discount-badge">10% OFF</div>
                        <div class="card-body">
                            <h5 class="card-title">Slimming</h5>
                            <p class="card-text">Pamper your nails with our manicures and pedicures.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-services">
  <div class="container">
    <!-- Text Section -->
    <div class="text-section">
      <span class="subheading">Spa-quality service</span>
      <h2 class="heading">We Deliver Quality Service</h2>
      <p class="description">
        At our beauty salon, you get the highest level of customer service and the utmost relaxation at a very affordable price.
      </p>
      <a href="#" class="btn">Book Now</a>
    </div>

    <!-- Image Section with Play Button -->
    <div class="image-section">
 
    </div>
  </div>


  <div class="service-section right-image">
   
  <div class="text-section unique-text-section">
    <span class="subheading">Trusted Beauty Services</span>
    <h2 class="heading">Exceptional Trusted Care</h2>
    <div class="description-container">
        <p class="description">
            Discover the difference of quality beauty care in a safe and welcoming environment. Our clinic provides outstanding services, expertly delivered to enhance your natural beauty, with a commitment to your comfort and satisfaction.
        </p>
</div>
    <a href="#" class="btn">Book Now</a>
</div>
  <div class="image-section2">
     
  </div>
</div>

<div class="container">
    <!-- Text Section -->
    <div class="text-section">
      <span class="subheading">Exceptional Care, Every Visit</span>
      <h2 class="heading">Beauty You Can Trust</h2>
      <p class="description">
      We’re here to provide more than just beauty services. With our skilled team and safe practices, we offer a rejuvenating experience tailored to you. Feel confident knowing you’re in expert hands, committed to enhancing your natural beauty.
      </p>
      <a href="#" class="btn">Book Now</a>
    </div>

    <!-- Image Section with Play Button -->
    <div class="image-section3">
 
    </div>
  </div>

</section>
<section class="massage-section">
    <span class="massage-subheading">Experience the Beckcare Advantage</span>
    <h2 class="massage-heading">Benefits of Choosing Beckcare</h2>
    <div class="massage-services">
        <div class="massage-service">
            <div class="massage-icon-circle">
                <i class="fas fa-smile-beam"></i> <!-- Personalized Care Icon -->
            </div>
            <h3>Personalized Care</h3>
            <p>Every treatment at Beckcare is customized to your unique needs, providing you with the highest level of care.</p>
        </div>
        <div class="massage-service">
            <div class="massage-icon-circle">
                <i class="fas fa-shield-alt"></i> <!-- Safe Services Icon -->
            </div>
            <h3>Safe, Trusted Treatments</h3>
            <p>Your safety is our priority. All treatments are conducted with top-quality products by skilled professionals.</p>
        </div>
        <div class="massage-service">
            <div class="massage-icon-circle">
                <i class="fas fa-hand-holding-heart"></i> <!-- Relaxation Icon -->
            </div>
            <h3>Relax and Renew</h3>
            <p>Our treatments not only bring results but also provide a relaxing and rejuvenating experience for body and mind.</p>
        </div>
         
    </div>
</section>




 

 <!-- New Customer Reviews Section -->
 <section class="customer-reviews">
        <div class="container">
            <div class="row justify-content-center pb-3">
                <div class="col-md-10 heading-section text-center ftco-animate">
                    <span class="subheading">WHAT OUR CUSTOMERS SAY</span>
                    <h2 class="mb-4">Customer Reviews</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="review-card">
                        <div class="review-content">
                            <p>"The best experience I’ve ever had! The staff is very professional and the services are top-notch."</p>
                        </div>
                        <div class="reviewer-info">
                            <h5>Maria S. 😊</h5>
                            <p>⭐⭐⭐⭐⭐</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="review-card">
                        <div class="review-content">
                            <p>"A relaxing atmosphere with skilled professionals. I felt rejuvenated after my visit!"</p>
                        </div>
                        <div class="reviewer-info">
                            <h5>John D. 😎</h5>
                            <p>⭐⭐⭐⭐⭐</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="review-card">
                        <div class="review-content">
                            <p>"Highly recommend! They use high-quality products, and the results are amazing."</p>
                        </div>
                        <div class="reviewer-info">
                            <h5>Lisa M. 😊</h5>
                            <p>⭐⭐⭐⭐⭐</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="review-card">
                        <div class="review-content">
                            <p>"Absolutely loved my experience! The staff were friendly and attentive."</p>
                        </div>
                        <div class="reviewer-info">
                            <h5>Emily R. 😊</h5>
                            <p>⭐⭐⭐⭐⭐</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="review-card">
                        <div class="review-content">
                            <p>"Best spa day ever! I felt like a new person after my treatment."</p>
                        </div>
                        <div class="reviewer-info">
                            <h5>Michael B. 😎</h5>
                            <p>⭐⭐⭐⭐⭐</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="review-card">
                        <div class="review-content">
                            <p>"Wonderful service and a great atmosphere. I will definitely return!"</p>
                        </div>
                        <div class="reviewer-info">
                            <h5>Sarah T. 😊</h5>
                            <p>⭐⭐⭐⭐⭐</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 

            


 

     

   <?php include_once('includes/footer.php');?>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
  <script>
    // Your existing script
    document.addEventListener('DOMContentLoaded', function() {
        const serviceCards = document.querySelectorAll('.service-card');
        const observerOptions = {
            root: null, // Use the viewport as the root
            threshold: 0.1 // Trigger when 10% of the card is visible
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target); // Stop observing after it becomes visible
                }
            });
        }, observerOptions);

        serviceCards.forEach(card => {
            observer.observe(card); // Observe each card
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>