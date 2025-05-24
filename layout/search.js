document.addEventListener("DOMContentLoaded", function () {
  const searchIcon = document.querySelector(".search-icon");
  const searchBox = document.getElementById("searchBox");

  searchIcon.addEventListener("click", function (e) {
    e.preventDefault();
    searchBox.classList.toggle("active");
  });
});
// xử lý tìm kiểm
document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('.wanda-mxm-search');
  const inputQ = form.querySelector('input[name="q"]');
  const inputType = form.querySelector('input[name="type"]');
  const resultsContainer = document.querySelector('.results-seach');

  let debounceTimeout;

  function fetchSearchResults(q, type) {
    const url = `http://localhost/webbanhang/utils/search.php?q=${encodeURIComponent(q)}&type=${encodeURIComponent(type)}`;
    return fetch(url).then(res => {
      if (!res.ok) throw new Error('Lỗi mạng khi gọi API');
      return res.json();
    });
  }

  inputQ.addEventListener('input', function () {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => {
      const q = inputQ.value.trim();
      const type = inputType.value.trim();

      if (q === '') {
        resultsContainer.innerHTML = '<p style="text-align:center; padding: 20px 0;">Vui lòng nhập từ khóa tìm kiếm</p>';
        resultsContainer.style.display = 'block';
        return;
      }

      // Hiển thị loading
      resultsContainer.innerHTML = '<p style="text-align:center; padding: 20px 0;">Đang tìm kiếm...</p>';
      resultsContainer.style.display = 'block';

      fetchSearchResults(q, type)
        .then(data => displayResults(data))
        .catch(err => {
          resultsContainer.innerHTML = `<p style="text-align:center; padding: 20px 0;">Lỗi khi tải dữ liệu: ${err.message}</p>`;
          resultsContainer.style.display = 'block';
        });
    }, 300);
  });

  function displayResults(data) {
    if (!data.products || data.products.length === 0) {
      resultsContainer.innerHTML = '<p style="text-align:center; padding: 20px 0;">Không tìm thấy sản phẩm phù hợp</p>';
      resultsContainer.style.display = 'block';
      return;
    }

    let html = '<ul class="search-results-list" style="padding-left: 0; margin: 0;">';

    data.products.forEach(product => {
      let thumbnailPath = product.thumbnail;

      if (thumbnailPath.startsWith('assets/images')) {
        thumbnailPath = thumbnailPath.substring('assets/images'.length);
      }

      thumbnailPath = thumbnailPath.replace(/^\/+/, '');
      thumbnailPath = `/webbanhang/assets/images/${thumbnailPath}`;

      const priceNumber = Number(product.price);

      html += `
<li class="search-result-item" style="margin-bottom: 15px; list-style: none; display: flex; align-items: center; font-size: 14px;">
  <img src="${thumbnailPath}" alt="${product.title}" style="width: 50px; height: 50px; object-fit: contain; margin-right: 10px;">
  <div style="display: flex; flex-direction: column; justify-content: center; max-width: 280px;">
    <span style="font-size: 13px; font-weight: 600; color: #000; line-height: 1.2; text-align: left; word-wrap: break-word;">
      ${product.title}
    </span>
    <span style="color: #e91e63; font-weight: 700; font-size: 14px; line-height: 1.2; text-align: left;">
      ${priceNumber.toLocaleString('vi-VN')} đ
    </span>
  </div>
</li>
            `;
    });

    html += '</ul>';

    resultsContainer.innerHTML = html;
    resultsContainer.style.display = 'block';
  }
});

