<?php include __DIR__ . '/header.php'; ?>

<!-----------Страница записи-------------->

  <div class="container">
    <div class="row">
        <div class="col-md-12">

        <h3>Аккаунт <?= $account->getId() ?></h3>

         <form action="/accounts/<?= $account->getId() ?>/edit" method="post">

            <div class="form-group">
                <input type="hidden" class="form-control" name="id" value="<?= $account->getId() ?>">
                <label>First name <input type="text" class="form-control" name="first_name" value="<?= $account->getFirstName() ?>"></label>
            </div>
            <div class="form-group">
                <label>Last name <input type="text" class="form-control" name="last_name" value="<?= $account->getLastName() ?>"></label>
            </div>
            <div class="form-group">
                <label>Email <input type="text" class="form-control" name="email" value="<?= $account->getEmail() ?>"></label>
            </div>
            <div class="form-group">
                <label>Company name <input type="text" class="form-control" name="company_name" value="<?= $account->getCompanyName() ?>"></label>
             </div>
             <div class="form-group">
                <label>Position <input type="text" class="form-control" name="position" value="<?= $account->getPosition() ?>"></label>
            </div>
            <div class="form-group">
                <label>Work phone <input type="text" class="form-control" name="work_phone" value="<?= $account->getWorkPhone() ?>"></label>
            </div>
            <div class="form-group">
                <label>Home phone <input type="text" class="form-control" name="home_phone" value="<?= $account->getHomePhone() ?>"></label>
            </div>
            <div class="form-group">
                <label>Mobile phone <input type="text" class="form-control" name="mobile_phone" value="<?= $account->getMobilePhone() ?>"></label>
            </div>
            <div class="form-group">
            <input type="submit" class="btn btn-success" value="Изменить">
            </div>
        </form>
        
            <div class="form-group">
                <a href="<?= $account->getId() ?>/delete" class="btn btn-danger"> Удалить</a>
            </div>
           
<?php include __DIR__ . '/footer.php'; ?>
</div>
        </div>
      </div>