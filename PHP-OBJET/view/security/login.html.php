<div id="login_container">
    <div id="login_content">
        <h1 class="titre"><?=strtoupper($title)?></h1>
        <form action="index.php?url=security&action=login" method="post">
            <div class="line-input shadow p-2 my-3 rounded">
                <label for="username" clas="lab-30">IDENTIFIANT</label>
                <input type="text" id="username" name="username" value="" class="w60 form-control">
            </div>
            <div class="line-input shadow p-2 my-3 rounded">
                <label for="password" clas="lab-30">MOT DE PASSE</label>
                <input type="password" id="password" name="password" value="" class="w60 form-control">
            </div>
            <div class="line-button">
                <button class="btn btn-md btn-danger">Quitter</button>
                <p class="text-danger"><?=$message?></p>
                <button class="btn btn-md btn-primary">Se connecter</button>
            </div>
        </form>
    </div>
</div>