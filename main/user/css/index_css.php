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
header nav a span.material-symbols-outlined {
    position: relative;
    top: 0px; 
    font-size: 22px; 
    color: #333; 
    vertical-align: middle;
}
/* carousel */
.carousel{
    position: relative;
    height: 100vh;
    overflow: hidden;
    margin-top: -50px;
    z-index:-1;
}
.carousel .list {
    position: absolute;
    width: 100%;
    max-width: 90%;
    height: 100%;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.carousel .list .item{
    position: absolute;
    left: -5%;
    width: 70%;
    max-width: 100%;
    height: 100%;
    font-size: 15px;
    transition: left 0.5s, opacity 0.5s, width 0.5s;
}
.carousel .list .item:nth-child(n + 6){
    opacity: 0;
}
.carousel .list .item:nth-child(2){
    z-index: 10;
    transform: translateX(0);
}
.carousel .list .item img{
    width: 45%;
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    transition: right 1.5s;
}

.carousel .list .item .introduce{
    opacity: 0;
    pointer-events: none;
}
.carousel .list .item:nth-child(2) .introduce{
    opacity: 1;
    pointer-events: auto;
    width: 400px;
    position: absolute;
    top: 50%;
    left: 115px;
    transform:  translateY(-50%);
    transition: opacity 0.5s;
}
.carousel .list .item .introduce .title{
    font-size: 2em;
    font-weight: 500;
    line-height: 1em;
}
.carousel .list .item .introduce .topic{
    font-size: 4em;
    font-weight: 500;
}
.carousel .list .item .introduce .des{
    font-size: small;
    color: #5559;
}
.carousel .list .item .introduce .seeMore{
    font-family: Poppins;
    margin-top: 1.2em;
    padding: 5px 0;
    border: none;
    border-bottom: 1px solid #555;
    background-color: transparent;
    font-weight: bold;
    letter-spacing: 3px;
    transition: background 0.5s;
    cursor: pointer;
}
.carousel .list .item .introduce .seeMore:hover{
    background: #eee;
}
.carousel .list .item:nth-child(1){
    transform: var(--item1-transform);
    filter: var(--item1-filter);
    z-index: var(--item1-zIndex);
    opacity: var(--item1-opacity);
    pointer-events: none;
}
.carousel .list .item:nth-child(3){
    transform: var(--item3-transform);
    filter: var(--item3-filter);
    z-index: var(--item3-zIndex);
}
.carousel .list .item:nth-child(4){
    transform: var(--item4-transform);
    filter: var(--item4-filter);
    z-index: var(--item4-zIndex);
}
.carousel .list .item:nth-child(5){
    transform: var(--item5-transform);
    filter: var(--item5-filter);
    opacity: var(--item5-opacity);
    pointer-events: none;
}
/* animation text in item2 */
.carousel .list .item:nth-child(2) .introduce .title,
.carousel .list .item:nth-child(2) .introduce .topic,
.carousel .list .item:nth-child(2) .introduce .des,
.carousel .list .item:nth-child(2) .introduce .seeMore{
    opacity: 0;
    animation: showContent 0.5s 1s ease-in-out 1 forwards;
}
@keyframes showContent{
    from{
        transform: translateY(-30px);
        filter: blur(10px);
    }to{
        transform: translateY(0);
        opacity: 1;
        filter: blur(0px);
    }
}
.carousel .list .item:nth-child(2) .introduce .topic{
    animation-delay: 1.2s;
}
.carousel .list .item:nth-child(2) .introduce .des{
    animation-delay: 1.4s;
}
.carousel .list .item:nth-child(2) .introduce .seeMore{
    animation-delay: 1.6s;
}
/* next click */
.carousel.next .item:nth-child(1){
    animation: transformFromPosition2 0.5s ease-in-out 1 forwards;
}
@keyframes transformFromPosition2{
    from{
        transform: var(--item2-transform);
        filter: var(--item2-filter);
        opacity: var(--item2-opacity);
    }
}
.carousel.next .item:nth-child(2){
    animation: transformFromPosition3 0.7s ease-in-out 1 forwards;
}
@keyframes transformFromPosition3{
    from{
        transform: var(--item3-transform);
        filter: var(--item3-filter);
        opacity: var(--item3-opacity);
    }
}
.carousel.next .item:nth-child(3){
    animation: transformFromPosition4 0.9s ease-in-out 1 forwards;
}
@keyframes transformFromPosition4{
    from{
        transform: var(--item4-transform);
        filter: var(--item4-filter);
        opacity: var(--item4-opacity);
    }
}
.carousel.next .item:nth-child(4){
    animation: transformFromPosition5 1.1s ease-in-out 1 forwards;
}
@keyframes transformFromPosition5{
    from{
        transform: var(--item5-transform);
        filter: var(--item5-filter);
        opacity: var(--item5-opacity);
    }
}
/* previous */
.carousel.prev .list .item:nth-child(5){
    animation: transformFromPosition4 0.5s ease-in-out 1 forwards;
}
.carousel.prev .list .item:nth-child(4){
    animation: transformFromPosition3 0.7s ease-in-out 1 forwards;
}
.carousel.prev .list .item:nth-child(3){
    animation: transformFromPosition2 0.9s ease-in-out 1 forwards;
}
.carousel.prev .list .item:nth-child(2){
    animation: transformFromPosition1 1.1s ease-in-out 1 forwards;
}
@keyframes transformFromPosition1{
    from{
        transform: var(--item1-transform);
        filter: var(--item1-filter);
        opacity: var(--item1-opacity);        
    }
}

/* detail  */
.carousel .list .item .detail{
    opacity: 0;
    pointer-events: none;
}
/* showDetail */
.carousel.showDetail .list .item:nth-child(3),
.carousel.showDetail .list .item:nth-child(4){
    left: 100%;
    opacity: 0;
    pointer-events: none;
}
.carousel.showDetail .list .item:nth-child(2){
    width: 100%;
}
.carousel.showDetail .list .item:nth-child(2) .introduce{
    opacity: 0;
    pointer-events: none;
}
.carousel.showDetail .list .item:nth-child(2) img{
    right: 50%;
    width: 35%;
}
.carousel.showDetail .list .item:nth-child(2) .detail{
    opacity: 1;
    width: 50%;
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    text-align: right;
    pointer-events: auto;
}
.carousel.showDetail .list .item:nth-child(2) .detail .title{
    font-size: 4em;
}
.carousel.showDetail .list .item:nth-child(2) .detail .specifications{
    display: flex;
    gap: 10px;
    width: 100%;
    border-top: 1px solid #5553;
    margin-top: 20px;
}
.carousel.showDetail .list .item:nth-child(2) .detail .specifications div{
    width: 90px;
    text-align: center;
    flex-shrink: 0;
}
.carousel.showDetail .list .item:nth-child(2) .detail .specifications div p:nth-child(1){
    font-weight: bold;
}
.carousel.carousel.showDetail .list .item:nth-child(2) .checkout button{
    font-family: Poppins;
    background-color: transparent;
    border: 1px solid #5555;
    margin-left: 5px;
    padding: 5px 10px;
    letter-spacing: 2px;
    font-weight: 500;
    cursor: pointer;
}
.carousel.carousel.showDetail .list .item:nth-child(2) .checkout button:nth-child(2){
    background-color: #693EFF;
    color: #eee;
}
.carousel.showDetail .list .item:nth-child(2) .detail  .title,
.carousel.showDetail .list .item:nth-child(2) .detail  .des,
.carousel.showDetail .list .item:nth-child(2) .detail .specifications,
.carousel.showDetail .list .item:nth-child(2) .detail .checkout{
    opacity: 0;
    animation: showContent 0.5s 1s ease-in-out 1 forwards;
}
.carousel.showDetail .list .item:nth-child(2) .detail  .des{
    animation-delay: 1.2s;
}
.carousel.showDetail .list .item:nth-child(2) .detail .specifications{
    animation-delay: 1.4s;
}
.carousel.showDetail .list .item:nth-child(2) .detail .checkout{
    animation-delay: 1.6s;
}
.arrows{
    position: absolute;
    bottom: 135px;
    width: 1140px;
    max-width: 90%;
    display: flex;
    justify-content: space-between;
    left: 50.5%;
    height: 0px;
    transform: translateX(-50%);
    cursor: pointer;
}
.arrow{
    position: absolute;
    bottom: 310px;
    width: 1140px;
    max-width: 90%;
    display: flex;
    justify-content: space-between;
    left: -81%;
    height: 100px;
    transform: translateX(-50%);
    cursor: pointer;
}
#prev,
#next{
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-family: monospace;
    border: 1px solid #5555;
    font-size: large;
    bottom: 20%;
    left: 10%;
    cursor: pointer;
}
#next{
    left: unset;
    right: 10%;
    cursor: pointer;
}

form #back1, #back2, #back3{
    position: absolute;
    z-index: 100;
    bottom: 66%;
    left: 50%;
    transform: translateX(-50%);
    border: none;
    font-family: Poppins;
    font-weight: bold;
    letter-spacing: 3px;
    background-color: transparent;
    padding: 10px;
    /* opacity: 0; */
    transition: opacity 0.5s;
    cursor: pointer;
}
#back3{
    bottom: 50%;
}
.carousel.showDetail #back{
    opacity: 1;
}
.carousel.showDetail #prev,
.carousel.showDetail #next{
    opacity: 0;
    pointer-events: none;
}
.carousel::before{
    width: 500px;
    height: 300px;
    content: '';
    background-image: linear-gradient(70deg, #DC422A, blue);
    position: absolute;
    z-index: 0;
    border-radius: 20% 30% 80% 10%;
    filter: blur(150px);
    top: 50%;
    left: 50%;
    transform: translate(-10%, -50%);
    transition: 1s;
}
.carousel.showDetail::before{
    transform: translate(-100%, -50%) rotate(90deg);
    filter: blur(130px);
}
.footer {
        display: flex; /* Use flexbox for centering */
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically (optional) */
        padding: 1rem; /* Add some padding if needed */
        background-color: #f6f6f6;
        font-size: 13px;
        margin-top: 20px;
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

/* Responsiveness */
@media (max-width: 768px) {
    header {
        flex-direction: column;
        align-items: flex-start;
    }

    header .logo img {
        width: 80%; /* Increased width for smaller screens */
        max-width: 100%;
    }

    header nav a {
        margin-left: 10px; /* Reduced margin for mobile view */
        font-size: 14px; /* Adjust font size */
    }

    .carousel .list .item {
        width: 90%; /* Adjust item width */
    }

    .carousel .list .item img {
        width: 80%; /* Adjust image width */
    }

    .carousel .list .item .introduce {
        width: 90%; /* Adjust text container width */
        left: 5%; /* Center the text container */
    }

    .carousel .list .item .introduce .title {
        font-size: 1.5em; /* Adjust font size */
    }

    .carousel .list .item .introduce .topic {
        font-size: 3em; /* Adjust font size */
    }

    .carousel .list .item .introduce .des {
        font-size: small; /* Keep it small */
    }

    .carousel .list .item .introduce .seeMore {
        font-size: 14px; /* Adjust font size */
    }
}
</style>