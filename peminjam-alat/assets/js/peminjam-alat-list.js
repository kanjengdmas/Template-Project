document.addEventListener('DOMContentLoaded', function() {
    // Handle setup modal
    document.querySelectorAll('.pinjam-btn').forEach(button => {
        button.addEventListener('click', function() {
            const stok = this.getAttribute('data-stok');
            document.getElementById('pinjam-id').value = this.getAttribute('data-id');
            document.getElementById('pinjam-nama').value = this.getAttribute('data-nama');
            document.getElementById('pinjam-jumlah').setAttribute('max', stok);
            document.getElementById('max-stok-text').innerText = "Max: " + stok;
        });
    });

    // Search & Filter Category Logic
    const searchInput = document.getElementById('search-alat');
    const categoryButtons = document.querySelectorAll('.btn-category');
    const catalogRow = document.getElementById('catalog-row');
    const itemCols = document.querySelectorAll('.alat-item-col');
    const btnGridView = document.getElementById('btn-grid-view');
    const btnListView = document.getElementById('btn-list-view');

    let currentSearch = '';
    let currentCategory = 'all';

    function filterAlat() {
        itemCols.forEach(col => {
            const name = col.getAttribute('data-nama').toLowerCase();
            const category = col.getAttribute('data-kategori');
            
            const matchesSearch = name.includes(currentSearch);
            const matchesCategory = currentCategory === 'all' || category === currentCategory;

            if (matchesSearch && matchesCategory) {
                col.classList.remove('d-none');
            } else {
                col.classList.add('d-none');
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentSearch = this.value.toLowerCase();
            filterAlat();
        });
    }

    categoryButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            categoryButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.getAttribute('data-category');
            filterAlat();
        });
    });

    if (btnGridView) {
        btnGridView.addEventListener('click', function() {
            btnListView.classList.remove('active');
            this.classList.add('active');
            catalogRow.classList.remove('alat-list-view');
        });
    }

    if (btnListView) {
        btnListView.addEventListener('click', function() {
            btnGridView.classList.remove('active');
            this.classList.add('active');
            catalogRow.classList.add('alat-list-view');
        });
    }
});
