<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*, ::before, ::after {
  box-sizing: border-box;
}

html {
    max-height: auto;
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

.box{
    width: 800px;
    align-items: center;
    justify-content: center;
    border: 2px solid;
    margin: 50px 0 0 275px;
}

.box h1{
    text-align: center;
    padding: 0 0 20px;
    border-bottom: 2px solid;
}

.content{
    text-align: center;
}

.content p{
    font-weight: 600;
    font-size: 18;
}

.content form input{
    width: 400px;
    height: 35px;
    margin: 0 0 20px;
    border-radius: 10px;
}

.content form button{
    width: 300px;
    height: 35px;
    margin: 0 0 20px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14;
}

.content form button{
    cursor: pointer;
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