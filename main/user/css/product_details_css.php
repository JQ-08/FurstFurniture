<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
html{
    margin: 0;
    height: auto;
    width: auto;
}
body{
    position: relative;
    margin: 0;
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
.back-btn span{
  position: absolute;
  font-size: 40px;
  transform: translate(40px,20px);
  color: black;
}

.main{
  display: flex;
  align-items: center;
  padding: 0 50px;
  margin-top: 0px;
}

.col-1{
  position: relative;
  padding-top: 1%;
  left: 5.3%;
  width: 600px;
}
/* Image gallery */
.gallery {
  position: relative;
  flex: 1;
  /* padding-bottom: 200px; */
  display: flex;
  flex-direction: column;
  width: 100%;
  gap: 30px;
  top: -20px;
}

.gallery .main-img img {
  width: 350px;
  height: 250px;
  display: none;
}

.gallery .main-img img.active {
  display: inline-block;
  position: relative;
  width: 450px;
  height: 400px;
  border-radius: 30px;
  border: solid;
  color: black;
  cursor: pointer;
}

.gallery .thumb-list {
  position: relative;
  display: flex;
  /* justify-content: space-between; */
  margin-right: 0;
  gap: 10px;
}

.gallery .thumb-list div img {
  max-width: 96px;
  max-height: 96px;
  margin: 0 2px;
  border: solid;
}

.gallery .thumb-list img {
  width: 600px;
  height: 100%;
  border-radius: 10px;
  cursor: pointer;
}

.gallery .thumb-list img:hover {
  opacity: 50%;
}

.gallery .thumb-list .active img {
  opacity: 30%;
}

.gallery .thumb-list .active {
  border: 2px solid var(--orange);
  border-radius: 13px;
  margin: 0;
}

/* lightbox */
.lightbox {
  display: none;
  position: absolute;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;
  z-index: 10;
  backdrop-filter: blur(20px);
  /* background: white; */
  align-items: center;
  justify-content: center;
}

.lightbox.active {
  display: flex;
}

.lightbox.active .gallery {
  max-width: 455px;
}

.lightbox .main-img {
  position: relative;
}

.lightbox .icon-prev{
  position: absolute;
  height: 50px;
  width: 50px;
  left: -10%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: white;
  border-radius: 50%;
}
.lightbox .icon-next {
  position: absolute;
  height: 50px;
  width: 50px;
  right: -10%;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: white;
  border-radius: 50%;
}

.icon-prev:hover,
.icon-next:hover {
  cursor: pointer;
}

.icon-prev {
  top: 50%;
  transform: translate(-50%, -50%);
}

.icon-next {
  top: 50%;
  right: 0;
  transform: translate(50%, -50%);
}

.icon-close svg path {
  fill: var(--white);
}

.icon-close svg path:hover {
  cursor: pointer;
  fill: var(--orange);
}

.icon-close {
  position: absolute;
  right: -8%;
  top: 5px;
}

.col-2{
  position: relative;
  width: 500px;
  height: 600px;
  max-height: 600px;
  max-width: 500px;
  left: 2%;
  display: flex;
  align-items: center;
}

/* Specifications */
.specifications{
    display: flex;
    gap: 10px;
    width: 100%;
    border-top: 1px solid #5553;
    margin-top: 20px;
}

.specifications div{
    width: 90px;
    text-align: center;
    flex-shrink: 0;
}

.specifications div p:nth-child(1){
    font-weight: bold;
}
/* Content */

.content {
  flex: 1;
  position: relative;
  top: 15px;
}

.content h3 {
  font-weight: 900;
  font-size: 20px;
  color: var(--black);
}

.content h2 {
  font-weight: 900;
  font-size: 37px;
  margin: 20px 0 40px 0;
  margin-bottom: 0px;
}

.content p {
  font-size: 16px;
  color: var(--dark-grayish-blue);
  margin-bottom: 30px;
}

.product-desc {
  position: relative;
  width: 500px;
}

.price {
  position: relative;
  display: flex;
  align-items: center;
}

.current-price {
  font-weight: 700;
  font-size: 25px;
}

.add-to-cart-container {
  position: relative;
  display: flex;
  align-items: center;
  gap: 15px;
}

.counter {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-radius: 15px;
  width: 150px;
  height: 55px;
  background: #D3D3D3;
}

.counter button {
  width: 50px;
  height: 100%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  background: none;
  border: none;
}

.counter .count {
  font-weight: 700;
}

.add-to-cart {
  display: flex;
  height: 55px;
  width: 150px;
  border: 0px;
  border-radius: 10px;
  font-weight: 700;
  justify-content: center;
  align-items: center;
  gap: 15px;
  cursor: pointer;
  margin-top: 10%;
  background: #D3D3D3;
}

.add-to-cart svg path {
  fill: var(--white);
}

.copyright{
  position: absolute;
  transform: translate(480px, 272px)
}

.copyright a{
    color: black;
}

.copyright {
    padding-top: 30px;
}

.copyright p {
    text-align: center;
    margin: 0;
}

.copyright a {
    color: var(--primary);
}
</style>