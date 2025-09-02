<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-3  d-flex align-items-center justify-content-center ">
        <form action="<?= site_url('welcome/saveRegister')?>" class=" col-lg-6 col-sm-6 col-12" method="POST"
            enctype="multipart/form-data">
            <div class="row  shadow-lg p-3 mb-5 bg-body rounded ">
                <h2 class="text-center">Register</h2>

                <?php if($this->session->flashdata('success')){?>
                <div class="alert alert-success text-center">
                    <strong><?php echo $this->session->flashdata('success') ?></strong>
                </div>
                <?php } elseif($this->session->flashdata('error')){ ?>
                <div class="alert alert-danger text-center">
                    <strong><?php echo $this->session->flashdata('error') ?></strong>
                </div>
                <?php } ?>

                <div class="col-lg-12 col-sm-12 col-12">
                    <label class="mb-2">Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control mb-3 onlyAlpha" name="name" placeholder="Enter Name"
                        autocomplete="off" value="<?= set_value('name')?>">
                    <span class="text-danger"><?= form_error('name'); ?></span>
                </div>

                <div class="col-lg-12 col-sm-12 col-12 mb-3">
                    <label class="mb-2">Email<span class="text-danger">*</span> </label>
                    <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off"
                        value="<?= set_value('email')?>">
                    <span class="text-danger"><?= form_error('email'); ?></span>
                </div>

                <div class="col-lg-12 col-sm-12 col-12 mb-3">
                    <label class="mb-2">Password<span class="text-danger">*</span> </label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        autocomplete="off" value="<?= set_value('password')?>">
                    <span class="text-danger"><?= form_error('password'); ?></span>
                </div>
                <div class="col-lg-12 col-sm-12 col-12 mb-3">
                    <label class="mb-2">Profile<span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="profile" id="profile" autocomplete="off">
                    <?php if (!empty($profile_error)): ?>
                    <span class="text-danger"><?= $profile_error ?></span>
                    <?php else: ?>
                    <span class="text-danger"><?= form_error('profile'); ?></span>
                    <?php endif; ?>
                </div>

                <div class="col-lg-12 col-sm-12 col-12 mb-3">
                    <button type="submit" class="btn btn-primary col-12">Register</button>
                </div>
                <div class="col-lg-12 col-sm-12 col-12 mb-3 text-center">
                    <span>Already have an account?<span> <a href="<?= base_url('') ?>" class="btnLogIn">LogIn</a>

                </div>
            </div>
        </form>
    </div>


    <style>
    .btnLogIn {
        text-decoration: none;
        font-weight: 700;

    }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    let alphabets = document.querySelectorAll('.onlyAlpha');
    alphabets.forEach(input => {
        input.onkeydown = (e) => {
            // Allow letters, backspace, tab, delete, space, and arrow keys
            if (
                !/[a-zA-Z]/.test(e.key) &&
                e.key !== 'Backspace' &&
                e.key !== 'Tab' &&
                e.key !== 'Delete' &&
                e.key !== ' ' && // Allow space
                !e.key.startsWith('Arrow') // Allow arrow keys
            ) {
                e.preventDefault();
            }
        };
    });

    setTimeout(function() {
        $('.alert').alert('close')
    }, 5000)
    </script>
</body>

</html>