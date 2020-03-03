<?php include __DIR__ . '/header.php'; ?>

<!-----------Главная страница-------------->

<div class="container">
     <div class="row">
      <div class="col-md-12">

            <div class="row">
                <a href="accounts/add" class="btn btn-success"> Создать аккаунт</a>
            </div>
            <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>First name</th>
                      <th>Last name</th>
                      <th>Email adress</th>
                      <th>Company name</th>
                      <th>Position</th>
                      <th>Work phone</th>
                      <th>Home phone</th>
                      <th>Mobile phone</th>
                    </tr>
                  </thead>
                  <tbody>

                   <?php foreach ($accounts as $account): ?>

                      <tr> 
                          <td><a href="/accounts/<?= $account->getId() ?>"><?= $account->getId() ?></a></td>
                          <td><?= $account->getFirstName() ?></td>
                          <td><?= $account->getLastName() ?></td>
                          <td><?= $account->getEmail() ?></td>
                          <td><?= $account->getCompanyName() ?></td>
                          <td><?= $account->getPosition() ?></td>
                          <td><?= $account->getWorkPhone() ?></td>
                          <td><?= $account->getHomePhone() ?></td>
                          <td><?= $account->getMobilePhone() ?></td>          
                      </tr>

                    <?php endforeach; ?>

                  </tbody>
            </table>
<!-----------------------Пагинация---------------------->
                <?php if ($pagination->countPages > 1) :?>
                    <?=$pagination;?>
                <?php endif;?>


<?php include __DIR__ . '/footer.php'; ?> 
</div>
        </div>