<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .contact-wrap {
            background-color: #FFFFFF; /* White background */
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border: 2px solid #CB9DF0;
            border-radius: 5px;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }
        .form-control::placeholder {
            color: #999;
        }
        .form-control:focus {
            border-color: #F0C1E1;
            box-shadow: 0 0 5px rgba(240, 193, 225, 0.5);
        }
        .btn-primary {
            background-color: #CB9DF0;
            border: none;
            padding: 10px 20px;
            color: white;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #F0C1E1;
        }
        .label {
            font-weight: bold;
            color: #333;
        }

        @media (max-width: 768px) {
            .contact-wrap {
                width: 100%;
                padding: 15px;
            }
            .contact-image {
                display: none;
            }
        }
    </style>
</head>
<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <br>
                    <br>
                    <h2 class="heading-section" style="color: #CB9DF0;font-weight: bolder;font-size:xx-large;">Contact Us</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 d-flex">
                    <div class="contact-wrap w-50 p-md-5 p-4">
                        <h3 class="mb-4">Get in touch with us</h3>
                        <div id="form-message-warning" class="mb-4"></div>
                        <div id="form-message-success" class="mb-4"></div>
                        <form method="POST" action="pages/session_messages.php" id="contactForm" name="contactForm" class="contactForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="labelcon" for="name">Full Name</label>
                                        <input type="text" class="form-control" name="contact_name" id="name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="labelcon" for="email">Email Address</label>
                                        <input type="email" class="form-control" name="contact_email" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="labelcon" for="subject">Subject</label>
                                        <input type="text" class="form-control" name="contact_subject" id="subject" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="labelcon" for="message">Message</label>
                                        <textarea name="contact_message" class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" value="Send Message" class="btn btn-primary">
                                        <div class="submitting"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="contact-image w-50">
                        <img src="assets/images/img.jpg" alt="Contact" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>