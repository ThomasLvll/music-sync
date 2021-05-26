<div id="alert" class="clickable" onclick="hide_alert();"></div>
<div id="sidebar">
    <div id="sidebar-header">
        <div class="menu-item" onclick="open_page('home');">
            <div class="icon-container"><svg viewBox="0 0 50 50"><?= read("./res/img/icons/home.svg") ?></svg></div>
            <div class="extension"><span>Accueil</span></div>
        </div>
    </div>
    <div id="sidebar-services">
        <?php
        foreach ($services as $service) {
        ?>
        <div class="menu-item" id="<?= $service["name"] ?>-service" disabled>
            <div class="icon-container"><img src="./res/img/icons/services/<?= $service["name"] ?>"></div>
            <div class="extension">
                <div><?= $service["nicename"] ?></div>
                <div>
                    <div class="indicator"></div><span class="subtitle">Déconnecté</span>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <!--
        <div class="menu-item" id="spotify-service">
            <div class="icon-container"><img src="./res/img/icons/services/spotify.png"></div>
            <div class="extension">
                <div>Spotify</div>
                <div>
                    <div class="indicator"></div><span class="subtitle">12 playlists</span>
                </div>
            </div>
        </div>
        <div class="menu-item" id="apple-music-service" disabled>
            <div class="icon-container"><img src="./res/img/icons/services/apple-music.png"></div>
            <div class="extension">
                <div>Apple Music</div>
                <div>
                    <div class="indicator"></div><span class="subtitle">Déconnecté</span>
            </div>
            </div>
        </div>
        -->
    </div>
    <div class="separator"></div>
    <div id="sidebar-footer">
        <div class="menu-item" onclick="open_page('<?= ($user) ? "account" : "login" ?>');">
            <div class="icon-container"><svg viewBox="0 0 50 50"><?= read("./res/img/icons/avatar.svg") ?></svg></div>
            <div class="extension"><span><?= ($user) ? $user["first_name"] : "Connexion" ?></span></div>
        </div>
    </div>
</div>
