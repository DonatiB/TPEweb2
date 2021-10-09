{include file='templates/header.tpl'}

<div class="container-login">
    <div class="login-container">
        <div class="register">
            <h2>REGISTARTION</h2>
            <form action="newUser" method="post">
                <input type="text" placeholder="Email" class="correo" name="email" required>
                <input type="password" placeholder="Confirm Password" class="repass" name="password" required>
                <input type="submit" class="submit" value="SAVE">
            </form>
            <a class="navbar-brand" href="login">Log In</a>
        </div>
    </div>
</div>

{include file='templates/footer.tpl'} 