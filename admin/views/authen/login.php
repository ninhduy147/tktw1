<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="./css/main.css"> -->
  <link rel="stylesheet" href="./fontawesome-free-6.5.2-web/css/all.css">
  <link rel="stylesheet" href="./css/login.css">
  <style>
    .err {
      color: red;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <section class="vh-100" style="background: url(./img/banner/2.png) ;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-5">Log in</h3>

              <form action="" method="POST">


                <?php if (isset($_SESSION['errors'])) : ?>
                  <div class="alert alert-danger">
                    <?= $_SESSION['errors'] ?>
                  </div>
                  <?php unset($_SESSION['errors']) ?>
                <?php endif; ?>

                <div data-mdb-input-init class="form-outline mb-4">
                  <input placeholder="Email" name="email_customer" type="email" id="typeEmailX-2" class="form-control form-control-lg" />
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                  <input placeholder="Password" name="password_customer" type="password" id="typePasswordX-2" class="form-control form-control-lg" />
                </div>

                <!-- Checkbox -->
                <div class="form-check d-flex justify-content-start mb-4">
                  <input style="margin-right: 10px;" class="form-check-input" type="checkbox" value="" id="form1Example3" />
                  <label class="form-check-label" for="form1Example3"> Remember password </label>
                </div>

                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" name="login" type="submit">Login</button>

              </form>
              <hr class="my-4">
              <button data-mdb-button-init data-mdb-ripple-init class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39; margin-bottom: 10px;" type="submit"><i class="fab fa-google me-2"></i> Sign in with google</button>
              <button data-mdb-button-init data-mdb-ripple-init class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;" type="submit"><i class="fab fa-facebook-f me-2"></i>Sign in with facebook</button>
              <div class="text-center mt-4">
                <a class="small" href="<?= BASE_URL_ADM ?>?act=register">Chưa có tài khoản? Ấn vào đây để tạo tài khoản!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>