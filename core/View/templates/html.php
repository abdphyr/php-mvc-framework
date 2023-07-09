<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo navigate('contact') ?>">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo navigate('user-profile') ?>">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo navigate('api-master') ?>">Api</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <?php  $user = auth()->user()  ?>
          <?php if ($user) : ?>
            <li class="nav-item">
              <a class="nav-link" href="/logout">Logout</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/register">Register</a>
            </li>
          <?php endif ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <?php  $message = session()->getFlash('success')  ?>
    <?php if ($message) : ?>
      <div class="alert alert-success">
        <?php echo  session()->getFlash('success')  ?>
      </div>
    <?php endif ?>
    
<div>
    <?php if ($firstname == 'Abdumannon') : ?>
        <div>Ok</div>
    <?php else : ?>
        <div>Noooo</div>
    <?php endif ?>
</div>
<div>
    <?php foreach($ar as $key => $item) : ?>
        <div><?php echo  $item  ?></div>
    <?php endforeach ?>

    <?php for($i=0; $i<=10; $i++) : ?>
        <div><?php echo  $i  ?></div>
    <?php endfor ?>
</div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>