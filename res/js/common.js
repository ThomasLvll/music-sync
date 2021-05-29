function redirect(URL) {
    window.location.href = URL;
}

function open_page(page_name, params = {}) {
    let params_part = [];
    for (const k in params) {
        const v = params[k];
        params_part.push(encodeURIComponent(k) + ":" + encodeURIComponent(v));
    }
    redirect("?page=" + page_name + "&page-params=" + params_part.join(","));
}

function open_action(action_name, params = {}) {
    let params_part = "";
    for (const k in params) {
        const v = params[k];
        params_part.push(encodeURIComponent(k) + ":" + encodeURIComponent(v));
    }
    redirect("?action=" + action_name + "&action-params=" + params_part.join(","));
}

let alert_timeout;

function hide_alert() {
    let e = document.querySelector("#alert");
    e.classList.remove("shown");
    alert_timeout = clearTimeout(alert_timeout);
}

function show_alert(msg, color = "#dfdfdf", timeout = 0) {
    let e = document.querySelector("#alert");
    e.innerText = msg;
    e.style.background = color;
    e.classList.add("shown");
    if (timeout) alert_timeout = setTimeout(hide_alert, timeout * 1000);
}

function check_radio(element) {
    let label = document.querySelector("label[for='" + element.id + "']");
    let span = document.querySelector(".radio#" + element.id + "-radio");
    (element.checked) ? span.classList.add("checked") : span.classList.remove("checked");
    (element.disabled) ? span.classList.add("disabled") : span.classList.remove("disabled");
    (element.checked) ? label.classList.add("checked") : label.classList.remove("checked");
    (element.disabled) ? label.classList.add("disabled") : label.classList.remove("disabled");
}

function check_checkbox(element) {
    let label = document.querySelector("label[for='" + element.id + "']");
    let span = document.querySelector(".checkbox#" + element.id + "-checkbox");
    (element.checked) ? span.classList.add("checked") : span.classList.remove("checked");
    (element.disabled) ? span.classList.add("disabled") : span.classList.remove("disabled");
    (element.checked) ? label.classList.add("checked") : label.classList.remove("checked");
    (element.disabled) ? label.classList.add("disabled") : label.classList.remove("disabled");
}

function toggle_radio() {
    document.querySelectorAll("input[name='" + this.name + "']:not(#" + this.id + ")").forEach(function(e) {
        check_radio(e);
    });
    check_radio(this);
}

function toggle_checkbox() {
    check_checkbox(this);
}

function set_radio(id) {
    let radio = document.querySelector("#" + id);
    radio.hidden = "hidden";
    let label = document.querySelector("label[for='" + radio.id + "']");
    if (label) {
        label.classList.add("radio-label");
        (radio.checked) ? label.classList.add("checked") : label.classList.remove("checked");
        (radio.disabled) ? label.classList.add("disabled") : label.classList.remove("disabled");
    }
    let span = document.createElement("span");
    span.classList.add("radio");
    span.id = radio.id + "-radio";
    (radio.checked) ? span.classList.add("checked") : span.classList.remove("checked");
    (radio.disabled) ? span.classList.add("disabled") : span.classList.remove("disabled");
    radio.parentNode.insertBefore(span, radio);
    let mark = document.createElement("span");
    mark.id = radio.id + "-mark";
    mark.classList.add("mark");
    span.appendChild(mark);
    radio.addEventListener("change", toggle_radio);
    span.addEventListener("click", function() { radio.click(); });
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
    document.querySelectorAll("input[type='radio']").forEach(function(element) {
        set_radio(element.id);
    });
    document.querySelectorAll("input[type='checkbox']").forEach(function(element) {
        set_checkbox(element.id);
    });
}

document.body.onload = init;
