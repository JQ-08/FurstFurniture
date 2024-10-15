<script>

//****************REGISTER FORM EYE & EYE_SLASH****************//

function myRegPassword() {
    var eye = document.getElementById('eye-2');
    var eyeSlash = document.getElementById('eye-slash-2');
    var passwordField = document.querySelector('input[name="usersPwd"]');

    if (eye.style.opacity === '1') {
        eye.style.opacity = '0';
        eyeSlash.style.opacity = '1';
        passwordField.type = 'text';  
    } else {
        eye.style.opacity = '1';
        eyeSlash.style.opacity = '0';
        passwordField.type = 'password';  
    }
}

function myRegPassword_2() {
    var eye = document.getElementById('eye-3');
    var eyeSlash = document.getElementById('eye-slash-3');
    var passwordField = document.querySelector('input[name="usersConfirmPassword"]');

    if (eye.style.opacity === '1') {
        eye.style.opacity = '0';
        eyeSlash.style.opacity = '1';
        passwordField.type = 'text'; 
    } else {
        eye.style.opacity = '1';
        eyeSlash.style.opacity = '0';
        passwordField.type = 'password';  
    }
}

function myEditUserPassword() {
    var eye = document.getElementById('eye-4');
    var eyeSlash = document.getElementById('eye-slash-4');
    var passwordField = document.querySelector('input[name="editUsersPwd"]');

    if (eye.style.opacity === '1') {
        eye.style.opacity = '0';
        eyeSlash.style.opacity = '1';
        passwordField.type = 'text'; 
    } else {
        eye.style.opacity = '1';
        eyeSlash.style.opacity = '0';
        passwordField.type = 'password';  
    }
}

function myEditUserPassword_2() {
    var eye = document.getElementById('eye-5');
    var eyeSlash = document.getElementById('eye-slash-5');
    var passwordField = document.querySelector('input[name="editUsersConfirmPassword"]');

    if (eye.style.opacity === '1') {
        eye.style.opacity = '0';
        eyeSlash.style.opacity = '1';
        passwordField.type = 'text'; 
    } else {
        eye.style.opacity = '1';
        eyeSlash.style.opacity = '0';
        passwordField.type = 'password';  
    }
}

//****************REGISTER FORM EYE & EYE_SLASH****************//

//**************** EDIT ****************//

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-edit').forEach(function(button) {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const usersName = this.getAttribute('data-name');
            const usersEmail = this.getAttribute('data-email');
            
            document.getElementById('editUserId').value = userId;
            document.getElementById('editUsersName').value = usersName;
            document.getElementById('editUsersEmail').value = usersEmail;
            
            $('#editModal').modal('show');
        });
    });
});

//**************** EDIT ****************//

//**************** DELETE ****************//
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');

            if (confirm('Are you sure you want to delete this user?')) {
                fetch('includes/functions.inc.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        'userId': userId
                    })
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    location.reload(); 
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
});

//**************** USER: PAGINATION ****************//

document.addEventListener('DOMContentLoaded', function() {
    let currentPage = parseInt(document.getElementById('current-page').textContent); 
    const paginationItems = document.querySelectorAll('.pagination .page-item');
    const totalPages = paginationItems.length - 2;

    function loadPage(page) {
        if (page < 1 || page > totalPages) return;

        currentPage = page;
        document.getElementById('current-page').textContent = currentPage;

        fetch(`fetch_data.php?page=${page}`)
            .then(response => response.json())
            .then(data => {
                let tableBody = document.querySelector('table tbody');
                tableBody.innerHTML = '';

                data.data.forEach(user => {
                    let row = `<tr>
                        <td>
                            <div class='form-check'>
                                <input class='form-check-input' type='checkbox' value='' id='flexCheckDefault-${user.userId}'>
                                <label class='form-check-label' for='flexCheckDefault-${user.userId}'></label>
                            </div>
                        </td>
                        <td><b>${user.userId}</b></td>
                        <td>${user.usersName}</td>
                        <td>${user.usersEmail}</td>
                        <td>${user.usersPwd}</td>
                        <td>
                            <a href='javascript:void(0);' class='btn btn-primary shadow btn-xs sharp rounded-circle me-1 btn-edit'
                               data-id='${user.userId}' data-name='${user.usersName}' data-email='${user.usersEmail}'
                               data-toggle='modal' data-target='#edituser'>
                                <i class='fa fa-pencil'></i>
                            </a>
                            <a href='javascript:void(0);' class='btn btn-danger shadow btn-xs sharp rounded-circle btn-delete'
                               data-id='${user.userId}'>
                                <i class='fa fa-trash'></i>
                            </a>
                        </td>
                    </tr>`;
                    tableBody.insertAdjacentHTML('beforeend', row);
                });

                document.getElementById('showing-records').textContent = data.showingRecords;
                document.getElementById('total-records').textContent = data.totalRecords;

                paginationItems.forEach(item => {
                    item.classList.remove('active');
                    if (parseInt(item.getAttribute('data-page')) === currentPage) {
                        item.classList.add('active');
                    }
                });

                document.getElementById('prev-page').style.display = (currentPage > 1) ? 'block' : 'none';
                document.getElementById('next-page').style.display = (currentPage < totalPages) ? 'block' : 'none';
            });
    }

    paginationItems.forEach(item => {
        item.addEventListener('click', function() {
            const page = parseInt(this.getAttribute('data-page'));
            if (!isNaN(page)) {
                loadPage(page);
            }
        });
    });

    document.getElementById('prev-page').addEventListener('click', function() {
        if (currentPage > 1) {
            loadPage(currentPage - 1);
        }
    });

    document.getElementById('next-page').addEventListener('click', function() {
        if (currentPage < totalPages) {
            loadPage(currentPage + 1);
        }
    });

    loadPage(currentPage);
});

//**************** ORDERS: PAGINATION ****************//
document.addEventListener('DOMContentLoaded', function() {
    const currentPg = parseInt(document.getElementById('current-page').textContent, 10);
    const totalPgs = parseInt(document.getElementById('total-pages').textContent, 10);
    const showingRecords = parseInt(document.getElementById('showing-records').textContent, 10);
    const totalUsers = parseInt(document.getElementById('total-records').textContent, 10);

    updatePagination(currentPg, totalPgs, showingRecords, totalUsers);
});

function updatePagination(currentPg, totalPgs, showingRecords, totalUsers) {
    console.log("Updating pagination with:", { currentPg, totalPgs, showingRecords, totalUsers });

    const paginationInfo = document.querySelector('.d-flex small');
    paginationInfo.innerHTML = `Page <span id="current-page">${currentPg}</span> of 
                                <span id="total-pages">${totalPgs}</span>, 
                                showing <span id="showing-records">${showingRecords}</span> 
                                records out of <span id="total-records">${totalUsers}</span> total`;

    const paginationContainer = document.querySelector('.pagination');
    paginationContainer.innerHTML = '';

    const prevClass = (currentPg > 1) ? 'page-item' : 'page-item disabled';
    paginationContainer.insertAdjacentHTML('beforeend', `<li class='${prevClass}'><a class='page-link' href='javascript:void(0)'><i class='fa-solid fa-angle-left'></i></a></li>`);

    for (let i = 1; i <= totalPgs; i++) {
        const activeClass = (i === currentPg) ? 'page-item active' : 'page-item';
        paginationContainer.insertAdjacentHTML('beforeend', `<li class="${activeClass}"><a class="page-link" href="javascript:void(0)" data-page="${i}">${i}</a></li>`);
    }

    const nextClass = (currentPg < totalPgs) ? 'page-item' : 'page-item disabled';
    paginationContainer.insertAdjacentHTML('beforeend', `<li class='${nextClass}'><a class='page-link' href='javascript:void(0)'><i class='fa-solid fa-angle-right'></i></a></li>`);

    document.querySelectorAll('.pagination .page-item a').forEach(item => {
        item.addEventListener('click', function () {
            const selectedPage = parseInt(this.dataset.page, 10) || (this.querySelector('.fa-angle-left') ? currentPg - 1 : currentPg + 1);
            if (!isNaN(selectedPage) && selectedPage !== currentPg && selectedPage > 0 && selectedPage <= totalPgs) {
                window.location.href = `?page=${selectedPage}`;  // Redirect to the selected page
            }
        });
    });
}

</script>