<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    *, ::before, ::after {
        box-sizing: border-box;
    }

    html {
        max-width: 100%;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: var(--body-font);
        font-size: 1rem;
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
        --body-font: 'Poppins', sans-serif;
    }

    a{
        text-decoration: none;
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

    body {
        min-height: 100vh;
        margin: 0;
    }

    .orders {
        max-width: 1120px;
        margin: auto;
        padding: 20px;
    }

    .heading {
        font-weight: 700;
        font-size: 2.5rem;
        color: var(--black);
        text-align: center;
        margin-bottom: 40px;
    }

    .order-filter {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }

    .order-filter button {
        padding: 10px 20px;
        cursor: pointer;
        margin: 0 10px;
        border: solid 1px;
        transition: background-color 0.3s;
        font-size: 18px; 
        border-radius: 15px;
    }

    .order-filter button:hover {
        background-color: black;
        color: white;
    }

    .order-filter button.active {
        background-color: black;
        color: white;
    }

    .box-container {
        max-width: 1120px; /* Set max width to align with your design */
        margin: 0 auto; /* Center the container horizontally */
        display: flex;
        flex-wrap: wrap;
        gap: 30px; /* Space between order boxes */
        justify-content: flex-start; /* Align boxes to the left */
    }

    .box {
        flex: 1 1 calc(33.333% - 20px); /* Maintain three items per row with margin */
        min-width: 300px; /* Set a minimum width for the box */
        max-width: calc(33.333% - 20px); /* Max width to keep it at 1/3 of the container */
        background: var(--white);
        border-radius: 10px;
        border: solid 2px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        position: relative; /* For the canceled order border */
    }

    .box:hover {
        transform: scale(1.05);
    }

    .box img {
        width: 100%;
        height: auto; /* Maintain aspect ratio */
        border-radius: 10px;
    }

    .box p {
        margin: 10px 0;
    }

    .date {
        font-size: 0.9rem;
        color: var(--dark-grayish-blue);
        font-size: 17px;
        font-weight: 600;
    }

    .name {
        font-size: 20px;
        font-weight: 700;
        color: var(--black);
    }

    .price {
        font-size: 1.25rem;
        color: black;
        font-weight: 600;
    }

    .status {
        font-size: 1.1rem;
        font-weight: 500;
    }

    .status.delivered {
        color: green;
    }

    .status.canceled {
        color: red;
    }

    .status.pending {
        color: orange;
    }

    .empty {
        text-align: center;
        font-weight: 700;
        color: var(--grayish-blue);
        margin-top: 50px;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .box {
            flex: 1 1 100%; /* Full width on small screens */
        }
    }
</style>