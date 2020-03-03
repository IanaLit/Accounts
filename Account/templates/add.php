
<?php include __DIR__ . '/header.php'; ?>

<!-----------Добавление записи-------------->

<div class="container">
<div class="row">
        <div class="col-md-12">

        <h3>Создание аккаунта</h3>

        <?php if (!empty($error)): ?>
            <div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
        <?php endif; ?>

        <form action="/accounts/add" method="post">
            <div class="form-group">
                <input type="hidden" class="form-control" name="id">
                <label>First name <input type="text" class="form-control" name="first_name" value="<?= $_POST['first_name'] ?? '' ?>"></label>
            </div>
            <div class="form-group">
                <label>Last name <input type="text" class="form-control" name="last_name" value="<?= $_POST['last_name'] ?? '' ?>"></label>
            </div>
            <div class="form-group">
                <label>Email <input type="text" class="form-control" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
            </div>
            <div class="form-group">
                <label>Company name <input type="text" class="form-control" name="company_name" value="<?= $_POST['company_name'] ?? '' ?>"></label>
             </div>
             <div class="form-group">
                 <label>Position <input type="text" class="form-control" name="position" value="<?= $_POST['position'] ?? '' ?>"></label>
            </div>
            <div class="form-group">
                <label>Work phone <input type="text" class="form-control" name="work_phone" value="<?= $_POST['work_phone'] ?? '' ?>"></label>
            </div>
            <div class="form-group">
                <label>Home phone <input type="text" class="form-control" name="home_phone" value="<?= $_POST['home_phone'] ?? '' ?>"></label>
            </div>
            <div class="form-group">
                <label>Mobile phone <input type="text" class="form-control" name="mobile_phone" value="<?= $_POST['mobile_phone'] ?? '' ?>"></label>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Сохранить">
        </div>
        </form>
   

<?php include __DIR__ . '/footer.php'; ?> 
</div>
</div>
</div>