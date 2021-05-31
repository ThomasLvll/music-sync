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
    if (element.checked) {
        span.classList.add("checked");
        if (label) label.classList.add("checked");
    } else {
        span.classList.remove("checked");
        if (label) label.classList.remove("checked");
    }
    if (element.disabled) {
        span.classList.add("disabled");
        if (label) label.classList.add("disabled");
    } else {
        span.classList.remove("disabled");
        if (label) label.classList.remove("disabled");
    }
}

function check_checkbox(element) {
    let label = document.querySelector("label[for='" + element.id + "']");
    let span = document.querySelector(".checkbox#" + element.id + "-checkbox");
    if (element.checked) {
        span.classList.add("checked");
        if (label) label.classList.add("checked");
    } else {
        span.classList.remove("checked");
        if (label) label.classList.remove("checked");
    }
    if (element.disabled) {
        span.classList.add("disabled");
        if (label) label.classList.add("disabled");
    } else {
        span.classList.remove("disabled");
        if (label) label.classList.remove("disabled");
    }
}

function toggle_radio() {
    document.querySelectorAll("input[name='" + this.name + "']").forEach(function(e) {
        check_radio(e);
    });
}

function toggle_checkbox() {
    check_checkbox(this);
}

function set_radio(id) {
    let radio = document.querySelector("#" + id);
    radio.hidden = "hidden";
    let label = document.querySelector("label[for='" + radio.id + "']");
    if (label) label.classList.add("radio-label");
    let span = document.createElement("span");
    span.classList.add("radio");
    span.id = radio.id + "-radio";
    radio.parentNode.insertBefore(span, radio);
    let mark = document.createElement("span");
    mark.id = radio.id + "-mark";
    mark.classList.add("mark");
    span.appendChild(mark);
    check_radio(radio);
    radio.addEventListener("change", toggle_radio);
    span.addEventListener("click", function() { radio.click(); });
}

function set_checkbox(id) {
    let checkbox = document.querySelector("#" + id);
    checkbox.hidden = "hidden";
    let label = document.querySelector("label[for='" + checkbox.id + "']");
    if (label) label.classList.add("checkbox-label");
    let span = document.createElement("span");
    span.classList.add("checkbox");
    span.id = checkbox.id + "-checkbox";
    checkbox.parentNode.insertBefore(span, checkbox);
    let mark = document.createElement("span");
    mark.id = checkbox.id + "-mark";
    mark.classList.add("mark");
    span.appendChild(mark);
    check_checkbox(checkbox);
    checkbox.addEventListener("change", toggle_checkbox);
    span.addEventListener("click", function() { checkbox.click(); });
}


function init() {
    let alert = document.querySelector("#alert");
    alert.addEventListener("click", hide_alert);
    alert.addEventListener("mouseover", function() { alert_timeout = clearTimeout(alert_timeout); });
    // show_alert("test");
    document.querySelectorAll("input[type='radio']").forEach(function(element) {
        set_radio(element.id);
    });
    document.querySelectorAll("input[type='checkbox']").forEach(function(element) {
        set_checkbox(element.id);
    });
}

document.body.onload = init;
