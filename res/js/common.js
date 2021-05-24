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

function toggle_checkbox() {
    let checkbox = this;
    let label = document.querySelector("label[for='" + this.id + "']");
    let span = document.querySelector(".checkbox#" + this.id + "-checkbox");
    (checkbox.checked) ? span.classList.add("checked") : span.classList.remove("checked");
    (checkbox.disabled) ? span.classList.add("disabled") : span.classList.remove("disabled");
    (checkbox.checked) ? label.classList.add("checked") : label.classList.remove("checked");
    (checkbox.disabled) ? label.classList.add("disabled") : label.classList.remove("disabled");
}

function set_checkbox(id) {
    let checkbox = document.querySelector("#" + id);
    checkbox.hidden = "hidden";
    let label = document.querySelector("label[for='" + checkbox.id + "']");
    if (label) {
        label.classList.add("checkbox-label");
        (checkbox.checked) ? label.classList.add("checked") : label.classList.remove("checked");
        (checkbox.disabled) ? label.classList.add("disabled") : label.classList.remove("disabled");
    }
    let span = document.createElement("span");
    span.classList.add("checkbox");
    span.id = checkbox.id + "-checkbox";
    (checkbox.checked) ? span.classList.add("checked") : span.classList.remove("checked");
    (checkbox.disabled) ? span.classList.add("disabled") : span.classList.remove("disabled");
    checkbox.parentNode.insertBefore(span, checkbox);
    let mark = document.createElement("span");
    mark.id = checkbox.id + "-mark";
    mark.classList.add("mark");
    span.appendChild(mark);
    checkbox.addEventListener("change", toggle_checkbox);
    span.addEventListener("click", function() { checkbox.click(); });
}


function init() {
    // show_alert("test");
    document.querySelectorAll("input[type='checkbox']").forEach(function(element) {
        set_checkbox(element.id);
    });
}

document.body.onload = init;
