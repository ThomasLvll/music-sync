function redirect(URL) {
    window.location.href = URL;
}

function open_page(page_name) {
    redirect("?page=" + page_name);
}

function open_action(action_name) {
    redirect("?action=" + action_name);
}

function hide_alert() {
    let e = document.querySelector("#alert");
    e.classList.remove("shown");
}

function show_alert(msg, color = "hsl(360, 100%, 80%)") {
    let e = document.querySelector("#alert");
    e.innerText = msg;
    e.style.background = color;
    e.classList.add("shown");
}


function init() {
    // show_alert("test");
}

document.body.onload = init;
