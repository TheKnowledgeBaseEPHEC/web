<header style="min-height: 30%">
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#univ">
                <h1>
                    Mot de passe oublié
                </h1>
            </a>
        </div>
    </div>
</header>

<section class="bg-primary" id="univ">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
                <?php
                print form_open('mdpoublie', array('id' => 'emailform'));
                echo '<p>';
                echo form_label("Email", "email") . '</p><p>';
                $data = array(
                    'name' => 'email',
                    'id' => 'email',
                    'placeholder' => 'Votre email',
                    'class' => 'form-control',
                );
                print form_input($data) . '</p><p>';

                $button = array(
                    'name' => 'mail_submit',
                    'value' => 'Modifier',
                    'class' => 'formsubmit',
                );
                print form_submit($button);
                print form_close() . '</p>';
                ?>
            </div>
        </div>
    </div>
</section>

<script>
    window.onload = function () {
        $(function () {
            $("#emailform").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    messages: {
                        email: {
                            required: "Veuillez entrer une addresse email",
                            email: "Veuillez entrer une addresse email valide"
                        }
                    },
                    showErrors: function (errorMap, errorList) {
                        for (var i = 0; errorList[i]; i++) {
                            errorList[i].message = '<i class="fa fa-exclamation-triangle"></i>  ' + errorList[i].message
                        }
                        this.defaultShowErrors()
                    }
                }
            });
        });
    }
</script>