<div class="form-container" id="login-form-container">
    <form id="login-form" action="login@login">
        <div>
            <label hidden for="user-name-or-email">Nom d'utilisateur ou adresse e-mail</label>
            <input id="user-name-or-email" name="user-name-or-email" type="text" placeholder="Nom d'utilisateur ou adresse e-mail">
        </div>
        <div>
            <label hidden for="password">Mot de passe</label>
            <input id="password" name="password" type="password" placeholder="Mot de passe">
        </div>
        <div>
            <input type="checkbox" name="check1" id="check1"><label for="check1">Checkbox</label>
        </div>
        <div>
            <input type="checkbox" name="check2" id="check2" checked><label for="check2">Checkbox</label>
        </div>
        <div>
            <input type="checkbox" name="check3" id="check3" disabled><label for="check3">Checkbox</label>
        </div>
        <div>
            <input type="checkbox" name="check4" id="check4" disabled checked><label for="check4">Checkbox</label>
        </div>
        <div>
            <button type="submit" class="yes">Connexion</button>
        </div>
        <div>
            <a href="?page=forgot-password">Mot de passe oublié ?</a>
        </div>
    </form>
    <div class="separator"></div>
    <div>
        <button onclick="open_page('signup');">Créer un compte</button>
    </div>
</div>
