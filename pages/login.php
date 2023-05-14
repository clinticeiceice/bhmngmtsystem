<?php

use App\Helpers\Routing;
use App\Services\Auth;

include_once __DIR__ . '/layout/header.php'; 

// Logic here
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = Auth::attempt($_POST['username'], $_POST['password']);

    if($result) {
        // Redirect to page /home
        Routing::redirect('/home');
    } 
}
?>

<!-- Design here -->

<div class="container vh-100">
    <div class="row justify-content-center align-content-center vh-100">
        <div class="col col-md-3 card p-3 m-2 shadow">
            <h4 class="card-title text-center">
                Login
            </h4>
            
            <form action="" method="post">
                <?php
                    if(isset($result) && $result == false) {
                        echo '
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> Invalid Credentials.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        ';
                    }
                ?>
                <div class="form-group my-2">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>">
                </div>

                <div class="form-group my-2">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>

                <div class="form-group d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/layout/footer.php'; ?>