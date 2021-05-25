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
        <div style="text-align: left;">
            <input type="checkbox" name="stay-logged" id="stay-logged"><label for="stay-logged">Rester connecté(e)</label>
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
