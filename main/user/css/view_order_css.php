<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

/* Presets */
*, ::before, ::after {
  box-sizing: border-box;
}

html {
    width: auto;
    height: 100%;
}

body{
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: var(--body-font);
    font-size: var(--normal-font-size);
}

:root{
  --first-color: #F2A20C;
  --white-color: #E9EAEC;
  --dark-color: #272D40;
  --dark-color-lighten: #F2F5FF;

  --body-font: 'Poppins', sans-serif;
  --h1-font-size: 1.5rem;
  --h2-font-size: 1.25rem;
  --normal-font-size: 1rem;
  --small-font-size: .875rem;
}

/* Header */

header{
    width: 1140px;
    max-width: 100%;
    display: flex;
    justify-content: space-between;
    margin: auto;
    height: 50px;
    align-items: center;
    background-color: transparent; 
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

header nav a:hover, header nav a span.material-symbols-outlined:hover{
    color: black;
    transition: 0.3s ease;
}

/* Main */

.main{
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    min-height: calc(100vh - 50px);
}

.back-btn span{
    position: absolute;
    color: black;
    font-size: 45px;
    transform: translate(55px,42px);
}

/* Title */
.title{
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: solid;
    margin: 25px 109px 20px 109px;
}

.tittle {
    font-size: 2.25rem;
    margin: 10px;
}

.tags{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-id {
    width: 160px;
    border-radius: 15px;
    text-align: center;
    border: black solid 2px;
    font-weight: 500;
    margin-right: 10px;
    height: 30px;
}

.status{
    width: 180px;
    border-radius: 15px;
    text-align: center;
    border: black solid 2px;
    font-weight: 500;
    margin-right: 10px;
    height: 30px;
}

.cancel-order{
    width: 140px;
    border-radius: 15px;
    text-align: center;
    background-color: black;
    color: white;
    font-weight: 500;
    transition: all 0.3s ease;
    height: 30px;
    font-family: var(--body-font);
    font-size: var(--normal-font-size);
    border: none;
    margin-top: 15px;
}

.order-again{
    width: 140px;
    border-radius: 15px;
    text-align: center;
    background-color: black;
    color: white;
    font-weight: 500;
    transition: all 0.3s ease;
    height: 30px;
    font-family: var(--body-font);
    font-size: var(--normal-font-size);
    border: none;
    text-decoration: none;
    padding-top: 3px;
}

.cancel-order:hover, .order-again:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Adds a shadow on hover */
    transform: translateY(-3px); /* Slightly lifts the button */
    cursor: pointer;
}

.status.completed {
    border-color: #2dc258; /* Green for completed */
    color: #2dc258; /* Text color for completed */
}

.status.canceled {
    border-color: #ca3433; /* Red for canceled */
    color: #ca3433; /* Text color for canceled */
}

.status.in_progress {
    border-color: black; /* Remain black for in progress */
    color: black; /* Text color for in progress */
}

.status.unknown {
    border-color: black; /* Default black for unknown */
    color: black; /* Default text color for unknown */
}

p {
    font-size: 1rem;
    /* padding: 0 0 20px 0; */
}

/* Content */

.content{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0 109px 0 109px;
}

/* Content-Left */
.content-left{
    width: 47%;
    height: 100px;
}

/* Receipt */
.receipt{
    border-radius: 15px;
    border: black solid 2px;
    height: auto;
    margin-top: 15px;
    padding: 0 20px 0 20px;
    width: 100%;
    box-sizing: border-box;
}

.product-img{
    padding-top: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.product-img img{
    width: 100%;
    max-width: 200px;
    height: auto;  
}

.title-summary{
    font-size: 1rem;
}

.summary .product{
    display: flex;
    justify-content: space-between;
    text-align: right;
}

.price-summary{
    display: flex;
    justify-content: space-between;
}

.delivery{
    display: flex;
    justify-content: space-between;
}

.subtotal{
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    border-top: solid 2px;
}

.subtotal-t{
    font-size: 2.25rem;
    font-weight: 600;
    padding-right: 80px;
}
.subtotal-p{
    font-size: 1.75rem;
    font-weight: 600;
    margin-top: 6px;
}

/* Content-Right */
.content-right{
    padding: 0;
    margin: 0;
    width: 50%;
    height: 100px;
    display: flex;
    flex-direction: column;
}

.progress-bar, .delivery-address {
    flex: 1; 
}

/* Progress Bar */
.progress-bar{
    display: flex;
    align-items: center; 
    justify-content: center;
    padding: 0;
    margin: 18px 0 18px 0;
}

ul{
    display: flex;
    padding: 0px;
    padding: 0;
    margin: 0;
}

ul li{
    list-style: none;
    display: flex; 
    align-items: center; 
    flex-direction: column;
}

ul li .text{
    font-weight: 600;
}

/* Progress Div Css  */

ul li .progress{
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: solid 4px grey;
    background-color: white;
    margin: 14px 50px;
    display: grid;
    place-items: center;
    color: grey;
    position: relative;
}

.progress .material-symbols-outlined{
    font-size: 30px;
    cursor: default; 
}

.progress::after{
    content: " ";
    position: absolute;
    width: 100px;
    height: 4px;
    background-color: grey;
    right: 56px;
}
.one::after{
    width: 0;
    height: 0;
}

/* Progress Bar: Active CSS  */

ul li .active{
    border: solid 4px #2dc258;
    color: #2dc258;
    display: grid;
    place-items: center;
}

li .active::after{
    background-color: #2dc258;
}

/* Progress Bar: Canceled CSS */

ul li .canceled {
    border: solid 4px #ca3433;
    color: #ca3433;
}

li .canceled::after {
    background-color: #ca3433;
}

/* Delivery Address */

.delivery-address{
    width: 100%;
    height: auto;
    /* background-color: #F9F7F5; */
    border-radius: 15px;
    margin-top: 15px;
    padding: 20px;
    /* border: #eeeeee solid 1px; */
    border: black solid 2px;
    box-sizing: border-box;
    min-height: 270px;
}

.delivery-title{
    margin-top: 0px;
    font-size: 1.5rem;
}

.info-line {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.label {
    flex-shrink: 0;
    width: 200px; 
    color: grey;
    font-size: 1rem; 
}

.value {
    text-align: right;
    flex-grow: 1; 
    font-size: 1rem;
}

.value br {
    display: block;
}


.delivery-address p{
    margin: 0;
}

/* Footer */
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

/* Responsive Design */

/* Responsive Design: Receipt */
@media (max-width: 980px) {
    .receipt {
        padding: 15px;
        max-width: 100%;
    }

    .title-summary {
        font-size: 1.25rem;
    }

    .summary .product, 
    .price-summary, 
    .delivery, 
    .subtotal {
        flex-direction: column; 
        align-items: flex-start;
        text-align: left;
    }

    .subtotal-t {
        font-size: 1.75rem;
        padding-right: 0;
    }
    .subtotal-p {
        font-size: 1.25rem;
        margin-top: 4px;
    }
}

@media (max-width: 480px) {
    .receipt {
        padding: 10px;
        border-radius: 10px;
    }

    .title-summary {
        font-size: 1.1rem;
    }

    .subtotal-t, .subtotal-p {
        font-size: 1.25rem;
    }
}

/* Responsive Design: Progress Bar */
@media (max-width: 768px) {
    ul {
        flex-direction: column;
    }
    
    ul li .progress {
        width: 50px; 
        height: 50px;
        margin: 10px 0;
    }

    .progress::after {
        width: 0;
        height: 0; 
    }

    .progress .material-symbols-outlined {
        font-size: 24px; 
    }
}

@media (max-width: 480px) {
    ul li .progress {
        width: 40px; 
        height: 40px;
    }

    .progress .material-symbols-outlined {
        font-size: 20px;
    }

    ul li .text {
        font-size: 0.8rem; 
    }
}

/* Responsive Design: Delivery Address */
@media (max-width: 768px) {
    .info-line {
        flex-direction: column;
        align-items: flex-start;
    }

    .delivery-address {
        padding: 15px;
        max-width: 100%;
        margin-top: 10px;
    }

    .label, .value {
        text-align: left; 
        font-size: 0.9rem;
    }

    .delivery-title {
        font-size: 1.25rem;
    }
}

@media (max-width: 480px) {
    .delivery-address {
        padding: 10px;
        border-radius: 10px;
        margin-top: 8px;
    }

    .label, .value {
        font-size: 0.85rem;
    }

    .delivery-title {
        font-size: 1.1rem; 
    }
}

</style>