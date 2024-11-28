<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: 0;
    font-family: 'Poppins', sans-serif;
}

html, body {
    height: 100%; 
    margin: 20px 0 0 0; 
    padding: 0;
}

body{
    background: url("../../images/login/1.jpg");
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
    background-repeat: no-repeat;

    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 0 20px;
    flex-direction: column;
}

.form-container{
    display: flex;
    width: 1000px;
    height: 600px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 30px;
    backdrop-filter: blur(20px);
    overflow: hidden;
}

.back-to-index i{
    position: absolute;
    display: flex;
    font-size: 40;
    left: 2%;
    top: 2%;
    color: black;
    z-index: 99;
}

.col-1{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: 55%;
    background: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(30px);
    border-radius: 0 30% 20% 0;
    transition: border-radius .3s;
}

.image-layer{
    position: relative;
}

.form-image-main{
    width: 400px;
    animation: scale-up 3s ease-in-out alternate infinite;
}

.form-image{
    position: absolute;
    left: 0;
    width: 400px;
}

.coin{
    animation: scale-down 3s ease-in-out alternate infinite;
}

.spring{
    animation: scale-down 3s ease-in-out alternate infinite;
}

.dots{
    animation: scale-up 3s ease-in-out alternate infinite;
}

.rocket{
    animation: up-down 3s ease-in-out alternate infinite;
}

.cloud{
    animation: left-right 3s ease-in-out alternate infinite;
}

.stars{
    animation: scale-down 3s ease-in-out alternate infinite;
}

@keyframes left-right{
    to{
        transform: translateX(10px);
    }
}
@keyframes up-down{
    to{
        transform: translateY(10px);
    }
}
@keyframes scale-down{
    to{
        transform: scale(0.95);
    }
}
@keyframes scale-up{
    to{
        transform: scale(1.05);
    }
}

.featured-words{
    text-align: center;
    color: #fff;
    width: 300px;
}

.featured-words span{
    font-weight: 600;
    color: #21264D;
}

.col-2{
    position: relative;
    width: 45%;
    padding: 20px;
    overflow: hidden;
}

.btn-box{
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
}

.btn{
    font-weight: 500;
    padding: 5px 30px;
    border: none;
    border-radius: 30px;
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: .2s;
}

.btn-1{
    background: #21264D;
}

.btn:hover{
    opacity: 0.85;
}

form .login-form{
    position: absolute;
    top: 18%;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    padding: 0 0 4vw;
    transition: .3s;
}

.register-form{
    position: absolute;
    left: -50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    padding: 0 0 4vw;
    transition: .3s;
    opacity: 0;
}

.register-form .form-title{
    margin-block: 30px 20px;
}

.form-title{
    margin: 40px 0;
    color: #fff;
    font-size: 28px;
    font-weight: 600;
}

.form-inputs{
    width: 80%
}

.input-box{
    position: relative;
}

.input-field{
    width: 100%;
    height: 55px;
    padding: 0 15px;
    margin: 10px 0;
    color: #fff;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 10px;
    outline: none;
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

::placeholder{
    color: #fff;
    font-size: 15px;
}

.input-box .icon{
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    color: #fff;
}
.forgotpwd{
    display: flex;
    justify-content: center;
}

.forgotpwd a{
    color: #fff;
    text-decoration: none;
    font-size: 14px;
}

.forgotpwd a:hover{
    text-decoration: underline;
    cursor: pointer;
}

.input-submit{
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    height: 55px;
    padding: 0 15px;
    margin: 10px 0;
    color: #fff;
    background: #21264D;
    border: none;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    transition: .3s;
}

.input-submit:hover{
    gap: 15px;
}

.lock-box:hover{
    cursor: pointer;
}

.footer 
    {
        width: 100%; 
        display: flex; 
        justify-content: center;
        align-items: center; 
        font-size: 13px;
        margin-top: 20px;
        margin-bottom, margin-left, margin-right: 0px;
    }

    .footer .copyright {
        padding: 0.9375rem;
    }

    .footer .copyright p {
        text-align: center;
        margin: 0;
    }

    .footer .copyright a {
        color: var(--primary);
    }

@media (max-width: 892px) {
    .form-container{
        width: 400px;
    }
    .back-to-index i{
        left: 3%;
        top: 5.5%;
    }
    .col-1{
        display: none;
    }
    .col-2{
        width: 100%;
    }
}
</style>