<header>
    <div class="header-content">
        <div class="header-content-inner">
            <a class="page-scroll white-link" href="#profile"><h1>Ma séance</h1></a>
        </div>
    </div>
</header>
<section class="bg-primary" id="profile">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <p><table class="table-tuto table-curved">
                    <tr>
                        <th>Avec</th>
                        <th>Cours</th>
                        <th>Date</th>
                    </tr>

                    <?php
                    foreach ($maSeance as $item) { ?>
                        <tr>
                            <td><?php print $item->NomDemandeur; ?></td>
                            <td><?php print $item->IntituleCours; ?></td>
                            <td><?php print $item->startDate; ?></td>
                        </tr>
                    <?php  }
                    ?>
                </table></p>
                <?php
                if ($item->idDemander === $this->session->userdata('user_id'))
                {
                    if ($item->confirmDemander == 0)
                    {
                        print '<p>' . form_open('');
                        $button = array(
                            'name' => 'priseContact',
                            'value' => 'Prendre contact',
                            'class' => 'formsubmit',
                        );
                        print  '</p>' . form_submit($button);

                        print '<p>' . form_open('');
                        $button = array(
                            'name' => 'confirmer',
                            'value' => 'Confirmer',
                            'class' => 'formsubmit',
                        );
                        print  '</p>' . form_submit($button);
                        form_close();
                    } else
                    {
                        print '<p>' . form_open('');
                        $button = array(
                            'name' => 'contact',
                            'value' => 'Prendre contact',
                            'class' => 'formsubmit',
                        );
                        print  '</p>' . form_submit($button);
                        form_close();
                    }

                } else
                {
                    print '<p>' . form_open('');
                    $button = array(
                        'name' => 'contactMS',
                        'value' => 'Prendre contact',
                        'class' => 'formsubmit',
                    );
                    print  '</p>' . form_submit($button);
                    form_close();

                    print '<p>' . form_open('');
                    $button = array(
                        'name' => 'deleteSc',
                        'value' => 'Supprimer',
                        'class' => 'formsubmit',
                    );
                    print  '</p>' . form_submit($button);
                    form_close();
                }?>


            </div>
        </div>
    </div>
</section>