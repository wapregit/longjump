<style>
.spinner-wrapper {
    background-color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1vw;
    transition: all 0.3s;
}

.spinner-grow {
    height: 30px;
    width: 30px;
}
</style>

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