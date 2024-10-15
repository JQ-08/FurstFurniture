<?php
ob_start();
include 'includes/connect.php';

if (isset($_POST['add_to_cart'])) {
    if ($userId === null) {
        echo '<script>
            alert("You need to login to your account!");
            window.location.href = "../user/login.php";
        </script>';
        exit();
    } else {
        $product_id = filter_var($_POST['product_id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $qty = filter_var($_POST['qty'], FILTER_SANITIZE_NUMBER_INT);

        $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE userId = ? AND product_id = ?");
        $check_cart->execute([$userId, $product_id]);

        if ($check_cart->rowCount() > 0) {
            $update_cart = $conn->prepare("UPDATE `cart` SET qty = qty + ? WHERE userId = ? AND product_id = ?");
            $update_cart->execute([$qty, $userId, $product_id]);

            echo '<script>alert("Product quantity updated in the cart!");</script>';
        } else {
            $insert_cart = $conn->prepare("INSERT INTO `cart` (userId, product_id, price, qty) VALUES (?, ?, ?, ?)");
            $insert_cart->execute([$userId, $product_id, $price, $qty]);

            echo '<script>alert("Product added to cart!");</script>';
        }
    }
}


if (isset($success_msg)) {
    echo '<div class="alert alert-success">';
    foreach ($success_msg as $msg) {
        echo '<p>' . htmlspecialchars($msg) . '</p>';
    }
    echo '</div>';
}

if (isset($warning_msg)) {
    echo '<div class="alert alert-warning">';
    foreach ($warning_msg as $msg) {
        echo '<p>' . htmlspecialchars($msg) . '</p>';
    }
    echo '</div>';
}
?>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const minusButton = document.querySelector('.minus');
        const plusButton = document.querySelector('.plus');
        const countSpan = document.querySelector('.count');
        const qtyInput = document.getElementById('qty-input');
        let count = parseInt(countSpan.textContent);

        minusButton.addEventListener('click', function () {
            if (count > 1) {
                count--;
                countSpan.textContent = count;
                qtyInput.value = count;
            }
        });

        plusButton.addEventListener('click', function () {
            count++;
            countSpan.textContent = count;
            qtyInput.value = count;
        });
    });
</script>

<script>
const mainImages = document.querySelectorAll(".default .main-img img");
const thumbnails = document.querySelectorAll(".default .thumb-list div");
const lightboxMainImages = document.querySelectorAll(".lightbox .main-img img");
const lightboxThumbnails = document.querySelectorAll(
  ".lightbox .thumb-list div"
);
const lightbox = document.querySelector(".lightbox");
const iconClose = document.querySelector(".icon-close");
const iconPrev = document.querySelector(".icon-prev");
const iconNext = document.querySelector(".icon-next");

let currentImageIndex = 0;

const changeImage = (index, mainImages, thumbnails) => {
  mainImages.forEach((img) => {
    img.classList.remove("active");
  });
  thumbnails.forEach((thumb) => {
    thumb.classList.remove("active");
  });

  mainImages[index].classList.add("active");
  thumbnails[index].classList.add("active");
  currentImageIndex = index;
};

thumbnails.forEach((thumb, index) => {
  thumb.addEventListener("click", () => {
    changeImage(index, mainImages, thumbnails);
  });
});

lightboxThumbnails.forEach((thumb, index) => {
  thumb.addEventListener("click", () => {
    changeImage(index, lightboxMainImages, lightboxThumbnails);
  });
});

mainImages.forEach((img, index) => {
  img.addEventListener("click", () => {
    lightbox.classList.add("active");
    changeImage(index, lightboxMainImages, lightboxThumbnails);
  });
});

iconPrev.addEventListener("click", () => {
  if (currentImageIndex <= 0) {
    changeImage(mainImages.length - 1, lightboxMainImages, lightboxThumbnails);
  } else {
    changeImage(currentImageIndex - 1, lightboxMainImages, lightboxThumbnails);
  }
});

iconNext.addEventListener("click", () => {
  if (currentImageIndex >= mainImages.length - 1) {
    changeImage(0, lightboxMainImages, lightboxThumbnails);
  } else {
    changeImage(currentImageIndex + 1, lightboxMainImages, lightboxThumbnails);
  }
});

iconClose.addEventListener("click", () => {
  lightbox.classList.remove("active");
});
</script>