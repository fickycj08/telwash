document.querySelector('.bulanini-bt').addEventListener('click', function () {
    alert('Tombol diklik!');
});
document.querySelector('.bulanlalu-bt').addEventListener('click', function () {
    alert('Tombol diklik!');
});
const searchInput = document.querySelector('.searchbar-input');
const searchIcon = document.querySelector('.ph-magnifying-glass');

searchInput.addEventListener('focus', () => {
    searchIcon.style.opacity = '1'; // Set opacity to 100% on focus
});

searchInput.addEventListener('blur', () => {
    searchIcon.style.opacity = '0.3'; // Set opacity back to 30% on blur
});