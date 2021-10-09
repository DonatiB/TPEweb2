{include file='templates/header.tpl'}

<div class="container-login">
    <div class="login-container">
        <div class="register">
            <h2>REGISTRATION</h2>
            <form class="form-floating" action="verify" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control nombre" name="email" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control correo" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <input type="submit" class="submit" value="CHECK IN">
            </form>
        </div>
        <div class="login">
            <h2>Log In</h2>
            <div class="login-items">
                <button class="fb"><i class="fab fa-facebook-f"></i> Access with Facebook</button>
                <button class="tw"><i class="fab fa-twitter"></i> Access with Twitter</button>
                <button class="correo"><i class="fas fa-envelope"></i> Access with Correo</button>
            </div>
        </div>
        <h4 class="alert-danger">{$error}</h4>
    </div>
</div>

{include file='templates/footer.tpl'} 