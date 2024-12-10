document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('userDropdownButton1');
    const dropdown = document.getElementById('userDropdown1');

    button.addEventListener('click', () => {
        const isHidden = dropdown.classList.contains('hidden');
        dropdown.classList.toggle('hidden', !isHidden);
        dropdown.classList.toggle('opacity-0', !isHidden);
        dropdown.classList.toggle('scale-95', !isHidden);
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (event) => {
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
            dropdown.classList.add('opacity-0');
            dropdown.classList.add('scale-95');
        }
    });
});


function closeAlert(id) {
    const alertElement = document.getElementById(id);
    if (alertElement) {
        alertElement.style.display = 'none';
    }
}

window.addEventListener("scroll", () => {
    const header = document.getElementById("header");
    if (window.scrollY >= 40) {
      header.classList.add("backdrop-blur-xl");
    } else {
      header.classList.remove("backdrop-blur-xl");
    }
  });

  const carts = document.getElementById("carts");
  carts.addEventListener("click", () => {
    const closeCart = document.getElementById("close-cart");
    const listCart = document.getElementById("list-cart");
    listCart.classList.remove("hidden");

    closeCart.addEventListener("click", () => {
      listCart.classList.add("hidden");
    });

    listCart.addEventListener("click", (e) => {
      // Periksa apakah target bukan bagian dari 'cart-content' atau tombol 'close-cart'
      if (!e.target.closest("#cart-content")) {
        listCart.classList.add("hidden");
      }
    });
  });

  const hamburger = document.getElementById("hamburger");
  hamburger.addEventListener("click", () => {
    const closeMenu = document.getElementById("close-menu");
    const listMenu = document.getElementById("list-menu");
    listMenu.classList.remove("hidden");

    closeMenu.addEventListener("click", () => {
      listMenu.classList.add("hidden");
    });

    listMenu.addEventListener("click", (e) => {
      if (!e.target.closest("#menu-content")) {
        listMenu.classList.add("hidden");
      }
    });
  });

  function minus(id) {
    const input = document.getElementById(id);
    if (input.value > 1) {
      input.value = parseInt(input.value) - 1;
    }
  }

  function plus(id, max) {
    const input = document.getElementById(id);
    if (input.value < max) {
      input.value = parseInt(input.value) + 1;
    }
  }