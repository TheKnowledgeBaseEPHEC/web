<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#inscription"><h1>Inscription</h1></a>
        </div>
    </div>
</header>
<section class="bg-primary" id="inscription">
    <div class="container">
        <div class="row">
            <head>
                <title>My Form</title>
            </head>
            <body>

            <?php echo validation_errors(); ?>

            <?php echo form_open('form'); ?>

            <h5>Username</h5>
            <input type="text" name="username" value="" size="50" />

            <h5>Password</h5>
            <input type="text" name="password" value="" size="50" />

            <h5>Password Confirm</h5>
            <input type="text" name="passconf" value="" size="50" />

            <h5>Email Address</h5>
            <input type="text" name="email" value="" size="50" />

            <div><input type="submit" value="Submit" /></div>

            </form>

            </body>
        </div>
        </div>
    </div>
</section>