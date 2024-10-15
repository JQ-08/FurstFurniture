<script>
const loginBtn = document.querySelector("#login");
const registerBtn = document.querySelector("#register");
const loginForm = document.querySelector(".login-form");
const registerForm = document.querySelector(".register-form");

loginBtn.addEventListener('click', () => {
    loginBtn.style.backgroundColor = "#21264D";
    registerBtn.style.backgroundColor = "rgba(255, 255, 255, 0.2)";

    loginForm.style.left = "50%";
    registerForm.style.left = "-50%";

    loginForm.style.opacity = 1;
    registerForm.style.opacity = 0;

    document.querySelector(".col-1").style.borderRadius = "0 30% 20% 0"
});

registerBtn.addEventListener('click', () => {
    loginBtn.style.backgroundColor = "rgba(255, 255, 255, 0.2)";
    registerBtn.style.backgroundColor = "#21264D";

    loginForm.style.left = "150%";
    registerForm.style.left = "50%";

    loginForm.style.opacity = 0;
    registerForm.style.opacity = 1;

    document.querySelector(".col-1").style.borderRadius = "0 20% 30% 0"
});

function myLogPassword(){

var a = document.getElementById('logPwd');
var b = document.getElementById('lock');
var c = document.getElementById('lock-open');

if(a.type === "password") {
    a.type = "text";
    b.style.opacity = "0";
    c.style.opacity = "1";

}else{
    a.type = "password";
    b.style.opacity = "1";
    c.style.opacity = "0";
}

}

function myRegPassword(){

var d = document.getElementById('regPwd');
var e = document.getElementById('lock2');
var f = document.getElementById('lock-open2');

if(d.type === "password") {
    d.type = "text";
    e.style.opacity = "0";
    f.style.opacity = "1";

}else{
    d.type = "password";
    e.style.opacity = "1";
    f.style.opacity = "0";
}

}

function myRegPassword2(){

var g = document.getElementById('regPwd2');
var h = document.getElementById('lock3');
var i = document.getElementById('lock-open3');

if(g.type === "password") {
    g.type = "text";
    h.style.opacity = "0";
    i.style.opacity = "1";

}else{
    g.type = "password";
    h.style.opacity = "1";
    i.style.opacity = "0";
}
}
</script>