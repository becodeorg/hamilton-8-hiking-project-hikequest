<form action="#" method="post">
    <div>
        <label for="firstname">Firstname</label>
        <input type="text" id="firstname" name="firstname" value="<?= $_SESSION['user']['firstname'] ?>"/>
    </div>
    <div>
        <label for="lastname">Lastname</label>
        <input type="text" id="lastname" name="lastname" value="<?= $_SESSION['user']['lastname'] ?>"/>
    </div>
    <div>
        <label for="nickname">Nickname</label>
        <input type="text" id="nickname" name="nickname" value="<?= $_SESSION['user']['nickname'] ?>"/>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>"/>
    </div>
    <button type="submit">Update</button>
</form>