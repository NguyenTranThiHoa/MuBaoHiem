const productMenu = document.querySelector('.product-menu');
const subMenu = document.querySelector('.sub-menu');

productMenu.addEventListener('click', function (event) {
    event.stopPropagation(); // Ngăn sự kiện click lan sang document
    subMenu.style.display = subMenu.style.display === 'block' ? 'none' : 'block';
});

document.addEventListener('click', function (event) {
    if (event.target !== productMenu) {
        subMenu.style.display = 'none';
    }
});

/*--------------Trang sản phẩm--------------*/
const productLinks = document.querySelectorAll('.product-link');
productLinks.forEach(function (link) {
    link.addEventListener('click', function () {
        const productHref = link.getAttribute('data-href');
        window.location.href = productHref;
    });
});
/*------------------Hiện mật khẩu--------------*/
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
/*---------------NÚT HOME------------------*/
document.querySelector('.menu2 a').addEventListener('click', function (event) {
  event.preventDefault();
  window.location.href = 'TrangChu.html';
});
/*----------------------------------------*/
let slideIndex = 0;

function prevSlide() {
    showSlide(slideIndex -= 1);
}

function nextSlide() {
    showSlide(slideIndex += 1);
}

function showSlide(n) {
    const slides = document.getElementsByClassName('slider-content');
    if (n >= slides.length) {
        slideIndex = 0;
    }
    if (n < 0) {
        slideIndex = slides.length - 1;
    }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.transform = `translateX(${-(slideIndex * 100)}%)`;
    }
}

showSlide(slideIndex); // Hiển thị slide đầu tiên khi trang tải
/*---------Section---------*/
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  const slides = document.getElementsByClassName("mySlides");
  const dots = document.getElementsByClassName("dot");

  if (n > slides.length) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slides.length;
  }

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }

  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}
/*---------------Chuyển động hình ảnh sản phẩm-------------------*/
// Lấy danh sách tất cả các phần tử có class "page-link"
const pageLinks = document.querySelectorAll('.page-link');

// Lặp qua từng phần tử và gắn sự kiện click
pageLinks.forEach((pageLink) => {
    pageLink.addEventListener('click', (event) => {
        event.preventDefault(); // Ngăn chuyển trang mặc định

        // Loại bỏ class "active" từ tất cả các phần tử
        pageLinks.forEach((link) => {
            link.classList.remove('active');
        });

        // Thêm class "active" vào phần tử được click
        pageLink.classList.add('active');

        // Điều hướng hoặc xử lý chuyển trang tùy ý ở đây
        // Ví dụ: chuyển đến trang được chỉ định trong thuộc tính "href"
        const page = pageLink.getAttribute('href');
        window.location.href = page; // Chuyển đến trang mới
    });

    // Gắn sự kiện hover
    pageLink.addEventListener('mouseover', () => {
        // Thêm hiệu ứng hover tùy ý ở đây
        pageLink.style.backgroundColor = 'lightgray';
    });

    // Gắn sự kiện unhover
    pageLink.addEventListener('mouseout', () => {
        // Loại bỏ hiệu ứng hover tùy ý ở đây
        pageLink.style.backgroundColor = '';
    });
});

