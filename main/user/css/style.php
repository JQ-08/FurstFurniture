<style>
/*-------------------------------------------------------------------- import Files ---------------------------------------------------------------------*/
@import url("https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@400;700&display=swap");

/*--------------------------------------------------------------------- skeleton ---------------------------------------------------------------------*/

* {
  box-sizing: border-box !important;
  transition: ease all 0.5s;
}

*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

:root {
  --orange: hsl(26, 100%, 55%);
  --pale-orange: hsl(25, 100%, 94%);
  --very-dark-blue: hsl(220, 13%, 13%);
  --dark-grayish-blue: hsl(219, 9%, 45%);
  --grayish-blue: hsl(220, 14%, 75%);
  --light-grayish-blue: hsl(223, 64%, 98%);
  --white: hsl(0, 0%, 100%);
  --black: hsl(0, 0%, 0%);
  --black-with-opacity: hsla(0, 0%, 0%, 0.75);
}

html {
  font-family: "Kumbh Sans", sans-serif;
  scroll-behavior: smooth;
  overflow-x: hidden;
}

header{
  display: flex;
  visibility: visible !important;
  justify-content: center; 
  align-items: center; 
  z-index: 9999;
  width: 100vw;
}

a {
  text-decoration: none;
  color: var(--dark-grayish-blue);
  text-decoration: none !important;
  outline: none !important;
  -webkit-transition: all .3s ease-in-out;
  -moz-transition: all .3s ease-in-out;
  -ms-transition: all .3s ease-in-out;
  -o-transition: all .3s ease-in-out;
  transition: all .3s ease-in-out;
}

body {
  min-height: 100vh;
  min-width: 100vw;
  position: relative;
  font-size: 14px;
  line-height: 1.80857;
  font-weight: normal;
  overflow-x: hidden;
}

.container {
  max-width: 1120px;
  min-height: 100vh;
  padding: 0 5px;
  margin: 0px;
}

h1,
h2,
h3,
h4,
h5,
h6 {
    letter-spacing: 0;
    font-weight: normal;
    position: relative;
    padding: 0 0 10px 0;
    font-weight: normal;
    line-height: normal;
    color: #111111;
    margin: 0
}

h1 {
    font-size: 24px
}

h2 {
    font-size: 22px
}

h3 {
    font-size: 18px
}

h4 {
    font-size: 16px
}

h5 {
    font-size: 14px
}

h6 {
    font-size: 13px
}

h1 a,
h2 a,
h3 a,
h4 a,
h5 a,
h6 a {
    color: #212121;
    text-decoration: none!important;
    opacity: 1
}

button:focus {
    outline: none;
}

ul,
li,
ol {
    margin: 0px;
    padding: 0px;
    list-style: none;
}

p {
    margin: 20px;
    font-weight: 300;
    font-size: 15px;
    line-height: 24px;
}

a {
    color: #222222;
    text-decoration: none;
    outline: none !important;
}

a,
.btn {
    text-decoration: none !important;
    outline: none !important;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
}

 :focus {
    outline: 0;
}

.paddind_bottom_0 {
    padding-bottom: 0 !important;
}

.btn-custom {
    margin-top: 20px;
    background-color: transparent !important;
    border: 2px solid #ddd;
    padding: 12px 40px;
    font-size: 16px;
}

.lead {
    font-size: 18px;
    line-height: 30px;
    color: #767676;
    margin: 0;
    padding: 0;
}

.form-control:focus {
    border-color: #ffffff !important;
    box-shadow: 0 0 0 .2rem rgba(255, 255, 255, .25);
}

.navbar-form input {
    border: none !important;
}

.badge {
    font-weight: 500;
}

blockquote {
    margin: 20px 0 20px;
    padding: 30px;
}

button {
    border: 0;
    margin: 0;
    padding: 0;
    cursor: pointer;
}

.full {
    float: left;
    width: 100%;
}

.layout_padding {
    padding-top: 90px;
    padding-bottom: 0px;
}

.padding_0 {
    padding: 0px;
}

/* Navbar */
.navbar {
  display: flex;
  justify-content: space-between;
  gap: 600px;
  align-items: center;
  padding-top: 26px;
  border-bottom: 1px solid var(--grayish-blue);
  margin-bottom: 85px;
  position: relative;
}

.nav-first {
  display: flex;
  align-items: center;
  gap: 50px;
  padding-bottom: 30px;
}

.nav-links {
  display: flex;
  align-items: center;
  gap: 30px;
}

.nav-links a {
  position: relative;
}

.nav-links a:hover {
  color: var(--black);
}

.nav-links a:hover::after {
  content: "";
  position: absolute;
  background-color: var(--orange);
  width: 100%;
  height: 3px;
  left: 0;
  bottom: -47px;
}

.nav-second {
  display: flex;
  align-items: center;
  gap: 45px;
  padding-bottom: 30px;
}

.logo img {
  height: 22px;
}

/* Main */
.main {
    display: flex;
    gap: 125px;
    min-height: 570px;
    align-items: center;
    padding: 0 50px;
  }

/* Cart */
.cart {
    position: relative;
  }
  
  .cart-icon {
    cursor: pointer;
  }
  
  .cart-container {
    right: -95px;
    top: 50px;
    z-index: 9;
    position: absolute;
    width: 360px;
    min-height: 260px;
    background: white;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    display: none;
  }
  
  .cart-container.active {
    display: flex;
    flex-direction: column;
  }
  
  .cart-title {
    padding: 25px 20px;
    font-weight: 700;
    border-bottom: 1px solid var(--grayish-blue);
  }
  
  .cart .cart-items {
    padding: 25px 20px;
    display: flex;
    flex-direction: column;
    gap: 25px;
  }
  
  .cart .cart-items.empty {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 185px;
    font-weight: 700;
  }
  
  .cart .cart-items.empty .cart-empty {
    color: var(--grayish-blue);
    display: inline-block;
  }
  
  .cart .cart-items .cart-empty {
    display: none;
  }
  
  .cart-item {
    display: flex;
    align-items: center;
    gap: 20px;
  }
  
  .cart-item img {
    height: 50px;
    border-radius: 5px;
  }
  
  .cart-item {
    color: var(--dark-grayish-blue);
  }
  
  .cart-item .total-price {
    color: var(--black);
    font-weight: 700;
  }
  
  .cart-count {
    cursor: pointer;
    position: absolute;
    top: -8px;
    right: -10px;
    background-color: var(--orange);
    color: var(--white);
    min-width: 25px;
    min-height: 17px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
  }
  
  .delete-item {
    border: none;
    background: none;
    cursor: pointer;
  }

/* Mobile */

@media (max-width: 755px) {
    .navbar {
      margin-bottom: 0;
      border-bottom: none;
    }
  
    .nav-first,
    .nav-second {
      gap: 30px;
      padding-bottom: 10px;
    }
  
    .nav-first .menu-icon {
      cursor: pointer;
      display: inline-block;
    }
  
    .nav-links {
      display: none;
    }
  
    .nav-links.active {
      display: flex;
      flex-direction: column;
      position: absolute;
      top: 0;
      left: -5px;
      max-width: 220px;
      width: 100%;
      height: 100vh;
      background: var(--white);
      align-items: start;
      z-index: 15;
      padding: 25px 30px;
    }
  
    .nav-first .backdrop.active {
      background: var(--black-with-opacity);
      width: 100vw;
      height: 100vh;
      display: block;
      position: absolute;
      top: 0;
      left: -5px;
      z-index: 11;
    }
  
    .nav-links.active .close-icon {
      display: inline-block;
      margin-bottom: 30px;
      cursor: pointer;
    }
  
    .nav-links a {
      font-weight: 700;
      color: black;
    }
  
    .nav-links.active a:hover::after {
      bottom: -5px;
    }
  }
</style>
