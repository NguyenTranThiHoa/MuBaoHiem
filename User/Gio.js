/*-------------Xóa giỏ hàng----------------*/
// Thêm sự kiện xóa cho nút button
const deleteButtons = document.querySelectorAll('.delete');
deleteButtons.forEach(button => {
  button.addEventListener('click', () => {
    const productRow = button.parentElement.parentElement; 
    // Thay đổi sản phẩm trong bảng giỏ hàng
    productRow.remove(); 
    // Cập nhật lại tổng tiền sau khi xóa sản phẩm ra khỏi giỏ hàng
    const totalAmount = document.getElementById('total-amount');
    const prices = document.querySelectorAll('.price');
    let total = 0;
    prices.forEach(price => {
      total += parseInt(price.textContent.replace('.000 VND', ''), 10);
    });
    totalAmount.textContent = total + '.000 VND';
  });
});

  // Lấy danh sách sản phẩm từ Local Storage
  const existingProduct = JSON.parse(localStorage.getItem('cart'));
  const cartItems = document.querySelector('#cart-items');

  if (existingProduct) {
    existingProduct.forEach((item, index) => {
        const row = document.createElement('tr');
        const price = item.price % 1 === 0 ? `${item.price}.000` : item.price; // Định dạng giá tiền
        row.innerHTML = `
            <th><img src="${item.image}" alt="Product Image" style="width:80px; height: 80px;"></th>
            <th><h3 class="product-name">${item.name}</h3></th>
            <th>${item.size}</th>
            <th><input type="number" class="quantity" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)"></th>
            <th><span class="price">${price} VND</span></th>
            <th><button class="delete" onclick="removeProduct(${index})">Xóa</button></th>
        `;
        cartItems.appendChild(row);
    });

    // Cập nhật tổng tiền
    const totalAmount = existingProduct.reduce((total, item) => total + item.subtotal, 0);
    const formattedTotal = totalAmount % 1 === 0 ? `${totalAmount}.000` : totalAmount; // Định dạng tổng tiền
    document.querySelector('#total-amount').textContent = `${formattedTotal} VND`;
}


function updateQuantity(index, newQuantity) {
    const existingProduct = JSON.parse(localStorage.getItem('cart'));
    const item = existingProduct[index];
    item.quantity = parseInt(newQuantity);
    item.subtotal = item.price * item.quantity;
    localStorage.setItem('cart', JSON.stringify(existingProduct));

    // Cập nhật lại trang giỏ hàng sau khi thay đổi số lượng
    location.reload();
}

// Tạo một hàm tính tổng giá trị của tất cả sản phẩm trong giỏ hàng
function calculateTotal(existingProduct) {
    return existingProduct.reduce((total, item) => total + item.subtotal, 0);
}

// Sử dụng hàm tính tổng để cập nhật tổng giá trị
if (existingProduct) {
    existingProduct.forEach((item, index) => {
        // ... (code hiển thị sản phẩm trong giỏ hàng)
    });

    const totalAmount = calculateTotal(existingProduct);
    const formattedTotal = totalAmount % 1 === 0 ? `${totalAmount}.000` : totalAmount;
    document.querySelector('#total-amount').textContent = `${formattedTotal} VND`;
}

function removeProduct(index) {
    const existingProduct = JSON.parse(localStorage.getItem('cart'));
    existingProduct.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(existingProduct));

    // Cập nhật lại trang giỏ hàng sau khi xóa sản phẩm
    location.reload();
}
/*--
document.querySelectorAll('.buy-btn').forEach(button => {
  button.addEventListener('click', function() {
      var productId = this.getAttribute('data-productid');
      // Gửi productId về server để lưu trữ thông tin sản phẩm vào giỏ hàng
      // Sử dụng XMLHttpRequest hoặc fetch để gửi yêu cầu AJAX
  });
});
------------------------------------------------*/



