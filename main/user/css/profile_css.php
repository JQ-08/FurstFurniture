<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
html{
    margin: 0;
    height: 100vh;
}
body{
    position: relative;
    margin: 0;
    height: 100vh;
    background-color: #F4F4F4;
    font-family: Poppins;
    z-index: 0;
}
:root{
    --item1-transform: translateX(-100%) translateY(-5%) scale(1.5);
    --item1-filter: blur(30px);
    --item1-zIndex: 11;
    --item1-opacity: 0;

    --item2-transform: translateX(0);
    --item2-filter: blur(0px);
    --item2-zIndex: 10;
    --item2-opacity: 1;

    --item3-transform: translate(50%,10%) scale(0.8);
    --item3-filter: blur(10px);
    --item3-zIndex: 9;
    --item3-opacity: 1;

    --item4-transform: translate(90%,20%) scale(0.5);
    --item4-filter: blur(30px);
    --item4-zIndex: 8;
    --item4-opacity: 1;
    
    --item5-transform: translate(120%,30%) scale(0.3);
    --item5-filter: blur(40px);
    --item5-zIndex: 7;
    --item5-opacity: 0;
}
header{
    width: 1140px;
    max-width: 100%;
    display: flex;
    justify-content: space-between;
    margin: auto;
    height: 50px;
    align-items: center;
    background-color: transparent; /* Optional: semi-transparent background */
}
header .logo img{
    position: relative;
    left: -3%;
    width: 28%;
}
header nav a{
    position: relative;
    left: 6%;
    margin-left: 30px;
    text-decoration: none;
    color: #555;
    font-weight: 500;  
    background-color: transparent;  
}

header nav a:hover, header nav a span.material-symbols-outlined:hover{
    color: black;
    transition: 0.3s ease;
}
header nav a span.material-symbols-outlined {
    position: relative;
    top: 0px; 
    font-size: 22px; 
    color: #555; 
    vertical-align: middle;
}

header nav a span.material-symbols-outlined {
    position: relative;
    top: 0px; 
    font-size: 22px; 
    color: #333; 
    vertical-align: middle;
}

.content {
    display: flex;
    width: 1000px;
    height: 390px;
    border: solid 2px;
    margin: 70px 0 0 185px;
    border-radius: 20px;
}

.content .title p {
    margin: 50px 0 0 125px;;
    font-weight: 800;
    font-size: 30px;
}

.content .title img {
    width: 220px;
    height: 200px;
    border-radius: 20px;
    border: solid 2px;
    margin: 15px 0 0 100px;
}

.details{
    margin: 70px 0 0 100px;
}

.details .name p{
    margin: 7px 0 20px 9px;
    font-weight: 800;
    font-size: 40px;
}

.details .id {
    display: flex;
    margin-left: 10px;
}

.details .id p{
    margin: 0 0 20px 10px;
    font-weight: 400;
    font-size: 20px;
}

.details .email {
    display: flex;
    margin-left: 10px;
}

.details .email p{
    margin: -2px 0 20px 10px;
    font-weight: 400;
    font-size: 20px;
}

.details .pwd {
    display: flex;
    margin-left: 10px;
}

.details .pwd p{
    margin: 0 0 20px 10px;
    font-weight: 400;
    font-size: 20px;
}

.details .edit button{
    font-size: 20px;
    width: 150px;
    height: 40px;
    border-radius: 30px;
    margin: 10px 0 0 370px;
    cursor: pointer;
}

.details .edit button:hover {
    background-color: black;
    color: white;
    transition: 0.5s ease;
}


.footer {
        display: flex; 
        justify-content: center; 
        align-items: center; 
        padding: 1rem; 
        background-color: #f6f6f6;
        font-size: 13px;
        margin-top: 0;
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
</style>