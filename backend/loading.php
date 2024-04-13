<div class="spinner-wrapper">
    <div class="spinner-grow text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <div class="spinner-grow text-secondary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <div class="spinner-grow text-success" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <div class="spinner-grow text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <div class="spinner-grow text-warning" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <div class="spinner-grow text-info" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<script>
const spinnerWrapper = document.querySelector('.spinner-wrapper');
window.addEventListener('load', () => {
    setTimeout(() => {
        spinnerWrapper.style.display = 'none';
    }, 800);
});
</script>