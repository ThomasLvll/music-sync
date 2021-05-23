<form id="signup-form" action="signup@signup"></form>
<div class="form-container" id="signup-form-container">
    <table>
        <tr>
            <span>
                <label hidden for="first-name">Prénom</label>
                <input id="first-name" name="first-name" type="text" placeholder="Prénom">
            </span>
            <span>
                <label hidden for="last-name">Nom de famille</label>
                <input id="last-name" name="last-name" type="text" placeholder="Nom de famille">
            </span>
        </tr>
        <div>
            <span style="column-span: all;">
                <label hidden for="user-name">Nom d'utilisateur</label>
                <input id="user-name" name="user-name" type="text" placeholder="Nom d'utilisateur">
            </span>
        </div>
        <div>
            <span>
                <label hidden for="password">Nouveau mot de passe</label>
                <input id="password" name="password" type="password" placeholder="Nouveau mot de passe">
            </span>
            <span>
                <label hidden for="confirm-password">Confirmez votre mot de passe</label>
                <input id="confirm-password" type="password" placeholder="Confirmez votre mot de passe">
            </span>
        </div>
        <div>
            <span style="column-span: all;">
                <button type="submit" class="yes">Inscription</button>
            </span>
        </div>
        <div>
            <span class="separator"></span>
        </div>
        <div>
            <span>
                <button onclick="open_page('login');">J'ai déjà un compte</button>
            </span>
        </div>
    </table>
</div>