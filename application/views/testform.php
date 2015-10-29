<header>
    <div class="header-content">
        <div class="header-content-inner">
            <h1>Knowledge Base</h1>
        </div>
    </div>
</header>

<section class="bg-primary" id="error">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 text-center">
                <div class="input-group">

                    <?php
                    print form_open('/testsubmit');

                    $data = array(
                        'name' => 'username',
                        'id' => 'username',
                        'value' => 'johndoe',
                        'maxlength' => '100',
                        'size' => '50',
                        'style' => 'width:50%',
                        'class' => 'form-control',
                    );

                    $button = array(
                        'name' => 'submit',
                        'value' => 'Go',
                        'class' => 'btn btn-default',
                    );

                    print form_input($data);

                    print form_submit($button);

                    ?>
                </div>
                <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->

    </div>
</section>
