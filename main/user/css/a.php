<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*, ::before, ::after {
  box-sizing: border-box;
}
html {
    max-width: 100%;
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
    color: #333; 
    vertical-align: middle;
}

h1, p {
  margin: 0;
}
a {
  text-decoration: none;
}
img {
  max-width: 100%;
  height: auto;
}
.wardrobe {
  padding-left: 145px;
  padding-top: 130px;
  height: 100vh;
  display: flex;
  gap: 60px;
  background-color: var(--dark-color-lighten);
}

.type_wardrobe {
   position: absolute;
   display: flex;
   top: 100px;
   left: 110px;
}
.prev span{
    position: absolute;
    /* left: 180%; */
    height: 46px;
    width: 46px;
    font-size: 2rem;
    text-align: center;
    justify-content: center;
    line-height: 46px;
    background: grey;
    border-radius: 50%;
    transform: translateY(160px);
    z-index: 10;
    cursor: pointer;
}

.next span{
    position: absolute;
    right: 0%;
    height: 46px;
    width: 46px;
    font-size: 2rem;
    text-align: center;
    justify-content: center;
    line-height: 46px;
    background: grey;
    border-radius: 50%;
    transform: translateY(160px);
    z-index: 10;
    cursor: pointer;
}

.wrapper {
    position: absolute;
    left: 5.5%;
    top: 10%;
    padding-top:10%;
    max-width: 1200px;
    height: auto;
    display: flex;
    gap: 60px;
    overflow:hidden;
}

.card {
  position: relative;
  display: flex;
  width: 320px;
  height: 375px;
  background-color: var(--dark-color);
  border-radius: 1rem;
  padding: 4rem 2rem 0;
  color: var(--white-color);
  display: none;
}

.card_img {
  position: absolute;
  display: flex;
  width: 220px;
  margin: -25 15 auto;
  filter: drop-shadow(5px 10px 15px rgba(8,9,13,.4));
}

.card_data {
  transform: translateY(13.2rem);
  text-align: center;
}

.card_title {
  font-size: var(--h1-font-size);
  color: var(--first-color);
  margin-bottom: .5rem;
}

.card_price {
  display: inline-block;
  font-size: var(--h2-font-size);
  width: 265px;
  font-weight: 500;
  margin-bottom: 0.8rem;
}

.card_description {
  font-size: var(--small-font-size);
  text-align: initial;
  margin-bottom: 1rem;
  opacity: 0;
}

.button_container {
   display: flex;
   justify-content: space-between; 
   gap: 10px; 
}

.card_button {
  display: block;
  width: max-content;
  padding: 0.5rem 1.7rem;
  background-color: var(--first-color);
  color: var(--white-color);
  border-radius: .5rem;
  font-size: 12;
  font-weight: 600;
  margin-bottom: 1rem;
  transition: .2s;
  opacity: 0;
}

.card_button:hover {
  box-shadow: 0 18px 40px -12px rgba(242,162,12,.35);
}

.card_img, 
.card_data, 
.card_title, 
.card_price, 
.card_description {
  transition: .5s;
}

.card:hover .card_img {
  transform: translate(0.3rem, -8rem) ;
}

.card:hover .card_data {
  transform: translateY(4.8rem);
}

.card:hover .card_title {
  text-align: left;
  /* transform: translateX(-40%); */
  margin-bottom: 0;
}

.card:hover .card_price {
  text-align: left;
  /* transform: translateX(-5.5rem); */
}

.card:hover .card_description, 
.card:hover .card_button {
  transition-delay: .2s;
  opacity: 1;
}

.reveal {
   position: relative;
   transform: translateY(150px);
   opacity: 0;
   transition: all 2s ease;
}

.reveal.active {
   transform: translateY(0px);
   opacity: 1;
}
</style>