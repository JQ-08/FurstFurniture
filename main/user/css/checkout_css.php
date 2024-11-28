<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

/* Presets */

*, ::before, ::after {
  box-sizing: border-box;
}

html {
    width: auto;
    height: 100%;
}

body {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: var(--body-font);
    font-size: var(--normal-font-size);
}

:root {
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
    color: #555; 
    vertical-align: middle;
}

header nav a:hover, header nav a span.material-symbols-outlined:hover{
    color: black;
    transition: 0.3s ease;
}

/* Main */

.main {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

/* Heading */

.heading {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;
}

/* Row */
.row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start; /* Aligns both forms at the top */
    margin: 50px 109px; /* Adjust margins for consistency */
    gap: 20px; /* Adds space between the form and summary */
}


/* Billing Details */

form {
    width: 48%;
    background: #fff;
    margin-top: 0px;
    border-radius: 15px;
    border: solid 2px black;
    padding: 30px;
    min-height: 600px; /* Set a minimum height for consistency */
}

form .title{
    font-size: 30px;
    padding-bottom: 10px;
    margin: 0;
}

/* For Chrome, Safari, Edge, and other WebKit browsers */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* For Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}

.box {
    margin-bottom: 30px; 
    display: flex;
    flex-direction: column;
}

.box p {
    padding: 0;
    margin-bottom: 10px;
    font-size: 16px;
    display: block;
    font-weight: 500;
}

.input {
    width: 100%;
    box-sizing: border-box; 
    border-radius: 8px;
    border: solid 2px;
    height: 4rem;
    padding: 5px 10px 5px 10px;
    font-size: 16px;
}

.input:focus {
    border-color: grey;
    outline: none;
}

.continue-btn, .place-order-btn, .back-btn {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 30px;
    padding: 10px;
    width: 100%;
    font-family: var(--body-font);
    font-weight: 500;
    height: 60px;
    font-size: 18px;
    background: black;
    color: white;
    border: none;}

.back-btn{
    margin-bottom: 10px;
    text-decoration: none;
    background-color: white;
    color: black;
    border: 2px solid black;
}

.continue-btn:hover, .place-order-btn:hover, .back-btn:hover{
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); 
    transform: translateY(-3px); 
    cursor: pointer;
}

.btsc{
    background-color: white;
    color: black;
    border: 2px solid black;
}

.address{
    margin-bottom: 20px;
    width: 100%;
    box-sizing: border-box; 
    border-radius: 8px;
    border: solid 2px;
    height: 4rem;
    padding: 5px 10px 5px 10px;
    font-size: 16px;
}

.address:focus {
    border-color: grey;
    outline: none;
}

/* Summary */
.summary {
    width: 48%;
    border-radius: 15px;
    border: solid 2px black; 
    height: auto;
    padding: 30px;
    display: flex;
    flex-direction: column;
    top: 0;
    margin: 0;
    position: relative;
}

.summary .title {
    font-size: 30px;
    padding-bottom: 10px;
    margin: 0;
}

/* Grand Total */
.grand-total {
    font-size: 1.5rem;
    font-weight: bold;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: space-between;
}

.grand-total p{
    margin: 0;
    padding-top: 20px;
}

/* Cart Items */
.flex.cart-item {
    display: flex;
    align-items: center;
}

.flex.cart-item img {
    width: 100px;
    height: auto;
    margin-right: 0.5rem;
}

.cart-item .name, .cart-item .price {
    font-size: 16px;
}

/* Footer */
.footer {
        display: flex; 
        justify-content: center; 
        align-items: center;
        padding: 1rem;
        background-color: #f6f6f6;
        font-size: 13px;
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
@media (max-width: 768px) {
    .row {
        flex-direction: column; /* Stack elements vertically on smaller screens */
        margin: 0 4%; /* Adjust margin for smaller screens */
    }

    form{
        margin-bottom: 200px;
    }

    form, .summary {
        width: 100%; /* Full width on smaller screens */
    }

    .summary {
        min-height: auto; /* Allow height to adjust */
    }

    .grand-total {
        flex-direction: column; /* Stack grand total on smaller screens */
        align-items: flex-start; /* Align items to the left */
    }

    .grand-total p {
        padding-top: 10px; /* Adjust padding for stacked items */
    }

    .heading {
        flex-direction: column; /* Stack heading items on smaller screens */
    }
}

@media (max-width: 480px) {
    .continue-btn, .place-order-btn {
        height: 50px; /* Adjust button height */
        font-size: 16px; /* Adjust button font size */
    }

    .summary .title {
        font-size: 24px; /* Adjust title font size */
    }

    .box p {
        font-size: 14px; /* Adjust paragraph font size */
    }
}
</style>
