<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*, ::before, ::after {
  box-sizing: border-box;
}

html {
    /* max-width: 100%; */
    width: auto;
    height: auto;
}

body{
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
    color: #555; 
    vertical-align: middle;
}

header nav a:hover, header nav a span.material-symbols-outlined:hover{
    color: black;
    transition: 0.3s ease;
}

.main{
    height: 0vh;
}
.tittle {
    font-size: 2.25rem;
    margin: 25px 0 20px 109px;
}

.col-1 {
    width: 700px;
    height: auto;
    margin: 0 0 0 109px;
}

p {
    font-size: 1rem;
    padding: 0 0 20px 0;
    border-bottom: solid;
}

.vertical-slider {
    height: 420px; /* Set the height of the visible area */
    overflow-y: auto; /* Enable vertical scrolling */
    scroll-behavior: smooth; /* Smooth scrolling for better UX */
}
.vertical-slider::-webkit-scrollbar {
    width: 0; /* For Chrome, Safari, and Opera */
}

.no-products {
    text-align: center;
    margin: 20px 0;
    font-size: 18px;
    font-weight: bold;
    color: #555;
}

.container {
    height: 180px;
    position: relative;
    display: flex;
    justify-content: space-between;
    margin-bottom: 40px;
}

.product-img img{
    width: 180px;
    height: 180px;
}

.details{
    position: relative;
    left: -30px;
    top: 12px;
    gap: 100px;
    line-height: 1.25;
}

.item-name a{
    color: black;
    text-decoration: none;
    font-size: 1.25rem; 
    font-weight: 700;
}

.volume{
    font-size: 1rem;
    font-weight: 500;
}

.price-per-unit{
    font-size: 1rem;
    font-weight: 500;
}

.counter {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-radius: 30px;
  width: 125px;
  height: 45px;
  background: white;
  border: solid 2px ; 
}

.counter button {
  width: 40px;
  height: 100%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  background: none;
  border: none;
  margin: 2px 2px 2px 2px;
}

.counter button:hover {
    background: #D3D3D3;
    border-radius: 30px;
}

.counter .count {
    border: none;
    background: transparent;
    width: 35px;
    font-weight: 500;
    transform: translateX(10px);
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0; 
}


input[type="number"] {
    -moz-appearance: textfield; 
    border: none;
    outline: none;
}

.rmv-item{
    width: 125px;
    height: 40px;
    transform: translate(135px, -43px);
    text-align: center;
    align-items: center;
    justify-content: center;
    padding-top: 11px;
    cursor: pointer;;
}

.rmv-item:hover{
    background: #D3D3D3;
    border-radius: 30px;
}
.rmv-item span:hover{
    background: transparent;
    border-radius: 30px;
}

.total-price {
    position: relative;
    font-size: 1rem;
    font-weight: 600;
    top: 4px;
}

.col-2{
    width: 400px;
    height: 500px;
    transform: translate(857px,-560px);
    padding-left: 30px;
    border-left: solid 1px;
}

.title-summary{
    font-size: 1.5rem;
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
}
.subtotal-p{
    font-size: 1.75rem;
    font-weight: 600;
    margin-top: 6px;
}

form .btn-checkout{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
}

button{
    width: 100%;
    height: 50px;
    border-radius: 30px;
    border: none;
    background: #0058a3;
    color: white;
    font-size: 1.2rem;
    font-weight: 400;
}

a{
    text-decoration: none;
    color: white;
}
.payment-method{
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.payment-method img{
    width: 40px;
    height: 30px;
    border: solid 1px;
    border-radius: 10px;
}

.copyright p{
    position: absolute;
    border-bottom: none;
    outline: none;
    transform: translate(500px,525px);
    color: black;
}
.copyright a{
    color: black;
}

</style>
