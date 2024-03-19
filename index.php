
<?php
  use PHPMailer\PHPMailer\PHPMailer;
  require_once __DIR__ . '/vendor/autoload.php';
  $errors = [];
  $errorMessage = '';

  if (!empty($_POST)) {
    $inputEmail = $_POST['inputEmail'];
    $issueDesc = $_POST['issueDesc'];

    if (empty($inputEmail)) {
        $errors[] = 'Email is empty';
    } else if (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }

    if (empty($issueDesc)) {
        $errors[] = 'Message is empty';
    }

  // if (empty($errors)) {
  //   $toEmail = 'toby2494@gmail.com';
  //   $emailSubject = 'New email from your contact form';
  //   $headers = ['From' => $inputEmail, 'Reply-To' => $inputEmail, 'Content-type' => 'text/html; charset=utf-8'];
  //   $bodyParagraphs = ["Email: {$inputEmail}", "Message:", $issueDesc];
  //   $body = join(PHP_EOL, $bodyParagraphs);

  //   if (mail($toEmail, $emailSubject, $body, $headers)) {

  //       header('Location: thank-you.html');
  //   } else {
  //       $errorMessage = 'Oops, something went wrong. Please try again later';
  //   }

  //   } else {

  //       $allErrors = join('<br/>', $errors);
  //       $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
  //   }
  }

    if (!empty($errors)) {
      $allErrors = join('<br/>', $errors);
      $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    } else {
      $mail = new PHPMailer();


      // specify SMTP credentials


      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'toby2494.development';
      $mail->Password = 'mj1268"Samdasu'; //put me in env file la in env file later
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->setFrom($email, 'seolynn.com');
      $mail->addAddress($inputEmail, 'Me');
      $mail->Subject = 'New message from your website';

      // Enable HTML if needed
      $mail->isHTML(true);
      $bodyParagraphs = ["Email: {$inputEmail}", "Message:", nl2br($issueDesc)];
      $body = join('<br />', $bodyParagraphs);
      $mail->Body = $body;
      echo $body;

      if($mail->send()){
          //header('Location: '); // Redirect to 'thank you' page. Make sure you have it
      } else {

          $errorMessage = 'Oops, something went wrong. Mailer Error: ' . $mail->ErrorInfo;
      }
    }
  }
  

?>





<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Totorolla Corolla 8th Gen Guide</title>
	<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css"
</head>
<body>
	<div class="wrap clearfix">
    <header class="main-header clearfix">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <h1 class="name row"><a class="text-muted text-decoration-none col" href="#">Seolynn IT Services</a><p class="col">(972)-440-9156</p></h1>
          
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="https://corollayanki.com">Car Blog</a>
              </li>

						<!-- <li class="nav-item"><a class="nav-link" href="./unix_linux/index.html">Unix/Linux</a></li> -->

              <!-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li> -->
              <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li> -->
              <!-- <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
              </li> -->
            </ul>
            <!-- <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
          </div>
        </div>
      </nav>
    </header><!--/.main-header-->
    <div class="banner">
      <div class="container">
        <img class="logo" src="img/totoro.svg" alt="Totoro and friends">
        <h1 class="headline">Seolynn IT Services</h1>
        <span class="tagline">Your IT and Hardware Superhero.</span>
      </div>
    </div><!--/.banner-->
    <div class="container">
      <div class="content">
        <div class="row">
          <div class="col-md-6">
            <h2>Welcome!</h2>
            <div class="card">
              <p class="card-header">Send us a message of your issue: whether it's software, broken hardware, or remote support related!</p>

              <?php echo((!empty($errorMessage)) ? $errorMessage : '') ?>


              <form class="card-body" id="issueForm" method="post">
                <div class="form-group">
                  <label for="inputEmail">Email address</label>
                  <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                  <label for="issueDesc">What Issue are you having?</label>
                  <textarea class="form-control" id="issueDesc" placeholder="Your Issues"></textarea>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="remoteCheck">
                  <label class="form-check-label" for="remoteCheck">Able to Solve Remotely</label>
                </div>
                <button type="submit" class="btn btn-primary">Email Us</button>
              </form>
            </div>
          </div><!--/.primary-->
          <div class="col">
            <h2>Local DFW Mobile Services</h2>
            <img class="feat-img" src="img/corolla.png" alt="Generic Black Corolla 8th gen">
            <p>I come to you if you're local to Dallas area. Email me your issue, then let's setup a meeting time. If you're lucky I will show up in my old black corolla!</p>
          </div><!--/.secondary-->
        </div>
        <div class="row">
          <div class="col-12 content mt-3">
            <h2>Services We Offer</h2>
            <p><strong>Mobile Device Repair: </strong>Experience in repair for both Apple and Android phones and tablets.</p>
            <p><strong>Remote Server/Desktop Support: </strong>Extensive Linux ssh experience for system admin issues.</p>
            <p><strong>Shell Automation Scripting: </strong>Experience in Shell Scripting for Automation along with Cron and Ansible.</p>
            <p><strong>Web Development Support: </strong>Experience in Python web development along with docker and web server support.</p>
            <p><strong>Motherboard Repair: </strong>Self-Taught Electronic Board Repair and Diagnosis.</p>
          </div><!--/.tertiary-->
        </div>
        
      </div><!--.col-wrap-->
    </div>  
  </div>
	<footer class="main-footer">
		<span>&copy;2024 Seolynn and CorollaYanki.</span>
	</footer>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
  <script>
    const constraints = {
      
      inputEmail: {
        presence: { allowEmpty: false },
        email: true
      },
      issueDesc: {
        presence: { allowEmpty: false }
      }
   };

  const form = document.getElementById('issueForm');

  form.addEventListener('submit', function (event) {
    const formValues = {
      inputEmail: form.elements.inputEmail.value,
      issueDesc: form.elements.issueDesc.value
    };

    const errors = validate(formValues, constraints);

    if (errors) {
      event.preventDefault();
      const errorMessage = Object
        .values(errors)
        .map(function (fieldValues) { return fieldValues.join(', ')})
        .join("\n");

      alert(errorMessage);
    }
  }, false);
</script>

  </script>
</body>
</html>
